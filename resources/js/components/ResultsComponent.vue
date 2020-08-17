<template>
    <div class="row">
        <div class="col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                        <div v-if="totalCalls">
                            <li class="list-inline-item">
                                <h5>{{this.totalEmails}}</h5>
                                <p class="text-muted">Emails</p>
                            </li>
                            <li class="list-inline-item">
                                <h5>{{this.totalSocials}}</h5>
                                <p class="text-muted">Social</p>
                            </li>
                            <li class="list-inline-item">
                                <h5>{{this.totalCalls}}</h5>
                                <p class="text-muted">Calls</p>
                            </li>
                        </div>
                        <div v-else>
                            <li class="list-inline-item">
                                <h5>{{this.totalActivities}}</h5>
                                <p class="text-muted">Activities</p>
                            </li>
                            <li class="list-inline-item">
                                <h5>{{this.totalInterested}}</h5>
                                <p class="text-muted">Interest</p>
                            </li>
                            <li class="list-inline-item">
                                <h5>{{this.totalQualified}}</h5>
                                <p class="text-muted">Booked Meetings</p>
                            </li>
                        </div>
                    </ul>
                    <bar-chart
                        id="bar"
                        :data="barData"
                        resize="true"
                        xkey="type"
                        :ykeys="ykeys"
                        :labels="ykeys"
                        bar-colors='["#2BCCA4", "#fdba45", "#a462e0"]'
                    ></bar-chart>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Raphael from "raphael/raphael";
    global.Raphael = Raphael;
    import { BarChart } from "vue-morris";
    export default {
        components: {
            BarChart,
        },

        props: ["results"],

        data() {
            return {
                barData: this.results,
                ykeys: Object.keys(this.results[0]).filter((key) => key !== "type"),
            };
        },

        computed: {
            totalEmails() {
                return this.results.reduce((a, b) => {
                    return a + b.email;
                }, 0);
            },
            totalCalls() {
                return this.results.reduce((a, b) => {
                    return a + b.call;
                }, 0);
            },
            totalSocials() {
                return this.results.reduce((a, b) => {
                    return a + b.social;
                }, 0);
            },
            totalQualified() {
                return this.results.reduce((a, b) => {
                    return a + b.Qualified;
                }, 0);
            },
            totalInterested() {
                return this.results.reduce((a, b) => {
                    return a + b.Interested;
                }, 0);
            },
            totalActivities() {
                let arr1 =  this.results.map(obj => {
                    return Object.keys(obj).map(key=>{
                        if(key === 'type'){return 0}
                        return obj[key]
                    })
                })

                let arr2 =  arr1.map(smallArr => {
                    return smallArr.reduce((a, b) => {
                        return a + b;
                }, 0);
                })

                return arr2.reduce((a, b) => {
                    return a + b;
                }, 0);
            },
        },

        watch: {
            results() {
                this.barData = this.results;
                this.ykeys = Object.keys(this.results[0]).filter(
                    (key) => key !== "type"
                );
            },
        },
    };
</script>
