<template>
    <div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :fixed-header="true"
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
        />
        <div class="row card m-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-around w-75">
                        <label class="m-2">Account:</label>
                        <select name id class="form-control" v-model="global_account">
                            <option
                                :value="account.account_id"
                                v-for="account in this.user.user_accounts"
                            >{{account.account.name}}</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-around w-75">
                        <label class="m-2">Campaign:</label>
                        <select name id class="form-control" v-model="global_campaign">
                            <option value v-if="!global_account"></option>
                            <option
                                v-if="global_account"
                                :value="campaign.campaign_id"
                                v-for="campaign in this.user.user_accounts.find(account => account.account_id === 1).account.account_campaigns"
                            >{{campaign.campaign.name}}</option>
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
    import axios from "axios";

    export default {
        props: ["unassignedLeads", "user"],

        data() {
            return {
                global_account: null,
                global_campaign: null,
                leadModal: false,
                selectedLead: null,

                columns: [
                    {
                        label: "Name",
                        field: "full_name",
                        type: "text",
                        thClass: "custom-th",
                    },
                    {
                        label: "Company",
                        field: "company.name",
                        type: "text",
                    },
                    {
                        label: "Title",
                        field: "title",
                        type: "text",
                    },
                    {
                        label: "Country",
                        field: "country",
                        type: "text",
                    },
                    {
                        label: "Phone",
                        field: "phone_1",
                        type: "text",
                    },
                    {
                        label: "Phone",
                        field: "phone_2",
                        type: "text",
                    },
                    {
                        label: "Linkedin",
                        field: "linkedin",
                        type: "text",
                    },
                    {
                        label: "Account",
                        field: function (row) {
                            return `<select class="form-control" id="account${row.originalIndex}"></select>`;
                        },
                        html: true,
                        // filterOptions: {
                        //     enabled: true,
                        // },
                    },
                    {
                        label: "Campaign",
                        field: function (row) {
                            // can I add inline onchange??
                            return `<select class="form-control" id="campaign${row.originalIndex}"></select>`;
                        },
                        html: true,
                        // filterOptions: {
                        //     enabled: true,
                        // },
                    },
                    {
                        label: "",
                        field: function (row) {
                            return `<button class="btn btn-primary" id="submit${row.originalIndex}">Assign</button>`;
                        },
                        html: true,
                        // filterOptions: {
                        //     enabled: true,
                        // },
                    },
                ],
                rows: this.unassignedLeads.map((lead) => {
                    lead["currentUser"] = this.user;
                    return lead;
                }),
            };
        },

        computed: {
            leadsWithUser() {
                return this.unassignedLeads.map((lead) => {
                    lead["currentUser"] = this.user;
                    return lead;
                });
            },
        },

        mounted() {
            this.rows.forEach((row, index) => {
                $(`#submit${index}`).click(() => {
                    let obj = {
                        account_id: $(`#account${index}`).val(),
                        campaign_id: $(`#campaign${index}`).val(),
                        lead_id: row.id,
                    };

                    if (Object.keys(obj).some((key) => !obj[key])) {
                        console.error("Empty fields.");
                        return;
                    }

                    axios.post(`/lead-account`, obj).then((res) => {
                        this.rows.splice(row.originalIndex, 1);
                    });
                });

                $(`#account${index}`).append(
                    $("<option/>", {
                        text: "",
                        value: null,
                    })
                );
                this.user.user_accounts.forEach((account) => {
                    $(`#account${index}`).append(
                        $("<option/>", {
                            text: account.account.name,
                            value: account.account.id,
                        })
                    );
                    $(`#account${index}`).change(() => {
                        if (!event.target.value) {
                            $(`#campaign${index}`).html("");
                            return;
                        }
                        let selectedAccountId = event.target.value;
                        let accountObject = this.user.user_accounts.find(
                            (account) => account.account_id == selectedAccountId
                        );
                        let campaignsArray =
                            accountObject.account.account_campaigns;

                        $(`#campaign${index}`).html("");
                        campaignsArray.forEach((campaign) => {
                            $(`#campaign${index}`).append(
                                $("<option/>", {
                                    text: campaign.campaign.name,
                                    value: campaign.campaign.id,
                                })
                            );
                        });
                    });
                });
            });
        },

        methods: {
            assignAll() {
                let obj = {
                    account_id: this.global_account,
                    campaign_id: this.global_campaign,
                    lead_id: "all",
                };

                if (Object.keys(obj).some((key) => !obj[key])) {
                    console.error("Empty fields.");
                    return;
                }

                axios.post(`/lead-account`, obj).then((res) => {
                    this.rows = [];
                });
            },
        },
    };
</script>
