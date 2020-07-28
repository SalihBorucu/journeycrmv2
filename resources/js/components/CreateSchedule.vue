<template>
    <div>
        <h3 class="card-title font-16 mt-0">Create Schedule</h3>
        <div class="d-flex">
            <div class="w-100">
                <label for>Schedule Name</label>
                <input
                    type="text"
                    class="form-control"
                    name="schedule_name"
                    v-model="schedule_name"
                />
            </div>
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
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="index in step_amount" :key="index">
                        <th scope="row">{{index}}</th>
                        <td>
                            <select class="form-control" @change="changeType" :data-key="index">
                                <option value="email">Email</option>
                                <option value="call">Call</option>
                                <option value="social">Social</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" @change="changeDayGap" :data-key="index">
                                <option :value="index" v-for="index in 20">{{index}}</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button
            class="btn btn-primary waves-effect waves-light mt-2"
            @click="createSchedule"
        >Create Schedule</button>
    </div>
</template>
<script>
    import axios from "axios";
    export default {
        data() {
            return {
                step_amount: 1,
                schedule_name: null,
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
