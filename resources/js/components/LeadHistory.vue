<template>
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Latest Global Notes</h4>
                    <div class="latest-massage">
                        <a href="#" class="latest-message-list" v-for="lead in this.lead.lead.global_notes">
                            <div class="border-bottom position-relative">
                                <div class="float-left user mr-3"><h5 class="bg-primary text-center rounded-circle text-white mt-0">v</h5></div>
                                <div class="message-time"><p class="m-0 text-muted">Just Now</p></div>
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
                    <ol class="activity-feed mb-0">
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
                    <h4 class="mt-0 header-title mb-4">Social Source</h4>
                    <div class="text-center">
                        <div class="social-source-icon lg-icon mb-3"><i class="mdi mdi-facebook h2 bg-primary text-white"></i></div>
                        <h5 class="font-16">
                            <a href="#" class="text-dark">
                                Facebook -
                                <span class="text-muted">125 sales</span>
                            </a>
                        </h5>
                        <p class="text-muted">Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis tincidunt.</p>
                        <a href="#" class="text-primary font-14">
                            Learn more
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="social-source text-center mt-3">
                                <div class="social-source-icon mb-2"><i class="mdi mdi-facebook h5 bg-primary text-white"></i></div>
                                <p class="font-14 text-muted mb-2">125 sales</p>
                                <h6>Facebook</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="social-source text-center mt-3">
                                <div class="social-source-icon mb-2"><i class="mdi mdi-twitter h5 bg-info text-white"></i></div>
                                <p class="font-14 text-muted mb-2">112 sales</p>
                                <h6>Twitter</h6>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="social-source text-center mt-3">
                                <div class="social-source-icon mb-2"><i class="mdi mdi-instagram h5 bg-pink text-white"></i></div>
                                <p class="font-14 text-muted mb-2">104 sales</p>
                                <h6>Instagram</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['lead']
}
</script>
