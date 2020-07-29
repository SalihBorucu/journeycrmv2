<template>
    <div class="w-100">
        <div class="card card-body">
            <h4 class="page-title mb-2">New Lead</h4>
            <div class="d-flex justify-content-around mb-2">
                <div class="w-100 mx-2">
                    <label for>First Name</label>
                    <input
                        :class="[this.first_name === '' ? 'form-control-danger' : '', 'form-control']"
                        v-model="first_name"
                    />
                </div>
                <div class="w-100 mx-2">
                    <label for>Last Name</label>
                    <input
                        :class="[this.last_name === '' ? 'form-control-danger' : '', 'form-control']"
                        v-model="last_name"
                    />
                </div>

                <div class="w-100 mx-2">
                    <label for>Company</label>
                    <autocomplete
                        id="company-field"
                        @blur="setCompanyName"
                        :search="searchCompany"
                        placeholder="Search for a company"
                        aria-label="Search for a company"
                    ></autocomplete>
                    <small
                        v-if="creating_new_company"
                        class="form-control-feedback text-warning"
                    >This company does not exist, creating new.</small>
                </div>
            </div>
            <div class="d-flex justify-content-around mb-2">
                <div class="w-100 mx-2">
                    <label for>Email</label>
                    <input
                        :class="[this.email === '' ? 'form-control-danger' : '', 'form-control']"
                        type="email"
                        v-model="email"
                        @blur="checkIfExists"
                    />
                    <small
                        v-if="email_error"
                        class="form-control-feedback text-danger"
                    >This email is already used, potential duplicate lead.</small>
                </div>
                <div class="w-100 mx-2">
                    <label for>Title</label>
                    <input
                        :class="[this.title === '' ? 'form-control-danger' : '', 'form-control']"
                        v-model="title"
                    />
                </div>
                <div class="w-100 mx-2">
                    <label for>Linkedin</label>
                    <input
                        :class="[this.linkedin === '' ? 'form-control-danger' : '', 'form-control']"
                        type="url"
                        v-model="linkedin"
                    />
                </div>
            </div>
            <div class="d-flex justify-content-around mb-2">
                <div class="w-100 mx-2">
                    <label for>Phone 1</label>
                    <input
                        :class="[this.phone_1 === '' ? 'form-control-danger' : '', 'form-control']"
                        type="tel"
                        v-model="phone_1"
                    />
                </div>
                <div class="w-100 mx-2">
                    <label for>Phone 2</label>
                    <input type="tel" class="form-control" v-model="phone_2" />
                </div>
                <div class="w-100 mx-2">
                    <label for>Country</label>
                    <autocomplete @blur="setCountryName" :search="searchCountry"></autocomplete>
                </div>
            </div>
            <div class="alert alert-danger mb-0" role="alert" v-if="this.empty_fields_error">
                <strong>Oh snap!</strong> There seems to be some empty fields and try submitting again.
            </div>
            <button
                @click="createLead"
                type="submit"
                class="btn btn-primary waves-effect waves-light w-100 mt-3"
            >Create Lead</button>
        </div>
    </div>
</template>

<script>

    export default {
        props: ["companies", "countries", "leadEmails"],
        data() {
            return {
                creating_new_company: false,
                email_error: false,
                empty_fields_error: false,

                first_name: null,
                last_name: null,
                company: null,
                email: null,
                title: null,
                phone_1: null,
                phone_2: null,
                country: null,
                linkedin: null,
            };
        },
        mounted() {
            $(".autocomplete-input").attr("class", "form-control");
        },

        watch: {
            company: function () {
                if (this.company === "") {
                    $('input[aria-owns="autocomplete-result-list-1"]').attr(
                        "class",
                        "form-control-danger form-control"
                    );
                } else {
                    $('input[aria-owns="autocomplete-result-list-1"]').attr(
                        "class",
                        "form-control"
                    );
                }
            },

            country: function () {
                if (this.country === "") {
                    $('input[aria-owns="autocomplete-result-list-2"]').attr(
                        "class",
                        "form-control-danger form-control"
                    );
                } else {
                    $('input[aria-owns="autocomplete-result-list-2"]').attr(
                        "class",
                        "form-control"
                    );
                }
            },
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
                if (
                    !this.companies.find((company) => company.name === this.company)
                ) {
                    this.creating_new_company = true;
                }
            },

            setCountryName() {
                this.country = event.target.value;
            },

            createLead() {
                let obj = {
                    first_name: this.first_name,
                    last_name: this.last_name,
                    company: this.companies.find(
                        (company) => company.name === this.company
                    )
                        ? this.companies.find(
                              (company) => company.name === this.company
                          ).id
                        : this.company, //try and refactor
                    email: this.email,
                    title: this.title,
                    linkedin: this.linkedin,
                    phone_1: this.phone_1,
                    country: this.country,
                };
                if (!Object.keys(obj).some((key) => !!obj[key])) {
                    Object.keys(obj).map((key) => {
                        if (!obj[key]) {
                            this[key] = "";
                        }
                    });
                    this.empty_fields_error = true;
                    return;
                }

                if (this.email_error) {
                    this.email = '';
                    this.empty_fields_error = true;
                    return;
                }

                obj["phone_2"] = this.phone_2;

                axios.post(`/lead`, obj).then((res) => {
                    this.creating_new_company = false;
                    this.email_error = false;
                    this.empty_fields_error = false;

                    this.first_name = null;
                    this.last_name = null;
                    this.company = null;
                    this.email = null;
                    this.title = null;
                    this.phone_1 = null;
                    this.phone_2 = null;
                    this.country = null;
                    this.linkedin = null;
                });
            },

            checkIfExists() {
                if (this.leadEmails.find((email) => email === this.email)) {
                    this.email_error = true;
                    event.target.className = "form-control form-control-danger";
                    return;
                }

                this.email_error = false;
                event.target.className = "form-control";
                // throw error class
            },
        },
    };
</script>

