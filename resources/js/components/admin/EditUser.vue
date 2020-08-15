<template>
    <div>
        <h1>Under Construction</h1>
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title m-0">{{ user.name }}</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">
                                    <button
                                        class="btn btn-primary"
                                        type="button"
                                    >Change Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-6">
                                <label>Full Name</label>
                                <input
                                    class="form-control"
                                    name="name"
                                    type="name"
                                    placeholder="Full Name"
                                    :value="user.name"
                                />
                            </div>
                            <div class="col-6">
                                <label>Email</label>
                                <input
                                    class="form-control"
                                    name="email"
                                    placeholder="Email"
                                    :value="user.email"
                                />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label>Twilio Number</label>
                                <input
                                    class="form-control"
                                    name="name"
                                    type="name"
                                    placeholder="Full Name"
                                    :value="user.twilio_number"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <label>Selected Account</label>
                                <select
                                    name="account_id"
                                    class="form-control"
                                    v-model="selectedAccount"
                                >
                                    <option
                                        v-for="userAccount in user.user_accounts"
                                        :value="userAccount"
                                    >{{userAccount.account.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <user-account-details :selected-account="selectedAccount"></user-account-details>
                <div class="form-group text-center row m-t-20">
                    <div class="col-12">
                        <button
                            class="btn btn-primary btn-block waves-effect waves-light"
                            type="submit"
                        >Update User</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserAccountDetails from "./UserAccountDetails";
    export default {
        props: ["user"],
        components: { UserAccountDetails },

        data() {
            return {
                selectedAccount: this.user.user_accounts[0],
            };
        },
    };
</script>
