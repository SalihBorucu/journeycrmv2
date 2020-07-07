<template>
    <div>
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
                                <h4 class="page-title m-0">Dashboard</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="float-right d-none d-md-block" @click="listView = true">
                                    <button class="btn btn-primary dropdown-toggle">
                                        <i class="ti-settings mr-1"></i>
                                        Back to list
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <lead-view-modal :lead="selectedLead"></lead-view-modal>
        </div>
    </div>
</template>

<script>
    import 'vue-good-table/dist/vue-good-table.css';
    import { VueGoodTable } from 'vue-good-table';
    import LeadViewModal from './LeadViewModal';

    export default {
        props: ['leads'],

        components: {
            VueGoodTable,
            LeadViewModal,
        },

        data() {
            return {
                listView: true,
                selectedLead: null,
                currentTableProps: {
                    page: 1,
                    sort: this.$route.query.sortField ? {field: this.$route.query.sortField, type:this.$route.query.sortType} : {},
                },
                columns: [
                    {
                        label: 'Name',
                        field: 'lead.first_name',
                        type: 'text',
                        thClass: 'custom-th',
                        // width: '1fr',
                        // tdClass: 'custom-td',
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: 'Company',
                        field: 'lead.company',
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
                        field: 'lead.phone',
                        type: 'text',
                        filterOptions: {
                            enabled: true,
                        },
                    },
                    {
                        label: 'Due Date',
                        field: 'due_date',
                        width: '200px',
                        tdClass: 'text-center',
                        dateInputFormat: 'yyyy-MM-dd',
                        dateOutputFormat: 'dd/MM/yyyy',
                    },
                    {
                        label: 'Rating',
                        field: 'lead.global_notes.score',
                        tdClass: 'text-center',
                    },
                ],

                rows: this.leads,
            };
        },

        mounted() {
            console.log(this.$refs.dataTable.originalRows[0].children);
        },

        methods: {
            openLeadView(params) {
                this.listView = false;
                console.log(this.$refs.dataTable.originalRows);

                // params.pageIndex - index of this row on the current page.
                console.log(params);
                this.$router.push({ path: window.location.pathname + window.location.search, query: { leadIndex: params.pageIndex } });
                //take page index from param then processed rows will give the list of things
                this.selectedLead = params.row;
            },

            pageChanged(params) {
                console.log(params);
                this.$router.push({ path: window.location.pathname + window.location.search, query: { page: params.currentPage } });
                this.currentTableProps.page = params.currentPage;
            },

            onSortChange(params) {
                this.$router.push({ path: window.location.pathname + window.location.search, query: { sortField: params[0].field, sortType: params[0].type } });
                this.currentTableProps.sort = params[0];
            },
        },
    };
</script>

<style>
    .vgt-wrap {
        box-shadow: 0 0 2pt 1pt #2bcca4;
        border: solid 2px white;
        border-radius: 5px;
    }
    .vgt-input:focus {
        border: solid 2px #2bcca4;
    }

    .vgt-table thead th.sorting-asc:after {
        border-bottom: 5px solid #2bcca4;
    }

    .vgt-table thead th.sorting-desc:before {
        border-top: 5px solid #2bcca4;
    }

    table.vgt-table tr.clickable:hover {
        background-color: rgba(43, 204, 164, 0.274);
    }

    .vgt-wrap__footer .footer__navigation__page-btn .chevron.left::after {
        border-right: 6px solid #2bcca4;
    }

    .vgt-wrap__footer .footer__navigation__page-btn .chevron.right::after {
        border-left: 6px solid #2bcca4;
    }
</style>
