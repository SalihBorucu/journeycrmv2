<template>
    <div class="card">
        <div class="card-body">
            <h4 class="page-title m-0">Email Details for {{selectedAccount.account.name}}</h4>
            <div class="form-group row mt-3">
                <div class="col-6">
                    <label>Email</label>
                    <input class="form-control" placeholder="Email" value />
                </div>
                <div class="col-6">
                    <label>Password</label>
                    <input class="form-control" type="name" placeholder="Full Name" />
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-12">
                    <label>Email Signature</label>
                    <div class="summernote"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["selectedAccount"],

        data() {
            return {
                account_email: null,
                account_email_password: null,
                email_signature: null,
            };
        },
        mounted() {
            $(".summernote").summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true,
            });
            $(`.summernote`).summernote("code", "");
        },
    };
</script>
