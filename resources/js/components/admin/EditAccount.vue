<template>
    <div class="card m-b-30">
        <div class="card-body">
            <div id="accordion">
                <div class="card mb-0">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0 mt-0 font-14">
                            <a
                                data-toggle="collapse"
                                data-parent="#accordion"
                                href="#collapseOne"
                                aria-expanded="true"
                                aria-controls="collapseOne"
                                class="text-dark"
                            >Account Name and Users</a>
                        </h5>
                    </div>
                    <div
                        id="collapseOne"
                        class="collapse show"
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
                        </div>
                    </div>
                </div>
                <div class="card mb-0">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0 mt-0 font-14">
                            <a
                                class="text-dark collapsed"
                                data-toggle="collapse"
                                data-parent="#accordion"
                                href="#collapseTwo"
                                aria-expanded="false"
                                aria-controls="collapseTwo"
                            >Campaigns</a>
                        </h5>
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
                                    v-for="campaign in account.campaigns"
                                >
                                    <a
                                        class="nav-link"
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
                                <div
                                    class="tab-pane p-3"
                                    :id="'campaign' + campaign.id"
                                    role="tabpanel"
                                    v-for="campaign in account.campaigns"
                                >
                                    <create-campaign
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
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0 mt-0 font-14">
                            <a
                                class="text-dark collapsed"
                                data-toggle="collapse"
                                data-parent="#accordion"
                                href="#collapseThree"
                                aria-expanded="false"
                                aria-controls="collapseThree"
                            >Schedules</a>
                        </h5>
                    </div>
                    <div
                        id="collapseThree"
                        class="collapse"
                        aria-labelledby="headingThree"
                        data-parent="#accordion"
                        style
                    >
                        <div class="card-body">
                            <select class="form-control" v-model="selectedCampaign">
                                <option :value="campaign.id" v-for="campaign in account.campaigns">{{campaign.name}}</option>
                            </select>

                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li
                                    class="nav-item waves-effect waves-light"
                                    v-for="schedule in account.campaigns.find(campaign => campaign.id === selectedCampaign).campaign_schedules"
                                >
                                    <a
                                        class="nav-link"
                                        data-toggle="tab"
                                        :href="'#schedule' + schedule.id"
                                        role="tab"
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
                                    class="tab-pane p-3"
                                    :id="'schedule' + schedule.id"
                                    role="tabpanel"
                                    v-for="schedule in account.campaigns.find(campaign => campaign.id === selectedCampaign).campaign_schedules"
                                >
                                <create-schedule
                                :schedule="schedule"
                                ></create-schedule>
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
    import Multiselect from "vue-multiselect";
    import CreateCampaign from "./CreateCampaign";
    import CreateSchedule from './CreateSchedule';
    export default {
        components: { Multiselect, CreateCampaign, CreateSchedule },
        props: ["account", "users", "schedules"],

        data() {
            return {
                selectedCampaign: this.account.campaigns[0].id,
                selectedUsers: this.account.user_accounts.map(
                    (userAccount) => userAccount.user
                ),
                accountName: this.account.name,
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
        },
    };
</script>
