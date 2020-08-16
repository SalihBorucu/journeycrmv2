<template>
    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="card m-b-30 card-body">
                    <h5 class="card-title mt-0" v-if="editingLeadDetails === false">{{ lead.lead.full_name }}</h5>
                    <input v-else :value="lead.lead.full_name" class="form-control" disabled />
                    <div @click="editingLeadDetails = true" v-if="editingLeadDetails === false">
                        <i
                            class="btn btn-outline-primary mdi mdi-pencil text-primaryfont-16 py-0 px-1 float-right d-none d-md-block"
                        ></i>
                    </div>
                    <div class="d-flex justify-content-between" v-if="editingLeadDetails === false">
                        <div class="mx-2">
                            <h6>Company:</h6>
                            <p>{{ company }}</p>
                            <hr />
                            <h6>Title:</h6>
                            <p>{{ title }}</p>
                        </div>
                        <div class="mx-2">
                            <h6>Country:</h6>
                            <p>{{ country }}</p>
                            <hr />
                            <h6>Email:</h6>
                            <p>{{ email }}</p>
                        </div>
                        <div class="mx-2">
                            <h6>Phone 1:</h6>
                            <p>{{ phone_1 }}</p>
                            <hr />
                            <h6>Phone 2:</h6>
                            <p>{{ phone_2 }}</p>
                        </div>
                    </div>
                    <div v-else>
                        <div class="d-flex justify-content-between">
                            <div class="mx-2">
                                <h6>Company:</h6>
                                <input class="form-control" v-model="company" disabled />
                                <hr />
                                <h6>Title:</h6>
                                <input class="form-control" v-model="title" />
                            </div>
                            <div class="mx-2">
                                <h6>Country:</h6>
                                <input class="form-control" v-model="country" />
                                <hr />
                                <h6>Email:</h6>
                                <input class="form-control" v-model="email" />
                            </div>
                            <div class="mx-2">
                                <h6>Phone 1:</h6>
                                <input class="form-control" v-model="phone_1" />
                                <hr />
                                <h6>Phone 2:</h6>
                                <input class="form-control" v-model="phone_2" />
                            </div>
                        </div>
                        <button class="btn btn-outline-primary mt-2" @click="saveLeadDetails">Save</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3 p-2 card-body">
                    <div class="d-flex justify-content-center">
                        <div class="social-source-icon lg-icon mr-1">
                            <i class="mdi mdi-phone bg-primary text-white" style="font-size: 60px"></i>
                        </div>
                        <a
                            class="social-source-icon lg-icon mr-1"
                            :href="'mailto:' + this.lead.lead.email"
                        >
                            <i class="mdi mdi-email bg-primary text-white" style="font-size: 60px"></i>
                        </a>
                        <a
                            class="social-source-icon lg-icon mr-1"
                            :href="this.lead.lead.linkedin"
                            target="_blank"
                        >
                            <i
                                class="mdi mdi-linkedin bg-primary text-white"
                                style="font-size: 60px"
                            ></i>
                        </a>
                        <a
                            class="social-source-icon lg-icon mr-1"
                            target="_blank"
                            :href="'http://www.google.com/search?q=' + lead.lead.full_name + lead.lead.company.name"
                        >
                            <i class="mdi mdi-google bg-primary text-white" style="font-size: 60px"></i>
                        </a>
                    </div>
                </div>
                <div class="card card-body pt-2 pr-2">
                    <div
                        v-if="!editingCompanyNote"
                        class="d-flex justify-content-between"
                        @click="editingCompanyNote = true"
                    >
                        <h6>About {{ lead.lead.company.name }}:</h6>
                        <div>
                            <i
                                class="btn btn-outline-primary mdi mdi-pencil text-primaryfont-16 py-0 px-1 float-right d-none d-md-block"
                            ></i>
                        </div>
                    </div>
                    <div class="d-flex mt-2 justify-content-around">
                        <div v-if="editingCompanyNote">
                            <textarea class="form-control" cols="60" rows="3" v-model="companyNote"></textarea>
                            <button
                                class="btn btn-outline-primary mt-1"
                                @click="updateCompanyNote"
                            >Submit</button>
                        </div>
                        <p class="card-text" v-else>{{ companyNote }}</p>
                    </div>
                </div>
            </div>
        </div>

        <activity-component
            @activity-complete="$emit('activity-complete', lead.id)"
            :lead="this.lead"
            :step="this.lead.step"
        ></activity-component>

        <lead-history :lead="this.lead"></lead-history>
    </div>
</template>

<script>
    import LeadHistory from "./LeadHistory";
    import ActivityComponent from "./ActivityComponent";

    export default {
        components: { LeadHistory, ActivityComponent },
        props: ["lead"],

        data() {
            return {
                editingCompanyNote: false,
                editingLeadDetails: false,
                company: this.lead.lead.company.name,
                country: this.lead.lead.country,
                phone_1: this.lead.lead.phone_1,
                title: this.lead.lead.title,
                email: this.lead.lead.email,
                phone_2: this.lead.lead.phone_2,
                companyNote: this.lead.lead.company.tools_note,
            };
        },

        watch: {
            lead(){
                this.company = this.lead.lead.company.name;
                this.country = this.lead.lead.country;
                this.phone_1 = this.lead.lead.phone_1;
                this.title = this.lead.lead.title;
                this.email = this.lead.lead.email;
                this.phone_2 = this.lead.lead.phone_2;
            }
        },

        methods: {
            updateCompanyNote() {
                let obj = {
                    tools_note: this.companyNote,
                };
                axios
                    .patch(`/company/${this.lead.lead.company.id}`, obj)
                    .then((res) => {
                        (this.editingCompanyNote = false),
                            (this.companyNote = res.data);
                    });
            },

            saveLeadDetails() {
                let obj = {
                    company: this.company,
                    country: this.country,
                    phone_1: this.phone_1,
                    title: this.title,
                    email: this.email,
                    phone_2: this.phone_2,
                };

                axios.patch(`/lead/${this.lead.lead.id}`, obj).then((res) => {
                    this.company = res.data.lead.company.name;
                    this.country = res.data.lead.country;
                    this.phone_1 = res.data.lead.phone_1;
                    this.title = res.data.lead.title;
                    this.email = res.data.lead.email;
                    this.phone_2 = res.data.lead.phone_2;

                    this.editingLeadDetails = false;
                });
            },
        },
    };
</script>
