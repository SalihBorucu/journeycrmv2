<template>
    <p ref="editable" contenteditable v-on="listeners" @keydown="s" />
</template>

<script>
    export default {
        props: {
            value: {
                type: String,
                default: "",
            },
        },
        computed: {
            listeners() {
                return { ...this.$listeners, input: this.onInput };
            },
        },
        mounted() {
            this.$refs.editable.innerText = this.value;
        },
        methods: {
            onInput(e) {
                this.$emit("input", e.target.innerText);
            },

            s(){
                console.log('asdasd')
            }
        },
    };
</script>

<style scoped>
    p{
        font-size: 12px;
        color: black;
    }
</style>
