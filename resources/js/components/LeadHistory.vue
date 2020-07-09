<template>
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Latest Global Notes</h4>
                    <div class="latest-massage history-col">
                        <a href="#" class="latest-message-list" v-for="lead in this.lead.lead.global_notes">
                            <div class="border-bottom position-relative">
                                <div class="float-left user mr-3"><h5 class="bg-primary text-center rounded-circle text-white mt-0">v</h5></div>
                                <div class="message-time"><p class="mr-2 text-muted">Just Now</p></div>
                                <div class="massage-desc">
                                    <h5 class="font-14 mt-0 text-dark">Victor Zamora</h5>
                                    <p class="text-muted">Hey! there I'm available...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Recent History</h4>
                    <ol class="activity-feed mb-0 history-col">
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date text-white-50">Jan 10</span>
                                <span class="activity-text text-white">Responded to need “Volunteer Activities”</span>
                            </div>
                        </li>
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date text-white-50">Jan 09</span>
                                <span class="activity-text text-white">Added an interest “Volunteer Activities”</span>
                            </div>
                        </li>
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date text-white-50">Jan 08</span>
                                <span class="activity-text text-white">Joined the group “Boardsmanship Forum”</span>
                            </div>
                        </li>
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <span class="date text-white-50">Jan 07</span>
                                <span class="activity-text text-white">Responded to need “In-Kind Opportunity”</span>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Other Leads In CompanyX</h4>
                    <div class="latest-massage history-col">
                        <a href="#" class="latest-message-list">
                            <div class="border-bottom position-relative">
                                <div class="float-left user mr-3"><h5 class="bg-primary text-center rounded-circle text-white mt-0">v</h5></div>
                                <div class="message-time"><p class="mr-2 text-muted">Just Now</p></div>
                                <div class="massage-desc">
                                    <h5 class="font-14 mt-0 text-dark">Victor Zamora</h5>
                                    <p class="text-muted">Hey! there I'm available...</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['lead'],
    };
</script>

<style>
    .history-col {
        max-height: 367px;
        overflow-y: scroll;
        overflow: auto;
    }

</style>
