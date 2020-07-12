<template>
    <div class="row">
        <div class="col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">Line Chart</h4>
                    <p class="text-muted m-b-30 d-inline-block text-truncate w-100">
                        The public API is terribly simple. It's just one function: Morris.Line (options), where options is an object containing some of the configuration options.
                    </p>

                    <ul class="list-inline widget-chart m-t-20 m-b-15 text-center">
                        <li class="list-inline-item">
                            <h5>3654</h5>
                            <p class="text-muted">Marketplace</p>
                        </li>
                        <li class="list-inline-item">
                            <h5>954</h5>
                            <p class="text-muted">Last week</p>
                        </li>
                        <li class="list-inline-item">
                            <h5>8462</h5>
                            <p class="text-muted">Last Month</p>
                        </li>
                    </ul>
                    <bar-chart id="bar" :data="barData" resize="true" xkey="type" bar-colors='["#2BCCA4", "#fdba45", "#a462e0"]'></bar-chart>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</template>

<script>
    import Raphael from 'raphael/raphael';
    global.Raphael = Raphael;
    import { BarChart } from 'vue-morris';
    export default {
        components: {
            BarChart,
        },

        props: ['results'],

        data() {
            return {
                barData: [
                    { type: 'email', value: 300 },
                    { type: 'social', value: 50 },
                    { type: 'call', value: 100 },
                ],
            };
        },

        computed: {
            types() {},
        },
    };
</script>
