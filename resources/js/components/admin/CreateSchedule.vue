<template>
    <div class="row">
        <div class="card m-b-30 card-body">
            <h3 class="card-title font-16 mt-0">Create Schedule</h3>
            <h4 class="card-title font-14">Steps</h4>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Day Gap</th>
                            <th style="width: 20px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <step v-for="step in schedule_steps" :key="step.id" :step="step"></step>
                    </tbody>
                </table>
            </div>
            <div class="d-flex mt-2">
                <button class="btn btn-primary waves-effect waves-light mx-2" @click="addStep">
                    <i class="mdi mdi-plus"></i>
                </button>
                <button class="btn btn-danger waves-effect waves-light" @click="deleteStep">
                    <i class="mdi mdi-trash-can"></i>
                </button>
            </div>
            <button
                class="btn btn-outline-primary waves-effect waves-light mt-2"
                @click="saveSchedule"
            >Save Schedule</button>
        </div>
    </div>
</template>
<script>
    import Step from "./Step";
    export default {
        components: { Step },
        props: ["schedule"],
        data() {
            return {
                schedule_steps: this.schedule.steps,
            };
        },

        computed: {
            steps_array() {
                let stepsArray = [];
                for (let amount = 0; amount < this.step_amount; amount++) {
                    stepsArray.push({
                        step_number: amount + 1,
                        step_type: "email",
                        day_gap: 1,
                    });
                }
                return stepsArray;
            },
        },

        methods: {
            saveSchedule() {
                let obj = {
                    steps_array: this.schedule_steps,
                };

                // axios.post(`/schedule`, obj).then((res) => {
                //     this.steps_array = null;
                //     this.schedule_nam = null;
                //     this.step_amount = 1;
                // });
            },

            deleteStep() {
                console.log("how you delete the step");
                this.schedule_steps.splice(this.schedule_steps.length - 1, 1);
            },

            addStep() {
                console.log("addStepBetween");
                let step = {
                    campaign_schedule_id: 1,
                    schedule_id: null,
                    step_number: this.schedule_steps.length + 1,
                    type: "call",
                    day_gap: 1,
                    template: {},
                };
                this.schedule_steps.push(step);
            },
        },
    };
</script>
