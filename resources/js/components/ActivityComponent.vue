<template>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">New {{ step.type }}</h4>
                    <div v-if="step.type === 'email'">
                        <input type="text" class="form-control mb-1" placeholder="Email Topic" />
                        <div class="summernote"></div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light w-100 mt-3">Send Mail</button>
                    </div>
                    <div v-if="step.type === 'social'">
                        <p>This will be where the social media message template will be. Nice to meet you my name is Lalala and I am from Lalala</p>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary waves-effect waves-light w-100 mt-3">Message Sent</button>
                            <button type="submit" class="btn btn-danger waves-effect waves-light w-100 mt-3">Unable to Send Message</button>
                        </div>
                    </div>
                    <div v-if="step.type === 'call'">
                        <div class="">
                            <button class="btn btn-success mb-3">
                                <i class="mdi mdi-phone mr-1"></i>
                                Call
                            </button>
                            <p>
                                This is where the call pointers would be when are available for each client and campaign etc. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam a porttitor
                                mauris. Phasellus commodo orci vitae mi bibendum, sed sodales eros vulputate. Morbi et eleifend enim. Sed congue mauris non purus feugiat, non pharetra lectus dapibus.
                                Quisque elementum auctor sem, eu consequat arcu molestie eget. Mauris ut lobortis eros. Nulla luctus arcu justo, et ultricies lectus congue laoreet. Pellentesque quis
                                eros sem. Cras lacinia iaculis odio in mattis. Sed at justo lectus. Donec mattis felis in leo finibus malesuada. Praesent at metus dapibus, blandit lacus mattis,
                                ultricies erat. Aliquam tempor arcu risus, ac lobortis odio eleifend at. Phasellus sed enim vitae enim vulputate euismod. Sed facilisis a est non sagittis. Vestibulum
                                sit amet felis tincidunt, finibus ex quis, egestas ex. Proin a quam viverra, vulputate dui ac, vulputate nibh. Mauris eleifend nec justo ac tincidunt. Pellentesque non
                                viverra nunc. Aliquam congue tellus id suscipit sagittis. Etiam in est convallis, faucibus velit at, luctus eros. Aenean pulvinar mauris magna, ut venenatis elit
                                iaculis vitae. Aenean non lacus maximus, commodo purus accumsan, condimentum neque. Ut efficitur ut libero quis bibendum. Quisque pharetra pulvinar velit, at
                                ullamcorper dolor commodo at. Quisque dictum leo non tellus commodo fermentum. Sed fermentum leo erat, in volutpat eros porttitor a.
                            </p>
                        </div>
                        <textarea v-model="call_notes" id="textarea" class="form-control" maxlength="2000" rows="3" placeholder="Your notes.."></textarea>
                        <div class="button-items d-flex justify-content-center mt-3" v-if="!callback_active">
                            <!-- <button type="button" class="btn btn-outline-primary waves-effect waves-light">Primary</button> -->
                            <button @click="submitOutcome" type="button" value="2" class="btn btn-outline-secondary waves-effect">No Answer</button>
                            <button @click="callback_active = true" type="button"  class="btn btn-outline-info waves-effect">Call Back</button>
                            <button @click="submitOutcome" type="button" value="4" class="btn btn-outline-primary waves-effect">Interested</button>
                            <button @click="submitOutcome" type="button" value="5" class="btn btn-outline-success waves-effect">Qualified</button>
                            <button @click="submitOutcome" type="button" value="6" class="btn btn-outline-warning waves-effect">Email Only</button>
                            <button @click="submitOutcome" type="button" value="1" class="btn btn-outline-danger waves-effect">DNC</button>
                        </div>
                        <div v-else class="d-flex flex-column align-items-center">
                            <p>Create New Next Activity:</p>
                            <div class="d-flex justify-content-center m-2">
                                <label class="m-1">Due Date</label>
                                <div class="w-25">
                                    <input class="form-control" type="date" name="due_date" v-model="custom_activity_date"/>
                                </div>
                                <label class="m-1">Activity Type</label>
                                <select class="form-control w-25" name="activity_type" v-model="custom_activity_type">
                                    <option value="0">Email</option>
                                    <option value="1">Social</option>
                                    <option value="2">Phone</option>
                                </select>
                            </div>
                            <button @click="submitOutcome" type="button" class="btn btn-outline-primary waves-effect waves-light" value="3">Set New Activity</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: ['step', 'lead'],

        data() {
            return {
                call_notes: null,
                custom_activity_type: null,
                custom_activity_date: null,
                callback_active: false,
            };
        },

        mounted() {
            $('.summernote').summernote({
                height: 300, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: true, // set focus to editable area after initializing summernote
            });
        },

        methods: {
            submitOutcome() {
                let obj = {
                    outcome: event.target.value,
                    lead: this.lead,
                    call_notes: this.call_notes,
                    custom_activity_type: this.custom_activity_type,
                    custom_activity_date: this.custom_activity_date,
                };

                axios.post(`/activity`, obj).then((res) => {
                    this.call_notes = null;
                    this.$emit('activity-complete', this.lead.id);
                });
            },
        },
    };
</script>
