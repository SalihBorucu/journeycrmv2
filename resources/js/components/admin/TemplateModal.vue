<template>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Template Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div v-if="type !== 'email'">
                    <h5 class="font-16">Pointer</h5>
                    <textarea class="form-control" v-model="pointer" rows="7" />
                </div>
                <div v-else>
                    <h5 class="font-16">Email Template</h5>
                    <label for>Subject</label>
                    <input class="form-control" :value="this.template.email_subject" />
                    <label for>Content</label>
                    <div class="summernote"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary waves-effect"
                    data-dismiss="modal"
                >Close</button>
                <button
                    type="button"
                    class="btn btn-primary waves-effect waves-light"
                    @click="updateTemplate"
                >Save changes</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ["template", "type"],

        data() {
            return {
                pointer: this.template.pointer,
                emailSubject: this.template.email_subject,
                emailContent: this.template.email_content,
            };
        },

        mounted() {
            if (this.type === "email") {
                $(".summernote").summernote("code", this.template.email_content);
            }
        },

        methods: {
            updateTemplate() {
                let obj = {
                    pointer: this.pointer,
                    email_subject: this.emailSubject,
                    email_content: $(".summernote").summernote("code"),
                };

                axios.post(`/admin/schedule/${this.template.id}`)
            },
        },
    };
</script>
