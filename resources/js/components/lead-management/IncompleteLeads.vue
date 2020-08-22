<template>
    <div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            styleClass="vgt-table striped bordered custom-table"
            @on-page-change="onPageChange"
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
            ref="dataTable"
            compactMode
        >
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'first_name'">
                    <editable v-model="props.row.first_name" :key="props.row.id"></editable>
                    <small
                        class="text-danger small m-1"
                        v-if="!props.row.first_name"
                    >First name is empty.</small>
                </span>
                <span v-else-if="props.column.field == 'last_name'">
                    <editable v-model="props.row.last_name" :key="props.row.id"></editable>
                    <small
                        class="text-danger small m-1"
                        v-if="!props.row.last_name"
                    >Last name is empty.</small>
                </span>
                <span v-else-if="props.column.field == 'company_search'" :class="[]">
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
                                <textarea
                                    :id='"companyTextarea" + props.row.id'
                                    rows="2"
                                    v-bind="inputProps"
                                    v-on="inputListeners"
                                    v-model="props.row.company_name"
                                    class="form-control"
                                />
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
                        class="text-danger small m-1"
                        v-if="!props.row.company_name"
                    >Company is empty.</small>
                    <small
                        class="text-warning small m-1"
                        v-else-if="!companies.find(company => company.name === props.row.company_name) && props.row.company_name"
                    >Couldn't find this company, creating new.</small>
                </span>
                <span v-else-if="props.column.field == 'title'">
                    <editable v-model="props.row.title" :key="props.row.id"></editable>
                    <small class="text-danger small m-1" v-if="!props.row.title">Title is empty.</small>
                </span>
                <span v-else-if="props.column.field == 'country'">
                    <autocomplete :search="searchCountry">
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
                                <textarea
                                    :id='"countryTextarea" + props.row.id'
                                    v-bind="inputProps"
                                    v-on="inputListeners"
                                    rows="2"
                                    v-model="props.row.country"
                                    :class="[
                                        'form-control',
                                        ]"
                                />
                                <ul v-bind="resultListProps" v-on="resultListListeners">
                                    <li
                                        v-for="(result, index) in results"
                                        @click="props.row.country = result"
                                        :key="resultProps[index].id"
                                        v-bind="resultProps[index]"
                                    >{{ result }}</li>
                                    <!-- Need to add event listener keydown.enter, can't work it out, will get back later  -->
                                </ul>
                            </div>
                        </template>
                    </autocomplete>
                    <small class="text-danger small m-1" v-if="!props.row.country">Country is empty.</small>
                </span>
                <span v-else-if="props.column.field == 'email'">
                    <editable
                        type="email"
                        v-model="props.row.email"
                        @blur="checkIfExists(props.row)"
                        :key="props.row.id"
                    />
                    <small class="text-danger small m-1" v-if="!props.row.email">Email is empty.</small>
                    <small
                        v-if="email_error.find(id=> id === props.row.id)"
                        class="text-danger small m-1"
                    >This email is already used, potential duplicate lead.</small>
                </span>
                <span v-else-if="props.column.field == 'phone_1'">
                    <editable v-model="props.row.phone_1" :key="props.row.id" />
                </span>
                <span v-else-if="props.column.field == 'phone_2'">
                    <editable v-model="props.row.phone_2" :key="props.row.id" />
                </span>
                <span v-else-if="props.column.field == 'linkedin'">
                    <editable style="width:100px" v-model="props.row.linkedin" :key="props.row.id" />
                    <small
                        class="text-danger small m-1"
                        v-if="!props.row.linkedin"
                    >Linkedin link is empty.</small>
                </span>
                <div v-else-if="props.column.field == 'button'" class="d-flex mt-5">
                    <button class="btn btn-primary" type="submit" @click="completeLead(props.row)">
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
    import Editable from "../helpers/Editable";

    export default {
        components: { Editable },
        props: ["companies", "leads", "user", "leadEmails", "countries"],

        data() {
            return {
                email_error: [],
                columns: [
                    {
                        label: "First Name",
                        field: "first_name",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Last Name",
                        field: "last_name",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Company Search",
                        field: "company_search",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                        width: "150px",
                    },
                    {
                        label: "Title",
                        field: "title",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Country",
                        field: "country",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                        width: "150px",
                    },
                    {
                        label: "Email",
                        field: "email",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Phone",
                        field: "phone_1",
                        thClass: "th-class",
                        tdClass: "small-wrapper",
                    },
                    {
                        label: "Phone 2",
                        field: "phone_2",
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

        mounted() {
            this.onPageChange();
        },

        methods: {
            onPageChange() {
                this.$nextTick(function () {
                    this.$refs.dataTable.paginated[0].children.map((row) => {
                        ["countryTextarea", 'companyTextarea'].forEach(input =>{
                            let textarea = document.querySelector(
                                `#${input}${row.id}`
                            );
                            textarea.addEventListener("input", autoResize, false);

                            function autoResize(event, textarea = null) {
                                let target = textarea ? textarea : this;

                                target.style.height = "auto";
                                target.style.height = target.scrollHeight + "px";
                            }
                            autoResize(null, textarea);
                        })
                    });
                });
            },

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

            searchCountry(input) {
                if (input.length < 1) {
                    return [];
                }
                return this.countries.filter((country) => {
                    return country.toLowerCase().startsWith(input.toLowerCase());
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
                    phone_2: row.phone_1,
                    country: row.country,
                };

                axios
                    .post(`/lead`, obj)
                    .then((res) => {
                        this.deleteLead(row);
                    })
                    .catch((error) => {
                        this.handleAjaxError(error);
                    });
            },

            deleteLead(row) {
                axios.delete(`/incomplete-leads/${row.id}`).then((res) => {
                    this.rows.splice(row.originalIndex, 1);
                });
            },

            checkIfExists(row) {
                if (this.leadEmails.find((email) => email === row.email)) {
                    this.email_error.push(row.id);
                    return;
                }
                let rowIndex = this.email_error.findIndex((id) => id === row.id);
                if (rowIndex !== -1) {
                    this.email_error.splice(rowIndex, 1);
                }
                // throw error class
            },
        },
    };
</script>

<style scoped>
table.vgt-table td {
    padding: 0;
    vertical-align: center;
    border-bottom: 1px solid #dcdfe6;
    color: #606266;
}

textarea.form-control {
    resize: none;
    background: transparent;
    border: 0;
    text-align: left;
    font-size: 12px;
    color: black;
}

.autocomplete-input {
    padding: 0;
}

.autocomplete-input:focus {
    box-shadow: none;
}

.small {
    font-size: 55%;
}

small {
    position: absolute;
    bottom: 0;
}
.autocomplete-result-list {
    font-size: 12px;
}

.autocomplete-result {
    padding: 0;
    margin: 0;
    background-image: none;
}

</style>

