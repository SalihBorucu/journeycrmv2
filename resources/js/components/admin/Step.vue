<template>
    <tr>
        <th scope="row">{{step.step_number}}</th>
        <td>
            <select
                class="form-control"
                v-model="type"
                @change="$emit('updated-step',{type, day_gap, step_number:step.step_number})"
            >
                <option value="email">Email</option>
                <option value="call">Call</option>
                <option value="social">Social</option>
            </select>
        </td>
        <td>
            <select
                class="form-control"
                v-model="day_gap"
                @change="$emit('updated-step',{type, day_gap, step_number:step.step_number})"
            >
                <option :value="i" v-for="(n, i) in 20">{{i}}</option>
            </select>
        </td>
        <td class="d-flex justify-content-around">
            <button
                type="button"
                class="btn btn-outline-primary waves-effect waves-light"
                data-toggle="modal"
                :data-target="'#myModal' + step.id"
                @click="activateSummerNote"
            >Template</button>
            <div
                :id="'myModal' + step.id"
                class="modal fade bs-example-modal-lg"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myModalLabel"
                aria-hidden="true"
            >
                <template-modal :template="step.template" :type="type" :step="step"></template-modal>
            </div>
        </td>
    </tr>
</template>

<script>
    import TemplateModal from "./TemplateModal";
    export default {
        components: { TemplateModal },
        props: ["step"],
        data() {
            return {
                type: this.step.type,
                day_gap: this.step.day_gap,
            };
        },

        methods: {
            activateSummerNote() {
                if (this.step.type === "email") {
                    $(`.summernote${this.step.step_number}`).summernote({
                        height: 300,
                        minHeight: null,
                        maxHeight: null,
                        focus: true,
                    });
                }
            },
        },
    };
</script>
