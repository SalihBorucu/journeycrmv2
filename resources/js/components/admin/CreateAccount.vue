<template>
    <div>
        <form @submit.prevent="createAccountandCampaign">
            <div class="row">
                <div class="card m-b-30 card-body">
                    <h3 class="card-title font-16 mt-0">Create Account</h3>
                    <label for>Account Name</label>
                    <input type="text" class="form-control" v-model="accountName" required/>
                    <div>
                        <label class="typo__label">Attach Users</label>
                        <multiselect
                            v-model="selectedUsers"
                            tag-placeholder="Add this as new tag"
                            placeholder="Search or add a tag"
                            label="name"
                            track-by="id"
                            :options="userOptions"
                            :multiple="true"
                            :taggable="true"
                            @tag="addTag"
                            required
                        ></multiselect>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card m-b-30 card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title font-16 mt-0">Create Campaigns</h3>
                        <select
                            class="form-control w-25"
                            v-model="campaignNumber"
                            @change="adjustCampaignKeys"
                        >
                            <option :value="index" v-for="index in 5">{{index}}</option>
                        </select>
                    </div>
                    <create-campaign
                        v-for="index in campaignNumber"
                        :key="index"
                        :schedules="schedules"
                        :id="index"
                        @changed-campaign-details="setCampaign"
                    ></create-campaign>
                    <button
                        class="btn btn-primary waves-effect waves-light mt-2"
                    >Create Account and Campaign</button>
                </div>
            </div>
        </form>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>;

<script>
    import Multiselect from "vue-multiselect";
    import CreateSchedule from "./CreateSchedule";
    import CreateCampaign from "./CreateCampaign";
    export default {
        components: { CreateSchedule, Multiselect, CreateCampaign },
        props: ["users", "currentUser", "schedules"],

        data() {
            return {
                campaignNumber: 1,
                selectedUsers: [this.currentUser],
                userOptions: this.users,
                accountName: null,
                campaigns: {},
            };
        },

        methods: {
            addTag(newTag) {
                const tag = {
                    name: newTag,
                    code:
                        newTag.substring(0, 2) +
                        Math.floor(Math.random() * 10000000),
                };
                this.options.push(tag);
                this.value.push(tag);
            },

            setCampaign(campaign, id) {
                this.campaigns[id] = campaign;
            },

            adjustCampaignKeys() {
                let numberOfCampaigns = Object.keys(this.campaigns).length;
                let eventValue = parseInt(event.target.value, 10);

                if (numberOfCampaigns > eventValue) {
                    let diff = numberOfCampaigns - eventValue;
                    for (let i = 0; i < diff; i++) {
                        delete this.campaigns[Object.keys(this.campaigns).length];
                    }
                }
            },

            createAccountandCampaign() {
                let obj = {
                    selectedUsers: this.selectedUsers.map((user) => user.id),
                    accountName: this.accountName,
                    campaigns: this.campaigns,
                };

                axios
                    .post("/admin/account", obj)
                    .then((res) => {
                        let account = res.data;
                        swal(
                            "Well done!",
                            `Account and campaign created succesfully. Complete all the next sections to publish it.`,
                            "success"
                        ).then(() => {
                            window.location.href =
                                window.location.href + `/account/${account.id}`;
                        });
                    })
                    .catch((error) => {
                        this.handleAjaxError(error);
                    });
            },
        },
    };
</script>
