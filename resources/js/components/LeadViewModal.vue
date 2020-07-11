<template>
    <div>
        <div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card m-b-30 card-body">
                        <h5 class="card-title mt-0">{{ lead.lead.full_name }} {{ lead.lead.last_name }}</h5>
                        <div class="d-flex justify-content-around">
                            <div>
                                <h6>Company:</h6>
                                <p>{{ lead.lead.company.name }}</p>
                                <hr />
                                <h6>Title:</h6>
                                <p>{{ lead.lead.title }}</p>
                            </div>
                            <div>
                                <h6>Country:</h6>
                                <p>{{ lead.lead.country }}</p>
                                <hr />
                                <h6>Email:</h6>
                                <p>{{ lead.lead.email }}</p>
                            </div>
                            <div>
                                <h6>Phone 1:</h6>
                                <p>{{ lead.lead.phone }}</p>
                                <hr />
                                <h6>Phone 2:</h6>
                                <p>{{ lead.lead.phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-3 p-2 card-body">
                        <div class="d-flex justify-content-center">
                            <div class="social-source-icon lg-icon mr-1">
                                <i class="mdi mdi-phone bg-primary text-white" style="font-size: 60px"></i>
                            </div>
                            <div class="social-source-icon lg-icon mr-1">
                                <i class="mdi mdi-email bg-primary text-white" style="font-size: 60px"></i>
                            </div>
                            <div class="social-source-icon lg-icon mr-1">
                                <i class="mdi mdi-linkedin bg-primary text-white" style="font-size: 60px"></i>
                            </div>
                            <div class="social-source-icon lg-icon mr-1">
                                <i class="mdi mdi-google bg-primary text-white" style="font-size: 60px"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body">
                        Other users who have interacted with this lead.
                        <div class="d-flex mt-2 justify-content-around">

                            <div>
                                <a class="d-flex pr-3" href="#">
                                <img src="/assets/images/users/avatar-3.jpg" alt="" height="40" class="rounded-circle" />
                            </a>
                            <p>User 1</p>
                            </div>
                            <div>
                                <a class="d-flex pr-3" href="#">
                                <img src="/assets/images/users/avatar-3.jpg" alt="" height="40" class="rounded-circle" />
                            </a>
                            <p>User 2</p>
                            </div>
                            <div>
                                <a class="d-flex pr-3" href="#">
                                <img src="/assets/images/users/avatar-3.jpg" alt="" height="40" class="rounded-circle" />
                            </a>
                            <p>User 3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <activity-component
            :step = this.lead.step></activity-component>
            <lead-history
            :lead= this.lead></lead-history>
        </div>
    </div>
</template>

<script>
    import LeadHistory from './LeadHistory';
    import ActivityComponent from './ActivityComponent'

    export default {
        components: { LeadHistory, ActivityComponent },
        props: ['lead'],
    };
</script>

<style></style>
