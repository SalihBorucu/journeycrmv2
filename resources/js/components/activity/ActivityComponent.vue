<template>
    <div class="row">
        <div class="col-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title">New {{ step.type }}</h4>
                    <div v-if="step.type === 'email'">
                        <input
                            type="text"
                            class="form-control mb-1"
                            placeholder="Email Subject"
                            v-model="email_subject"
                        />
                        <div class="summernote"></div>
                        <div class="d-flex">
                            <label for="attachment" class="btn btn-primary">Attachment</label>
                            <span
                                :value="index"
                                :key="index"
                                class="badge badge-default m-2 h-25 p-2"
                                v-for="(attachment, index) in this.attachments"
                            >{{ attachment }}</span>
                            <input
                                type="file"
                                id="attachment"
                                style="display: none;"
                                @change="attachmentChanged"
                                multiple
                            />
                        </div>
                        <button
                            @click="sendEmail"
                            value="7"
                            type="submit"
                            class="btn btn-primary waves-effect waves-light w-100 mt-3"
                        >Send Mail</button>
                    </div>
                    <div v-if="step.type === 'social'">
                        <textarea
                            v-model="notes"
                            id="textarea"
                            class="form-control"
                            maxlength="2000"
                            rows="3"
                        ></textarea>
                        <div class="d-flex justify-content-center">
                            <button
                                @click="submitOutcome(null)"
                                type="submit"
                                value="7"
                                class="btn btn-primary waves-effect waves-light w-100 mt-3 mx-2"
                            >Message Sent</button>
                            <button
                                @click="submitOutcome(null)"
                                type="submit"
                                class="btn btn-danger waves-effect waves-light w-100 mt-3 mx-2"
                                value="8"
                            >Unable to Send Message</button>
                        </div>
                    </div>
                    <div v-if="step.type === 'call'">
                        <div class="d-flex mb-2">
                            <call-component :lead="this.lead" @call-started="call_started = true"></call-component>
                            <p class="card-text">{{ lead.step.template.pointer }}</p>
                        </div>
                        <textarea
                            id="textarea"
                            class="form-control"
                            maxlength="2000"
                            rows="3"
                            placeholder="Your notes.."
                        ></textarea>
                        <div
                            class="button-items d-flex justify-content-center mt-3"
                            v-if="!callback_active"
                        >
                            <div>
                                <button
                                    v-if="call_started"
                                    @click="submitOutcome(null)"
                                    type="button"
                                    value="2"
                                    class="btn btn-outline-secondary waves-effect"
                                >No Answer</button>
                                <button
                                    @click="callback_active = true"
                                    type="button"
                                    class="btn btn-outline-info waves-effect"
                                >Call Back</button>
                                <button
                                    @click="submitOutcome(null)"
                                    type="button"
                                    value="4"
                                    class="btn btn-outline-primary waves-effect"
                                >Interested</button>
                                <button
                                    @click="submitOutcome(null)"
                                    type="button"
                                    value="5"
                                    class="btn btn-outline-success waves-effect"
                                >Qualified</button>
                                <button
                                    @click="submitOutcome(null)"
                                    type="button"
                                    value="6"
                                    class="btn btn-outline-warning waves-effect"
                                >Email Only</button>
                                <button
                                    @click="submitOutcome(null)"
                                    type="button"
                                    value="1"
                                    class="btn btn-outline-danger waves-effect"
                                >DNC</button>
                            </div>
                        </div>
                        <div v-else class="d-flex flex-column align-items-center">
                            <p>Create New Next Activity:</p>
                            <div class="d-flex justify-content-center m-2">
                                <label class="m-1">Due Date</label>
                                <div class="w-25">
                                    <input
                                        class="form-control"
                                        type="date"
                                        name="due_date"
                                        v-model="custom_activity_date"
                                    />
                                </div>
                                <label class="m-1">Activity Type</label>
                                <select
                                    class="form-control w-25"
                                    name="activity_type"
                                    v-model="custom_activity_type"
                                >
                                    <option value="email">Email</option>
                                    <option value="social">Social</option>
                                    <option value="call">Phone</option>
                                </select>
                            </div>
                            <button
                                @click="submitOutcome(null)"
                                type="button"
                                class="btn btn-outline-primary waves-effect waves-light"
                                value="3"
                            >Set New Activity</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import CallComponent from "./CallComponent";
    export default {
        components: { CallComponent },
        props: ["step", "lead"],

        data() {
            return {
                attachments: [],
                call_started: false,
                email_subject: this.lead.step.template.email_subject,
                notes: this.lead.step.template.pointer,
                custom_activity_type: null,
                custom_activity_date: null,
                callback_active: false,
                email_content: this.lead.step.template.email_content,
            };
        },

        mounted() {
            $(".summernote").summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true,
            });
            $(".summernote").summernote("code", this.processedEmailContent);
        },

        watch: {
            lead() {
                this.call_started = false;
                this.custom_activity_type = null;
                this.custom_activity_date = null;
                this.email_subject = this.lead.step.template.email_subject;
                this.notes = this.lead.step.template.pointer;
                $(".summernote").summernote("code", this.processedEmailContent);
            },
        },

        computed: {
            processedEmailContent() {
                let content = this.email_content;
                content = content.replace(
                    "$lead_first_name",
                    this.lead.lead.first_name
                );
                content = content.replace(
                    "$lead_last_name",
                    this.lead.lead.last_name
                );
                content = content.replace(
                    "$lead_full_name",
                    this.lead.lead.full_name
                );
                content = content.replace("$lead_country", this.lead.lead.country);
                content = content.replace("$lead_title", this.lead.lead.title);
                content = content.replace(
                    "$lead_company",
                    this.lead.lead.company.name
                );
                content = content.replace(
                    "$lead_company_tools",
                    this.lead.lead.company.tools_note
                );

                return content;
            },
        },

        methods: {
            submitOutcome(outcome) {
                this.callback_active = false;

                if (outcome === null) {
                    outcome = event.target.value;
                }

                let obj = {
                    outcome,
                    lead: this.lead,
                    notes: this.notes,
                    custom_activity_type: this.custom_activity_type,
                    custom_activity_date: this.custom_activity_date,
                };

                axios.post(`/activity`, obj).then((res) => {
                    this.notes = null;
                    this.email_subject = null;
                    this.$emit("activity-complete", this.lead.id);
                });
            },

            sendEmail() {
                //To avoid demo users from spamming emails.
                if (this.$store.state.user.user_role_id === 3) {
                    this.demoUserError();
                    return;
                }

                if (this.step.type === "email") {
                    if (!this.email_subject) {
                        alert("Doesnt have a subject");
                        return;
                    }
                    if ($(".summernote").summernote("code") === "<p><br></p>") {
                        alert("Doesnt have a content");
                        return;
                    }
                    this.notes = `Subject: ${this.email_subject} <br> ${$(
                        ".summernote"
                    ).summernote("code")}`;

                    //sending the email
                    let formData = new FormData();
                    formData.set("email_address", this.lead.lead.email);
                    formData.set("email_subject", this.email_subject);
                    formData.set(
                        "email_content",
                        $(".summernote").summernote("code")
                    );
                    if (document.querySelector("#attachment").files[0]) {
                        let attachment = document.querySelector("#attachment");
                        Array.from(attachment.files).forEach((file, index) => {
                            formData.append(file.name, file);
                        });
                    }

                    let outcome = event.target.value;

                    axios
                        .post("/activity/email", formData)
                        .then(() => {
                            this.submitOutcome(outcome);
                        })
                        .catch(() => {});
                }
            },

            attachmentChanged() {
                Array.from(event.target.files).map((file) => {
                    this.attachments.push(file.name);
                });
            },

            demoUserError() {
                swal(
                    `Demo users can not make calls. Arrange a demo by emailing salih_borucu@hotmail.com to acquire a standard user account for testing purposes.`
                );
            },
        },
    };
</script>
