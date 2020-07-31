<template>
    <div class="card bordered-card">
        <label for>Campaign Name</label>
        <input
            type="text"
            class="form-control"
            v-model="campaignName"
            @blur="changedCampaignDetails"
        />
        <label for>Description</label>
        <input
            type="text"
            class="form-control"
            v-model="campaignDescription"
            @blur="changedCampaignDetails"
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
    </div>
</template>

<script>
    import Multiselect from "vue-multiselect";
    export default {
        components: { Multiselect },
        props: ["schedules", 'id'],

        data() {
            return {
                campaignName: null,
                campaignDescription: null,
                selectedSchedules: this.schedules.map((x) => x),
                scheduleOptions: this.schedules,
            };
        },

        watch: {
            selectedSchedules(){
                this.changedCampaignDetails()
            }
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

            changedCampaignDetails() {
                let obj = {
                    campaignName: this.campaignName,
                    campaignDescription: this.campaignDescription,
                    selectedSchedules: this.selectedSchedules,
                };

                let id = this.id;

                this.$emit('changed-campaign-details', obj, id)
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
