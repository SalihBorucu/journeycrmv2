export default {
    methods:{
        handleAjaxError(err) {
            let errorText = err.response.data.message;

            if (err.response.status === 422) {
                errorText = this.convertLaravelErrorBagToString(err.response.data.errors);
            }
            // Here errorText variable should be ready to show all the error message in a string format,
            // which I could simply display it.

            // In this instance, I preferred using SweetAlert;
            swal('Something went wrong', errorText, 'error');
        },

        // Implode Laravel ErrorBag into multi-line string
        convertLaravelErrorBagToString(errorsArr) {
            let errorBag = [];

            Object.values(errorsArr).forEach((error_msg) => {
                errorBag.push(error_msg);
            });

            return errorBag.join('\n');
        },
    }
};
