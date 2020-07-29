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
                <span v-else-if="props.column.field == 'company_search'">
                    <autocomplete :search="searchCompany" autoSelect>
                        <template
                            #default="{
                                rootProps,
                                inputProps,
                                inputListeners,
                                resultListProps,
                                resultListListeners,
                                results,
                                resultProps
                                }"
                        >
                            <div v-bind="rootProps">
                                <input
                                    v-bind="inputProps"
                                    v-on="inputListeners"
                                    v-model="props.row.company_name"
                                    :class="[
                                    companies.find(company => company.name === props.row.company_name) ? 'form-control-success': 'form-control-warning',
                                    'form-control',
                                        { 'autocomplete-input-no-results': false },
                                        { 'autocomplete-input-focused': false }
                                        ]"
                                />
                                <ul
                                    v-if="false"
                                    class="autocomplete-result-list"
                                    style="position: absolute; z-index: 1; width: 100%; top: 100%;"
                                >
                                    <li class="autocomplete-result">No results found</li>
                                </ul>
                                <ul v-bind="resultListProps" v-on="resultListListeners">
                                    <li
                                        v-for="(result, index) in results"
                                        @click="props.row.company_name = result"
                                        :key="resultProps[index].id"
                                        v-bind="resultProps[index]"
                                    >{{ result }}</li>
                                    <!-- Need to add event listener keydown.enter, can't work it out, will get back later  -->
                                </ul>
                            </div>
                        </template>
                    </autocomplete>
                    <small
                        class="text-warning small"
                        v-if="!companies.find(company => company.name === props.row.company_name) && props.row.company_name"
                    >Couldn't find this company, creating new.</small>
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
                    <button class="btn btn-danger" @click="deleteLead(props.row)">
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
                        label: "Phone 2",
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
                let obj = {
                    first_name: row.first_name,
                    last_name: row.last_name,
                    company: this.companies.find(
                        (company) => company.name === row.company_name
                    )
                        ? this.companies.find(
                              (company) => company.name === row.company_name
                          ).id
                        : row.company_name, //try and refactor
                    email: row.email,
                    title: row.title,
                    linkedin: row.linkedin,
                    phone_1: row.phone_1,
                    country: row.country,
                };

                if (Object.keys(obj).some((key) => !obj[key])) {
                    Object.keys(obj).map((key) => {
                        if (!obj[key]) {
                            this[key] = "";
                        }
                    });
                    console.error("empty field");
                    return;
                }

                obj["phone_2"] = row.phone_2;

                axios.post(`/lead`, obj).then((res) => {
                    this.deleteLead(row)
                });
            },

            deleteLead(row) {
                axios.delete(`/incomplete-leads/${row.id}`).then((res) => {
                    this.rows.splice(row.originalIndex, 1);
                    });
            },

            setCompanyName() {
                if (
                    this.companies.find(
                        (company) => company.name === event.target.value
                    )
                ) {
                    event.target.className = "form-control form-control-success";
                } else {
                    if (event.target.value !== "")
                        event.target.className =
                            "form-control form-control-warning";
                }
            },
        },
    };
</script>
