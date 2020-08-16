<template>
    <div class="row mr-2">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Latest Global Notes</h4>
                    <div class="latest-massage history-col pr-2">
                        <div
                            class="latest-message-list"
                            v-for="note in this.lead.lead.global_notes"
                        >
                            <div class="border-bottom position-relative mt-1">
                                <div class="float-left user mr-3">
                                    <h5
                                        class="bg-primary text-center rounded-circle text-white mt-0"
                                    >{{ note.score }}</h5>
                                </div>
                                <div class="message-time">
                                    <p class="mr-2 text-muted">{{ note.created_at}}</p>
                                </div>
                                <div class="massage-desc">
                                    <h5 class="font-14 mt-0 text-dark">{{ note.user.name }}</h5>
                                    <p class="text-muted">{{ note.note }}</p>
                                </div>
                            </div>
                        </div>
                        <textarea
                            class="form-control mt-2"
                            cols="30"
                            rows="10"
                            placeholder="Write a global note about this lead.."
                            v-model="newGlobalNote"
                        ></textarea>
                        <div class="d-flex justify-content-between">
                            <button
                                class="btn btn-outline-primary mt-1"
                                @click="submitNewNote"
                            >Submit</button>
                            <input
                                type="hidden"
                                class="rating-tooltip score"
                                data-filled="mdi mdi-star font-32 text-primary"
                                data-empty="mdi mdi-star-outline font-32 text-primary"
                                data-fractions="2"
                                data-start="0"
                                data-stop="10"
                                data-step="2"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Recent History</h4>
                    <ol class="activity-feed mb-0 history-col">
                        <li class="feed-item" v-for="activity in lead.activity_history">
                            <div class="feed-item-list">
                                <p class="text-white">Activity: {{activity.type}}</p>
                                <p class="text-white">Outcome: {{activity.outcome.name}}</p>
                                <span
                                    class="date text-white-50"
                                >{{ activity.created_at.replace(/\T(.*)/g, '') }}</span>
                                <span class="activity-text text-white">{{activity.notes}}</span>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Other Leads from {{ lead.lead.company.name }}</h4>
                    <div class="latest-massage history-col">
                        <div
                            class="latest-message-list"
                            v-for="lead in this.lead.lead.company.leads"
                        >
                            <div class="border-bottom position-relative mt-1">
                                <div class="float-left user mr-3">
                                    <h5
                                        class="bg-primary text-center rounded-circle text-white mt-0"
                                    >v</h5>
                                </div>
                                <!-- <div class="message-time"><p class="mr-2 text-muted">Just Now</p></div> -->
                                <div class="massage-desc">
                                    <h5 class="font-14 mt-0 text-dark">{{lead.full_name}}</h5>
                                    <p class="text-muted">{{ lead.title }}</p>
                                </div>
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
        props: ["lead"],

        data() {
            return {
                newGlobalNote: null,
                score: null,
            };
        },

        mounted() {
            let vm = this;
            $("input.score").on("change", function () {
                vm.score = $(this).val();
            });
        },
        methods: {
            submitNewNote() {
                let obj = {
                    lead: this.lead.lead,
                    global_note: this.newGlobalNote,
                    score: this.score,
                };

                axios.post(`/global-note`, obj).then((res) => {
                    this.lead.lead.global_notes.push(res.data)
                    this.newGlobalNote = null
                    this.score = null
                }).catch();
            },
        },
    };
</script>
