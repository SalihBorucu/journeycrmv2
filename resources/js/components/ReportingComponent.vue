<template>
    <div class="jumbotron">
        <h1>Under Construction</h1>
        <h4 class="page-title mb-2">Reporting</h4>
        <div class="row">
            <div class="w-100">
                <div class="card m-b-30 card-body">
                    <div class="d-flex justify-content-around mb-2">
                        <div class="w-100 mx-2">
                            <label for="">Report Type</label>
                            <select class="form-control" v-model="reportType">
                                <option value="activitiesUser">Activities By User</option>
                                <option value="activitiesByAccount">Activities By Account</option>
                                <option value="resultsUser">Results By User</option>
                                <option value="resultsByAccount">Results By Accounts</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around mb-2" v-if="reportType === 'activitiesUser'">
                        <div class="w-100 mx-2">
                            <label for="">Account</label>
                            <select class="form-control" v-model="account" @change="selectedAccount">
                                <option value="null"></option>
                                <option :value="account.id" v-for="account in accounts">{{ account.name }}</option>
                            </select>
                        </div>
                        <div class="w-100 mx-2">
                            <label for="">Campaign</label>
                            <select class="form-control" v-model="campaign">
                                <option value="null"></option>
                                <option :value="campaign.id" v-for="campaign in campaigns">{{ campaign.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around mb-2">
                        <div class="w-100 mx-2">
                            <label for="example-date-input">Starting Date</label>
                            <input class="form-control" type="date" v-model="start_date" />
                        </div>
                        <div class="w-100 mx-2">
                            <label for="example-date-input">End Date</label>
                            <input class="form-control" type="date" v-model="end_date" />
                        </div>
                    </div>
                    <button @click="getResults" class="btn btn-primary waves-effect waves-light w-100 mt-3">See Results</button>
                </div>
            </div>
        </div>
        <results-component v-if="results" :results="results"></results-component>
    </div>
</template>

<script>
    import axios from 'axios';
    import ResultsComponent from './ResultsComponent';
    export default {
        components: { ResultsComponent },
        props: ['accounts', 'campaignsInj', 'companiesInj', 'resultsInj'],
        data() {
            return {
                reportType: null,
                campaigns: this.campaignsInj.slice(),
                companies: this.companiesInj.slice(), //consider virtual scroller since it is slow with full
                account: 3,
                campaign: 1,
                start_date: null,
                end_date: null,
                results: null,
            };
        },

        methods: {
            getResults() {
                let obj = {
                    report_type: this.reportType,
                    account: this.account,
                    campaign: this.campaign,
                    activity_type: this.activity_type,
                    start_date: this.start_date,
                    end_date: this.end_date,
                };

                axios.post(`/reporting`, obj).then((res) => {
                    this.$router.push({
                        path: this.$route.fullPath,
                        query: obj,
                    });
                    this.results = res.data.activitiesByUser;
                });
            },

            selectedAccount() {
                this.campaigns = this.accounts.find((account) => account.id === this.account).account_campaigns.map((accountCampaign) => accountCampaign.campaign);
            },
        },
    };
</script>
