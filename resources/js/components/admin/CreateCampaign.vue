<template>
    <div class="card bordered-card">
        <label for>Campaign Name</label>
        <input
            type="text"
            class="form-control"
            v-model="campaignName"
            @change="$emit('changed-campaign-details', {campaignName, campaignDescription, selectedSchedules}, id)"
        />
        <label for>Description</label>
        <input
            type="text"
            class="form-control"
            v-model="campaignDescription"
            @change="$emit('changed-campaign-details', {campaignName, campaignDescription, selectedSchedules}, id)"
        />
        <label class="typo__label">Attach Schedules</label>
        <multiselect
            v-model="selectedSchedules"
            tag-placeholder="Add this as new tag"
            placeholder="Search or add a tag"
            label="name"
            track-by="id"
            :options="scheduleOptions"
            :multiple="true"
            :taggable="true"
            @tag="addTag"
        ></multiselect>
        <button
            class="btn btn-outline-primary mt-2"
            @click="updateCampaign"
            v-if="this.campaign.id"
        >Save Changes</button>
        <button
            class="btn btn-outline-primary mt-2"
            @click="createCampaign"
            v-else
        >Create Campaign</button>
    </div>
</template>

<script>
    import Multiselect from "vue-multiselect";
    export default {
        components: { Multiselect },
        props: ["schedules", "id", "campaign", "injSelectedSchedules"],

        data() {
            return {
                campaignName: this.campaign ? this.campaign.name : null,
                campaignDescription: this.campaign
                    ? this.campaign.description
                    : null,
                selectedSchedules: this.injSelectedSchedules
                    ? this.injSelectedSchedules.map(
                          (account_schedule) => account_schedule.schedule
                      )
                    : this.schedules.map((x) => x),
                scheduleOptions: this.schedules,
            };
        },

        watch: {
            selectedSchedules() {
                this.$emit(
                    "changed-campaign-details",
                    {
                        campaignName: this.campaignName,
                        campaignDescription: this.campaignDescription,
                        selectedSchedules: this.selectedSchedules,
                    },
                    this.id
                );
            },
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

            updateCampaign() {
                let obj = {
                    campaign_name: this.campaignName,
                    campaign_description: this.campaignDescription,
                    campaign_schedules: this.selectedSchedules,
                };

                axios
                    .patch(`/admin/campaign/${this.campaign.id}`, obj)
                    .then((res) => {
                        this.$emit("campaign-updated", res.data);
                        swal(
                            "Well done!",
                            `Campaign details updated succesfully.`,
                            "success"
                        );
                    })
                    .catch();
            },

            createCampaign() {
                let obj = {
                    campaign_name: this.campaignName,
                    campaign_description: this.campaignDescription,
                    campaign_schedules: this.selectedSchedules,
                    account_id: this.campaign.account_id
                };

                axios
                    .post(`/admin/campaign`, obj)
                    .then((res) => {
                        this.$emit("campaign-updated", res.data);
                        swal(
                            "Well done!",
                            `Campaign created succesfully.`,
                            "success"
                        );
                    })
                    .catch();
            },
        },
    };
</script>

<style>
.bordered-card {
    border: solid 1px #2bcca4;
    border-radius: 5px;
    padding: 10px;
}
</style>
