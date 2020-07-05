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
                position: 'top',
                nextLabel: 'next',
                prevLabel: 'prev',
                rowsPerPageLabel: 'Rows per page',
                ofLabel: 'of',
                pageLabel: 'page', // for 'pages' mode
                allLabel: 'All',
            }"
            @on-row-click="openLeadView"
            min-width="500px"
        />
    </div>
</template>

<script>
    import 'vue-good-table/dist/vue-good-table.css';
    import { VueGoodTable } from 'vue-good-table';

    export default {
        props: ['leads'],

        components: {
            VueGoodTable,
        },

        data() {
            return {
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
                        tdClass: "text-center",
                        dateInputFormat: 'yyyy-MM-dd',
                        dateOutputFormat: 'dd/MM/yyyy',
                    },
                    {
                        label: 'Rating',
                        field: 'lead.global_notes.score',
                        tdClass: "text-center"
                    },
                ],

                rows: this.leads,
            };
        },

        methods: {
            openLeadView(){
                alert("hey");
            }
        },
    };
</script>


<style>
    .custom-table{
        background: red;
    }

    .custom-td{
        background:blue;
    }
</style>
