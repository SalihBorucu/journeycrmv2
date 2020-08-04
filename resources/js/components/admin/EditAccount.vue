<template>
    <div class="card m-b-30">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h3 class="card-title font-16 mt-0">{{ this.account.name }}</h3>
                <div>
                    <span
                        class="btn btn-outline-warning"
                        v-if="!this.account.complete"
                    >Not Published</span>
                    <span class="btn btn-outline-success" v-else>Published</span>
                </div>
            </div>
            <div id="accordion">
                <div class="card mb-0">
                    <div
                        class="card-header bg-primary d-flex justify-content-between"
                        id="headingOne"
                    >
                        <h5 class="mb-0 mt-0 font-14">
                            <a
                                data-toggle="collapse"
                                data-parent="#accordion"
                                href="#collapseOne"
                                aria-expanded="true"
                                aria-controls="collapseOne"
                                class="text-white"
                            >Account Name and Users</a>
                        </h5>
                        <span class="badge badge-default">Complete</span>
                    </div>
                    <div
                        id="collapseOne"
                        :class="['collapse', !this.account.campaigns[0].campaign_schedules.some(schedule => !schedule.steps.length) ? 'show' : 'null']"
                        aria-labelledby="headingOne"
                        data-parent="#accordion"
                        style
                    >
                        <div class="card-body">
                            <label for>Account Name</label>
                            <input type="text" class="form-control" v-model="accountName" />
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
                                ></multiselect>
                            </div>
                            <button
                                class="btn btn-outline-primary my-2 w-100"
                                @click="updateAccount"
                            >Save Changes</button>
                        </div>
                    </div>
                </div>
                <div class="card mb-0">
                    <div
                        class="card-header bg-primary d-flex justify-content-between"
                        id="headingTwo"
                    >
                        <h5 class="mb-0 mt-0 font-14">
                            <a
                                class="text-white collapsed"
                                data-toggle="collapse"
                                data-parent="#accordion"
                                href="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo"
                            >Campaigns</a>
                        </h5>
                        <span class="badge badge-default">Complete</span>
                    </div>
                    <div
                        id="collapseTwo"
                        class="collapse"
                        aria-labelledby="headingTwo"
                        data-parent="#accordion"
                        style
                    >
                        <div class="card-body">
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li
                                    class="nav-item waves-effect waves-light"
                                    v-for="(campaign, index) in account.campaigns"
                                >
                                    <a
                                        :class="['nav-link', !index ? 'active' : null]"
                                        data-toggle="tab"
                                        :href="'#campaign' + campaign.id"
                                        role="tab"
                                    >
                                        <span class="d-none d-md-block">{{campaign.name}}</span>
                                        <span class="d-block d-md-none">
                                            <i class="mdi mdi-home-variant h5"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <button class="btn btn-outline-primary" @click="createNewCampaign">
                                    <i class="mdi mdi-plus"></i>
                                    Add New Campaign</button>
                                <div
                                    :class="['tab-pane p-3', !index ? 'active' : null]"
                                    :id="'campaign' + campaign.id"
                                    role="tabpanel"
                                    v-for="(campaign, index) in account.campaigns"
                                >
                                    <create-campaign
                                        @campaign-updated="updateCampaignDetails"
                                        :campaign="campaign"
                                        :schedules="schedules"
                                        :inj-selected-schedules="campaign.campaign_schedules"
                                    ></create-campaign>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-0">
                    <div
                        :class="[!this.account.campaigns[0].campaign_schedules.some(schedule => !schedule.steps.length) ? 'bg-primary' : null, 'card-header d-flex justify-content-between']"
                        id="headingThree"
                    >
                        <h5 class="mb-0 mt-0 font-14">
                            <a
                                :class="[this.account.campaigns[0].campaign_schedules[0].steps.length ? 'text-white' : 'text-dark', 'collapsed']"
                                data-toggle="collapse"
                                data-parent="#accordion"
                                href="#collapseThree"
                                aria-expanded="false"
                                aria-controls="collapseThree"
                            >Schedules</a>
                        </h5>
                        <span
                            class="badge badge-default"
                            v-if="!this.account.campaigns[0].campaign_schedules.some(schedule => !schedule.steps.length)"
                        >Complete</span>
                        <span class="badge badge-danger" v-else>Incomplete</span>
                    </div>
                    <div
                        id="collapseThree"
                        :class="['collapse', !this.account.campaigns[0].campaign_schedules.some(schedule => !schedule.steps.length) ? 'null' : 'show']"
                        aria-labelledby="headingThree"
                        data-parent="#accordion"
                        style
                    >
                        <div class="card-body">
                            <label for>Choose Campaign</label>
                            <select class="form-control mb-2" v-model="selectedCampaign">
                                <option
                                    :value="campaign.id"
                                    v-for="campaign in account.campaigns"
                                >{{campaign.name}}</option>
                            </select>

                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li
                                    class="nav-item waves-effect waves-light"
                                    v-for="(schedule, index) in account.campaigns.find(campaign => campaign.id === selectedCampaign).campaign_schedules"
                                >
                                    <a
                                        class="nav-link"
                                        :class="['nav-link', !index ? 'active' : null]"
                                        data-toggle="tab"
                                        :href="'#schedule' + schedule.id"
                                        role="tab"
                                        @click="selectedSchedule = index"
                                    >
                                        <span class="d-none d-md-block">{{schedule.schedule.name}}</span>
                                        <span class="d-block d-md-none">
                                            <i class="mdi mdi-home-variant h5"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div
                                    :class="['tab-pane p-3', !index ? 'active' : null]"
                                    :id="'schedule' + schedule.id"
                                    role="tabpanel"
                                    v-for="(schedule, index) in account.campaigns.find(campaign => campaign.id === selectedCampaign).campaign_schedules"
                                >
                                    <create-schedule
                                        :schedule="schedule"
                                        v-if="selectedSchedule === index"
                                    ></create-schedule>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <button
                v-if="!account.complete"
                class="btn btn-primary ml-2 w-100"
                value="1"
                @click="toggleAccountState"
            >Publish Account</button>
            <button
                v-else
                value="0"
                class="btn btn-danger ml-2 w-100"
                @click="toggleAccountState"
            >Halt Account</button>
        </div>
    </div>
