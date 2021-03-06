<template>
    <div>
        <search-sidebar :previous_request_inj="previous_request" :campaign_id="campaign_id"></search-sidebar>
        <vue-good-table
            v-show="listView"
            :columns="columns"
            :rows="rows"
            :fixed-header="true"
            styleClass="vgt-table striped bordered custom-table"
            :pagination-options="{
                enabled: true,
                mode: 'records',
                perPage: 10,
                setCurrentPage: parseInt(this.$route.query.page) || 1,
                position: 'top',
                nextLabel: 'next',
                prevLabel: 'prev',
                rowsPerPageLabel: 'Rows per page',
                ofLabel: 'of',
                pageLabel: 'page', // for 'pages' mode
                allLabel: 'All',
            }"
            :sort-options="{
                initialSortBy: this.currentTableProps.sort,
            }"
            @on-row-click="openLeadView"
            @on-page-change="pageChanged"
            @on-sort-change="onSortChange"
            min-width="500px"
            ref="dataTable"
        />
        <div v-if="!listView">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h4 class="page-title m-0"></h4>
                            </div>
                            <div class="col-md-4">
                                <div class="float-right d-none d-md-block" @click="nextLead" v-if="parseInt(this.$route.query.leadIndex) !== this.$refs.dataTable.processedRows[0].children.length - 1">
                                    <button class="btn btn-primary">
                                        <i class="ti-arrow-right ml-1"></i>
                                    </button>
                                </div>
                                <div class="float-right d-none d-md-block mx-1" @click="changeToListView">
                                    <button class="btn btn-primary">
                                        <i class="ti-list mr-1"></i>
                                        Back to list
                                    </button>
                                </div>
                                <div class="float-right d-none d-md-block" @click="previousLead" v-if="this.currentLeadIndex">
                                    <button class="btn btn-primary">
                                        <i class="ti-arrow-left mr-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <lead-view :lead="selectedLead" @activity-complete="removeLeadFromView"></lead-view>
        </div>
    </div>
</template>

<script>
    import 'vue-good-table/dist/vue-good-table.css';
    import { VueGoodTable } from 'vue-good-table';
    import LeadView from './LeadView';
    import SearchSidebar from './SearchSidebar';

    export default {
        props: ['leads', 'outcomes', 'previous_request', 'campaign_id', 'user'],

        components: {
            VueGoodTable,
            LeadView,
            SearchSidebar,
        },

        data() {
            return {
                listView: true,
                selectedLead: null,
                currentLeadIndex: parseInt(this.$route.query.leadIndex) || null,
                currentTableProps: {
                    page: 1,
                    sort: this.$route.query.sortField ? { field: this.$route.query.sortField, type: this.$route.query.sortType } : {},
                },
                columns: [
                    {
                        label: 'Name',
                        field: 'lead.full_name',
                        type: 'text',
                        thClass: 'custom-th',
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: 'Company',
                        field: 'lead.company.name',
                        type: 'text',
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: 'Title',
                        field: 'lead.title',
                        type: 'text',
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: 'Country',
                        field: 'lead.country',
                        type: 'text',
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: 'Phone',
                        field: 'lead.phone_1',
                        type: 'text',
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: 'Due Date',
                        field: 'due_date',
                        width: '120px',
                        dateInputFormat: 'yyyy-MM-dd',
                        dateOutputFormat: 'dd/MM/yyyy',
                        type: 'text',
                    },
                    {
                        label: 'Rating',
                        field: function(row) {
                            let scoresArray = row.lead.global_notes.map((note) => note.score);
                            let avgScore = scoresArray.reduce((a, b) => a + b, 0) / scoresArray.length;
                            return avgScore ? `${Math.round(avgScore)}` : '';
                        },
                        tdClass: 'text-center',
                        type: 'number',
                    },
                ],

                rows: this.leads,
            };
        },

        mounted() {
            if (this.$route.query.leadIndex) {
                this.selectedLead = this.$refs.dataTable.processedRows[0].children[this.$route.query.leadIndex] || null;
                this.listView = false;
            }
        },

        created(){
            this.$store.dispatch('setUserData', this.user)
        },

        methods: {
            openLeadView(params) {
                this.listView = false;
                this.currentLeadIndex = params.row.originalIndex;
                let processedIndex = this.$refs.dataTable.processedRows[0].children.findIndex((x) => x.originalIndex === params.row.originalIndex);

                this.$router.push({ path: this.$route.fullPath, query: { leadIndex: processedIndex } }).catch(() => {});
                this.selectedLead = params.row;
            },

            pageChanged(params) {
                this.$router.replace({ path: this.$route.fullPath, query: { page: params.currentPage } }).catch(() => {});
                this.currentTableProps.page = params.currentPage;
            },

            onSortChange(params) {
                this.$router.push({ path: this.$route.fullPath, query: { sortField: params[0].field, sortType: params[0].type } }).catch(() => {});
                this.currentTableProps.sort = params[0];
            },

            changeToListView() {
                this.listView = true;
                this.$router.push({ path: this.$route.fullPath, query: { leadIndex: null } });
            },

            nextLead() {
                this.selectedLead = this.$refs.dataTable.processedRows[0].children[parseInt(this.$route.query.leadIndex) + 1];
                this.$router.push({ path: this.$route.fullPath, query: { leadIndex: parseInt(this.$route.query.leadIndex) + 1 } }).catch(() => {});
                this.currentLeadIndex = parseInt(this.$route.query.leadIndex);
            },

            previousLead() {
                if (this.$route.query.leadIndex === 0) return;
                this.selectedLead = this.$refs.dataTable.processedRows[0].children[this.$route.query.leadIndex - 1];
                this.$router.push({ path: this.$route.fullPath, query: { leadIndex: this.$route.query.leadIndex - 1 } }).catch(() => {});
                this.currentLeadIndex = parseInt(this.$route.query.leadIndex);
            },

            removeLeadFromView(leadId) {
                if(!this.leads.length){
                    this.listView = true;
                }else{
                    this.nextLead();
                }
                this.leads.splice(this.leads.findIndex((lead) => lead.id === leadId),1);
            },
        },
    };
</script>

<style>
    .vgt-wrap__footer .footer__navigation__page-btn .chevron.left::after {
        border-right: 6px solid #2bcca4;
    }

    .vgt-wrap__footer .footer__navigation__page-btn .chevron.right::after {
        border-left: 6px solid #2bcca4;
    }
</style>
