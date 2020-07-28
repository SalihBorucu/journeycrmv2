<template>
    <div>
        <!-- <h1>Under construction</h1> -->
        <div class="w-100">
            <div class="card card-body">
                <h4 class="page-title mb-2">New Lead</h4>
                <div class="d-flex justify-content-around mb-2">
                    <div class="w-100 mx-2">
                        <label for>First Name</label>
                        <input class="form-control" v-model="first_name" />
                    </div>
                    <div class="w-100 mx-2">
                        <label for>Last Name</label>
                        <input class="form-control" v-model="last_name" />
                    </div>
                </div>
                <div class="d-flex justify-content-around mb-2">
                    <div class="w-100 mx-2">
                        <label for>Company</label>
                        <autocomplete
                            id="company-field"
                            @blur="setCompanyName"
                            :search="searchCompany"
                            :default-value="this.companies.find(company => company.id == this.company_query_id) ? this.companies.find(company => company.id == this.company_query_id).name : null"
                            placeholder="Search for a company"
                            aria-label="Search for a company"
                        ></autocomplete>
                    </div>
                    <div class="w-100 mx-2">
                        <label for>Title</label>
                        <input class="form-control" v-model="title" />
                    </div>
                    <div class="w-100 mx-2">
                        <label for>Country</label>
                        <autocomplete @blur="setCountryName" :search="searchCountry" :default-value="this.$route.query.country"></autocomplete>
                    </div>
                </div>
                <div class="alert alert-warning" role="alert" v-if="no_selection_error">
                    <strong>Warning!</strong> You haven't specified any filters.
                </div>
                <button
                    @click="searchForLeads"
                    type="submit"
                    class="btn btn-primary waves-effect waves-light w-100 mt-3"
                >Search For Leads</button>
            </div>
            <assign-leads-table v-if="leads.length" :leads="leads" :user="user"></assign-leads-table>
        </div>
    </div>
</template>
<script>
    import "vue-good-table/dist/vue-good-table.css";
    import { VueGoodTable } from "vue-good-table";
    import axios from "axios";
    import AssignLeadsTable from "./AssignLeadsTable";

    export default {
        components: { AssignLeadsTable },
        props: ["companies", "countries", "user", "injLeads"],

        data() {
            return {
                no_selection_error: false,
                company_query_id: this.$route.query.company,
                leads: this.injLeads.slice(""),
                company: null,
                country: this.$route.query.country || null,
                first_name: this.$route.query.first_name || null,
                last_name: this.$route.query.last_name || null,
                title: this.$route.query.title || null,
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

            searchCountry(input) {
                if (input.length < 1) {
                    return [];
                }
                return this.countries.filter((country) => {
                    return country.toLowerCase().startsWith(input.toLowerCase());
                });
            },

            setCompanyName() {
                if (!event.target.value) {
                    this.company = event.target.value;
                    return;
                }
                this.company = this.companies.find(
                    (company) => company.name === event.target.value
                ).id;
            },

            setCountryName() {
                if (!event.target.value) {
                    this.country = event.target.value;
                    return;
                }
                this.country = event.target.value;
            },

            searchForLeads() {
                this.no_selection_error = false;

                let obj = {
                    company: this.company,
                    country: this.country,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    title: this.title,
                };

                if (Object.keys(obj).every((key) => !obj[key])) {
                    this.no_selection_error = true;
                    return;
                }

                axios.post(`/lead/lead-shopping`, obj).then((res) => {
                    this.$router
                        .push({
                            path: this.$route.fullPath,
                            query: {
                                company: obj.company,
                                country: obj.country,
                                first_name: obj.first_name,
                                last_name: obj.last_name,
                                title: obj.title,
                            },
                        })
                        .catch(() => {});

                    this.leads = res.data;
                });
            },
        },
    };
</script>
