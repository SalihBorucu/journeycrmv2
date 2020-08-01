<template>
    <div class="row">
        <div class="card m-b-30 card-body">
            <h3 class="card-title font-16 mt-0">Create Schedule</h3>
            <div class="d-flex">
                <div class="w-100">
                    <label>Number of Steps</label>
                    <select class="form-control" v-model="step_amount">
                        <option :value="index" v-for="index in 20">{{index}}</option>
                    </select>
                </div>
            </div>
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
                        <step v-for="step in schedule.steps" :key="step.id" :step="step"></step>
                    </tbody>
                </table>
            </div>

            <button
                class="btn btn-primary waves-effect waves-light mt-2"
                @click="createSchedule"
            >Create Schedule</button>
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
                step_amount: this.schedule.steps.length,
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
            changeType() {
                let selectedStep = this.steps_array.find(
                    (step) =>
                        step.step_number == event.target.getAttribute("data-key")
                );
                selectedStep.step_type = event.target.value;
            },

            changeDayGap() {
                let selectedStep = this.steps_array.find(
                    (step) =>
                        step.step_number == event.target.getAttribute("data-key")
                );
                selectedStep.day_gap = event.target.value;
            },

            createSchedule() {
                let obj = {
                    steps_array: this.steps_array,
                    schedule_name: this.schedule_name,
                };

                axios.post(`/schedule`, obj).then((res) => {
                    this.steps_array = null;
                    this.schedule_nam = null;
                    this.step_amount = 1;
                });
            },
        },
    };
</script>