</template>

<script>
    import Multiselect from "vue-multiselect";
    import CreateCampaign from "./CreateCampaign";
    import CreateSchedule from "./CreateSchedule";
    export default {
        components: { Multiselect, CreateCampaign, CreateSchedule },
        props: ["injAccount", "users", "schedules"],

        data() {
            return {
                account: this.injAccount,
                selectedSchedule: 0,
                selectedCampaign: this.injAccount.campaigns[0].id,
                selectedUsers: this.injAccount.user_accounts.map(
                    (userAccount) => userAccount.user
                ),
                accountName: this.injAccount.name,
                userOptions: this.users,
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

            updateAccount() {
                let obj = {
                    account_name: this.accountName,
                    selected_users: this.selectedUsers,
                };

                axios
                    .patch(`/admin/account/${this.account.id}`, obj)
                    .then(() => {
                        swal(
                            "Well done!",
                            `Account details updated succesfully.`,
                            "success"
                        );
                    })
                    .catch(() => {});
            },

            createNewCampaign(){
                let dummyCampaign = {
                    account_id: this.account.id,
                    campaign_schedules: [],
                    description: null,
                    name: 'New Campaign',
                }
                this.account.campaigns.push(dummyCampaign);
            },

            updateCampaignDetails(account) {
                this.account = account;
            },

            toggleAccountState() {
                if (this.account.campaigns[0].campaign_schedules.some(schedule => !schedule.steps.length)) {
                    swal(
                        "Oh no!",
                        `Something is incomplete, can not be published.`,
                        "error"
                    );
                    return
                }
                axios
                    .patch(`/admin/account/publish/${this.account.id}`, {
                        state: event.target.value,
                    })
                    .then((res) => {
                        swal(
                            "Success!",
                            `Account state succesfully changed.`,
                            "success"
                        );
                        this.account.complete = res.data.complete;
                    })
                    .catch();
            },
        },
    };
</script>
