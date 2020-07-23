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
                perPage: 10,
                setCurrentPage: 1,
                position: 'top',
                nextLabel: 'next',
                prevLabel: 'prev',
                rowsPerPageLabel: 'Rows per page',
                ofLabel: 'of',
                pageLabel: 'page', // for 'pages' mode
                allLabel: 'All',
            }"
            min-width="500px"
            ref="dataTable"
            @on-row-click="openLeadView"
        />
        <!-- :sort-options="{
                initialSortBy: this.currentTableProps.sort,
        }"-->
        <!-- Modal Start -->
        <div class="row">
            <div
                id="myModal"
                class="modal fade show"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel"
            >
                <unassigned-lead-modal :lead="selectedLead" :user="user"></unassigned-lead-modal>
            </div>
        </div>

        <!-- @on-page-change="pageChanged"
        @on-sort-change="onSortChange"-->
    </div>
</template>
<script>
    import "vue-good-table/dist/vue-good-table.css";
    import { VueGoodTable } from "vue-good-table";
    import UnassignedLeadModal from "./UnassignedLeadModal";
    import axios from "axios";

    export default {
        components: { UnassignedLeadModal },
        props: ["unassignedLeads", "user"],

        data() {
            return {
                leadModal: false,
                selectedLead: null,
                // currentLeadIndex: parseInt(this.$route.query.leadIndex) || null,
                currentTableProps: {
                    page: 1,
                    // sort: this.$route.query.sortField
                    //     ? {
                    //           field: this.$route.query.sortField,
                    //           type: this.$route.query.sortType,
                    //       }
                    //     : {},
                },
                columns: [
                    {
                        label: "Name",
                        field: "full_name",
                        type: "text",
                        thClass: "custom-th",
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: "Company",
                        field: "company.name",
                        type: "text",
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: "Title",
                        field: "title",
                        type: "text",
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: "Country",
                        field: "country",
                        type: "text",
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: "Phone",
                        field: "phone_1",
                        type: "text",
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: "Phone",
                        field: "phone_2",
                        type: "text",
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: "Linkedin",
                        field: "linkedin",
                        type: "text",
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: "Account",
                        field: function (row) {
                            return `<select class="form-control" id="account${row.originalIndex}">
                                                                        </select>`;
                        },
                        html: true,
                        // filterOptions: {
                        //     enabled: true,
                        // },
                    },
                    {
                        label: "Campaign",
                        field: function (row) {
                            return `<select class="form-control" onchange="something" id="campaign${row.originalIndex}">
                                                                        </select>`;
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

                    axios.post(`/lead-account`, obj).then((res) => {
                        console.log(res.data)
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
            openLeadView(params) {
                this.leadModal = true;
                // this.currentLeadIndex = params.row.originalIndex;
                // let processedIndex = this.$refs.dataTable.processedRows[0].children.findIndex(
                //     (x) => x.originalIndex === params.row.originalIndex
                // );

                // this.$router
                //     .push({
                //         path: this.$route.fullPath,
                //         query: { leadIndex: processedIndex },
                //     })
                //     .catch(() => {});
                this.selectedLead = params.row;
            },
        },
    };
</script>
