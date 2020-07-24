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
            :sort-options="{
                enabled:false,
            }"
            min-width="500px"
            ref="dataTable"
        >
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'first_name'">
                    <textarea class="form-control btn" v-model="props.row.first_name" />
                </span>
                <span v-else-if="props.column.field == 'last_name'">
                    <textarea class="form-control btn" v-model="props.row.last_name" />
                </span>
                <!-- <span v-else-if="props.column.field == 'company_name'">
                    <div
                        v-if="props.row.company_name"
                        :class="[companies.find(company => company.name === props.row.company_name)? 'form-control-success':'form-control-danger', 'p-1'
                    ]">{{props.row.company_name}}</div>
                    <small
                        v-if="!companies.find(company => company.name === props.row.company_name)"
                        class="text-danger"
                    >Couldn't find company.</small>
                </span> -->
                <span v-else-if="props.column.field == 'company_search'">
                    <autocomplete
                    @blur="setCompanyName"
                    :search="searchCompany"
                    :default-value="props.row.company_name"
                    :class="[companies.find(company => company.name === props.row.company_name) ? 'form-control-success': 'form-control-danger'
                    ]"
                    >
                    </autocomplete>
                </span>
                <span v-else-if="props.column.field == 'title'">
                    <textarea class="form-control btn" v-model="props.row.title" />
                </span>
                <span v-else-if="props.column.field == 'email'">
                    <textarea class="form-control btn" v-model="props.row.email" />
                </span>
                <span v-else-if="props.column.field == 'phone_1'">
                    <textarea class="form-control btn" v-model="props.row.phone_1" />
                </span>
                <span v-else-if="props.column.field == 'phone_2'">
                    <textarea class="form-control btn" v-model="props.row.phone_2" />
                </span>
                <span v-else-if="props.column.field == 'linkedin'">
                    <textarea class="form-control btn" v-model="props.row.linkedin" />
                </span>
                <div v-else-if="props.column.field == 'button'" class="d-flex">
                    <button class="btn btn-primary" @click="completeLead(props.row)">
                        <i class="mdi mdi-check text-white"></i>
                    </button>
                    <button class="btn btn-danger">
                        <i class="mdi mdi-trash-can text-white"></i>
                    </button>
                </div>
            </template>
        </vue-good-table>
    </div>
</template>
<script>
    import "vue-good-table/dist/vue-good-table.css";
    import { VueGoodTable } from "vue-good-table";
    import axios from "axios";

    export default {
        props: ["companies", "leads", "user"],

        data() {
            return {
                columns: [
                    {
                        label: "First Name",
                        field: "first_name",
                    },
                    {
                        label: "Last Name",
                        field: "last_name",
                    },
                    // {
                    //     label: "Company",
                    //     field: "company_name",
                    // },
                    {
                        label: "Company Search",
                        field: "company_search",
                    },
                    {
                        label: "Title",
                        field: "title",
                    },
                    {
                        label: "Country",
                        field: "country",
                    },
                    {
                        label: "Email",
                        field: "email",
                    },
                    {
                        label: "Phone",
                        field: "phone_1",
                    },
                    {
                        label: "Phone",
                        field: "phone_2",
                    },
                    {
                        label: "Linkedin",
                        field: "linkedin",
                    },
                    {
                        label: "Complete Button",
                        field: "button",
                    },
                ],
                rows: this.leads.map((lead) => {
                    lead["currentUser"] = this.user;
                    return lead;
                }),
            };
        },

        mounted() {
            $(".autocomplete-input").attr("class", "form-control");
        },

        methods: {
            searchCompany(input) {
                if (input.length < 1) {
                    return [];
                }
                return this.companies
                    .map((company) => company.name)
                    .filter((country) => {
                        return country
                            .toLowerCase()
                            .startsWith(input.toLowerCase());
                    });
            },

            completeLead(row) {
                console.log(row);
            },

            setCompanyName() {
                if(this.companies.find(company => company.name === event.target.value)){
                    event.target.className = 'form-control form-control-success'
                }else{
                    if(event.target.value !== '')
                    event.target.className = 'form-control form-control-warning'
                }
            },
        },
    };
</script>
