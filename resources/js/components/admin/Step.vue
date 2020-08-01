<template>
    <tr>
        <th scope="row">{{step.step_number}}</th>
        <td>
            <select class="form-control" v-model="type">
                <option value="email">Email</option>
                <option value="call">Call</option>
                <option value="social">Social</option>
            </select>
        </td>
        <td>
            <select class="form-control" v-model="day_gap">
                <option :value="i" v-for="(n, i) in 20">{{i}}</option>
            </select>
        </td>
        <td>
            <button
                type="button"
                class="btn btn-primary waves-effect waves-light"
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
                <template-modal :template="step.template"
                :type="type"></template-modal>
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
            activateSummerNote(){
                $(".summernote").summernote({
                        height: 300,
                        minHeight: null,
                        maxHeight: null,
                        focus: true,
                    });
            }
        },
    };
</script>
