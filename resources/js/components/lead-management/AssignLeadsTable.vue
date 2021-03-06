<template>
    <div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            styleClass="vgt-table striped bordered custom-table"
            :pagination-options="{
                enabled: true,
                mode: 'records',
                perPage: 20,
                setCurrentPage: 1,
                position: 'top',
                nextLabel: 'next',
                prevLabel: 'prev',
                rowsPerPageLabel: 'Rows per page',
                ofLabel: 'of',
                pageLabel: 'page', // for 'pages' mode
                allLabel: 'All',
            }"
            :sort-options="{
                enabled:false,
            }"
            min-width="500px"
            ref="dataTable"
        >
            <template slot="table-row" slot-scope="props">
                <a
                    v-if="props.column.field == 'linkedin'"
                    class="social-source-icon"
                    :href="props.row.linkedin"
                    target="_blank"
                >
                    <i class="mdi mdi-linkedin bg-primary text-white" style="font-size: 40px"></i>
                </a>
                <select
                    :id="props.row.id"
                    v-else-if="props.column.field == 'account'"
                    class="form-control"
                    @change="selectedIndividualAccount"
                >
                    <option
                        :value="account.account.id"
                        v-for="account in user.user_accounts"
                    >{{ account.account.name }}</option>
                </select>
                <select
                    class="form-control"
                    :id="'campaign' + props.row.id"
                    v-else-if="props.column.field == 'campaign'"
                >
                    <option
                        :value="campaign.id"
                        v-for="campaign in user.user_accounts[0].account.campaigns"
                    >{{campaign.name}}</option>
                </select>
                <button
                    :id="'btn' + props.row.id"
                    v-else-if="props.column.field == 'button'"
                    class="btn btn-primary"
                    @click="assignIndividualCampaign(props.row)"
                >Assign</button>
            </template>
        </vue-good-table>

        <div class="row card m-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-around w-75">
                        <label class="m-2">Account:</label>
                        <select name class="form-control" v-model="global_account">
                            <option
                                :value="account.account_id"
                                v-for="account in this.user.user_accounts"
                            >{{account.account.name}}</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-around w-75" v-if="global_account">
                        <label class="m-2">Campaign:</label>
                        <select name class="form-control" v-model="global_campaign">
                            <option
                                :value="campaign.id"
                                v-for="campaign in this.user.user_accounts.find(account => account.account_id === this.global_account).account.campaigns"
                            >{{campaign.name}}</option>
                        </select>
                    </div>
                    <button class="btn btn-primary w-50 ml-2" @click="assignAll">Assign All</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import "vue-good-table/dist/vue-good-table.css";
    import { VueGoodTable } from "vue-good-table";

    export default {
        props: ["leads", "user"],

        data() {
            return {
                global_account: null,
                global_campaign: null,

                columns: [
                    {
                        label: "Name",
                        field: "full_name",
                        type: "text",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Company",
                        field: "company.name",
                        type: "text",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Title",
                        field: "title",
                        type: "text",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Country",
                        field: "country",
                        type: "text",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Phone",
                        field: "phone_1",
                        type: "text",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Phone 2",
                        field: "phone_2",
                        type: "text",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Linkedin",
                        field: "linkedin",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Active Accounts",
                        field: function (row) {
                            return row.lead_accounts
                                .map((account) => account.account.name)
                                .join();
                        },
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Account",
                        field: "account",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Campaign",
                        field: "campaign",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "",
                        field: "button",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                ],
                rows: this.leads.map((lead) => {
                    lead["currentUser"] = this.user;
                    return lead;
                }),
            };
        },

        watch: {
            leads() {
                this.rows = this.leads.map((lead) => {
                    lead["currentUser"] = this.user;
                    return lead;
                });
            },
        },

        methods: {
            assignAll() {
                let obj = {
                    account_id: this.global_account,
                    campaign_id: this.global_campaign,
                    lead_id: this.leads.map((lead) => lead.id),
                };

                if (Object.keys(obj).some((key) => !obj[key])) {
                    console.error("Empty fields.");
                    return;
                }

                axios.post(`/lead-account`, obj).then((res) => {
                    this.rows = [];
                });
            },

            selectedIndividualAccount() {
                let campaignsArray = this.user.user_accounts.find(
                    (account) => account.account_id == event.target.value
                ).account.campaigns;

                $(`#campaign${event.target.id}`).html("");

                campaignsArray.forEach((campaign) => {
                    $(`#campaign${event.target.id}`).append(
                        $("<option/>", {
                            text: campaign.name,
                            value: campaign.id,
                        })
                    );
                });
            },

            assignIndividualCampaign(row) {
                let obj = {
                    account_id: $(`#${row.id}`).val(),
                    campaign_id: $(`#campaign${row.id}`).val(),
                    lead_id: row.id,
                };

                if (Object.keys(obj).some((key) => !obj[key])) {
                    console.error("Empty fields."); //create appropriate error
                    return;
                }

                axios.post(`/lead-account`, obj).then((res) => {
                    this.rows.splice(row.originalIndex, 1);
                });
            },
        },
    };
</script>

<style>
    table.vgt-table td {
    padding: 1;
    vertical-align: center;
    border-bottom: 1px solid #dcdfe6;
    color: #606266;
}
</style>
