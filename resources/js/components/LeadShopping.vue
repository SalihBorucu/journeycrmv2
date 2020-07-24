<template>
    <div>
        <h1>Under construction</h1>
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
                        <autocomplete @blur="setCountryName" :search="searchCountry"></autocomplete>
                    </div>
                </div>
                <button
                    @click="searchForLeads"
                    type="submit"
                    class="btn btn-primary waves-effect waves-light w-100 mt-3"
                >Search For Leads</button>
            </div>
        </div>
    </div>
</template>
<script>
    import "vue-good-table/dist/vue-good-table.css";
    import { VueGoodTable } from "vue-good-table";
    import axios from "axios";

    export default {
        props: ["companies", "countries"],

        data() {
            return {
                company: null,
                country: null,
                first_name: null,
                last_name: null,
                title: null,
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
                this.company = event.target.value;
            },

            setCountryName() {
                this.country = event.target.value;
            },

            searchForLeads() {
                let obj = {
                    company: this.company,
                    country: this.country,
                    first_name: this.first_name,
                    last_name: this.last_name,
                    title: this.title,
                };

                axios
                    .get(`/lead/lead-shopping`, {
                        params: obj,
                    })
                    .then((res) => {});
            },
        },
    };
</script>
