<template>
    <div>
        <a class="outside-toggle-wrapper" @click="sidebarOpen = !sidebarOpen" v-if="!sidebarOpen">
            <i class="mdi mdi-arrow-right text-white toggle-button btn btn-primary waves-effect waves-light"></i>
        </a>
        <div class="sidebar card" v-if="sidebarOpen">
            <a class="toggle-wrapper" @click="sidebarOpen = !sidebarOpen"><i class="mdi mdi-arrow-left text-white toggle-button btn btn-primary waves-effect waves-light"></i></a>
            <div class="">
                <h3 class="m-2">Adjust Filters</h3>
                <div class="m-2">
                    <label for="">Activity Type</label>
                    <select class="form-control" name="activity_type" v-model="previous_request.activity_type">
                        <option value="email">Email</option>
                        <option value="social">Social</option>
                        <option value="call">Phone</option>
                    </select>
                </div>
                <div class="m-2">
                    <label for="">Lead Stage</label>
                    <select class="form-control" name="lead_stage" v-model="previous_request.lead_stage">
                        <option value="prospecting">Prospecting</option>
                        <option value="interested">Interested</option>
                        <option value="qualified">Qualified</option>
                    </select>
                </div>

                <div class="m-2">
                    <label for="">Country</label>
                    <select class="form-control" name="country">
                        <option value="united_kingdom">United Kingdom</option>
                    </select>
                </div>
            </div>

            <div class="mb-2">
                <div class="m-2">
                    <label for="example-date-input">Starting Date</label>
                    <input class="form-control" type="date" name="start_date" id="start_date" v-model="previous_request.start_date" />
                </div>

                <div class="m-2">
                    <label for="example-date-input">End Date</label>
                    <input class="form-control" type="date" name="end_date" id="end_date" v-model="previous_request.end_date" />
                </div>
                <button @click="adjustSearch" class="btn btn-primary waves-effect waves-light w-100 mt-3">Adjust Search</button>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        props: ['previous_request_inj', 'campaign_id'],
        data() {
            return {
                previous_request: this.previous_request_inj,
                sidebarOpen: false,
            };
        },
        methods: {
            adjustSearch() {
                let obj = this.previous_request;

                axios
                    .get(`/activities/campaign/${this.campaign_id}`, {
                        params: obj,
                    })
                    .then((res) => {
                        window.location.href = res.request.responseURL;
                    });
            },
        },
    };
</script>

<style>
    .toggle-wrapper {
        position: relative;
    }

    .outside-toggle-wrapper {
        position: absolute;
        left: 40;
        top: 10%;
    }

    .toggle-button {
        padding: 0;
        font-size: 40px;
        position: absolute;
        right: 0;
        top: -15;
    }

    .sidebar {
        z-index: 30;
        position: absolute !important;
        top: 61px;
        left: 0;
        width: 15vw;
        height: 90vh;
        min-height: 500px;
        padding-top: 5vh;
    }
</style>
