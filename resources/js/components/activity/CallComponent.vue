<template>
    <div class="mx-2">
        <div class="mt-4 mx-4 mb-1">
            <div v-if="this.$store.state.user.user_role_id !== 3">
                    <!-- v-if="call_status === 'Ready'" -->
                <button
                    class="btn btn-success btn-lg text-white"
                    @click="callCustomer('+447504855932')"
                >
                    <i class="mdi mdi-phone bg-success text-white" style="font-size: 60px"></i>
                </button>
            </div>
            <div v-else>
                <button class="btn btn-success btn-lg text-white" @click="demoUserError">
                    <i class="mdi mdi-phone bg-success text-white" style="font-size: 60px"></i>
                </button>
            </div>

            <button
                v-if="call_status !== 'Ready' && call_status !== null"
                class="btn btn-lg btn-danger hangup-button"
                @click="hangUp"
            >
                <i class="mdi mdi-phone-hangup bg-danger text-white" style="font-size: 60px"></i>
            </button>
        </div>
        <select class="form-control" v-model="selectedNumber">
            <option :value="lead.lead.phone_1" v-if="lead.lead.phone_1">{{lead.lead.phone_1}}</option>
            <option :value="lead.lead.phone_2" v-if="lead.lead.phone_2">{{lead.lead.phone_2}}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ["lead"],

        data() {
            return {
                selectedNumber: this.lead.lead.phone_1,
                call_status: null,
            };
        },

        mounted() {
            this.callPrep();
        },
        watch: {
            lead() {
                this.selectedNumber = this.lead.lead.phone_1
                this.callPrep();
            },
        },

        methods: {
            callPrep() {
                axios
                    .post("/token", {})
                    .then((res) => {
                        console.log(res.data.token);
                        Device.setup(res.data.token, { debug: true });
                    })
                    .catch(() => {});

                this.callSetters();
            },

            updateCallStatus(status) {
                this.call_status = status;
            },

            hangUp() {
                Device.disconnectAll();
                $("#callPop").toggle();
            },

            callCustomer(phoneNumber) {
                this.updateCallStatus("Calling " + phoneNumber + "...");

                let params = { phoneNumber: phoneNumber };
                let test = Device.connect(params, {
                    audioConstraints: {
                        optional: [{ googAutoGainControl: false }],
                    },
                });
                $(".callPop").toggle();
                const vm = this;
                Device.connect(function (connection) {
                    vm.updateCallStatus(
                        "In call with " + connection.message.phoneNumber
                    );
                    vm.$emit("call-started");
                });

                Device.disconnect(function (connection) {
                    vm.updateCallStatus("Ready");
                });
            },

            callSetters() {
                let vm = this;

                Device.ready(function (device) {
                    vm.updateCallStatus("Ready");
                });

                Device.error(function (error) {
                    vm.updateCallStatus("ERROR: " + error.message);
                });
            },

            demoUserError() {
                swal(
                    `Demo users can not make calls. Arrange a demo by emailing salih_borucu@hotmail.com to acquire a standard user account for testing purposes.`
                );
            },
        },
    };
</script>
