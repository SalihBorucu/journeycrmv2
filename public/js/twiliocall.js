/**
 * Twilio Client configuration for the browser-calls-django
 * example application.
 */

// const { default: Axios } = require("axios");

// Store some selectors for elements we'll reuse
// var callStatus = $('#call-status');
// var answerButton = $('.answer-button');
// var callSupportButton = $('.call-support-button');
// var hangUpButton = $('.hangup-button');
// var callCustomerButtons = $('.call-customer-button');

/* Helper function to update the call status bar */
// function updateCallStatus(status) {
//     console.warn(status)
//     callStatus.text(status);
// }

/* Get a Twilio Client token with an AJAX request */
// $(document).ready(function() {
//     axios
//         .post('/token', {})
//         .then((res) => {
//             Device.setup(res.data.token, { debug: true });
//         })
//         .catch(() => {});
// });
/* Callback to let us know Twilio Client is ready */
// Device.ready(function(device) {
//     updateCallStatus('Readyasdfasdf');
// });

// /* Report any errors to the call status display */
// Device.error(function(error) {
//     updateCallStatus('ERROR: ' + error.message);
// });

/* Callback for when Twilio Client initiates a new connection */
// Device.connect(function(connection) {
//     // Enable the hang up button and disable the call buttons
//     hangUpButton.prop('disabled', false);
//     callCustomerButtons.prop('disabled', true);
//     callSupportButton.prop('disabled', true);
//     answerButton.prop('disabled', true);

//     // If phoneNumber is part of the connection, this is a call from a
//     // support agent to a customer's phone
//     if ('phoneNumber' in connection.message) {
//         updateCallStatus('In call with ' + connection.message.phoneNumber);
//     } else {
//         // This is a call from a website user to a support agent
//         updateCallStatus('In call with support');
//     }
// });

/* Callback for when a call ends */
// Device.disconnect(function(connection) {
//     // Disable the hangup button and enable the call buttons
//     hangUpButton.prop('disabled', true);
//     callCustomerButtons.prop('disabled', false);
//     callSupportButton.prop('disabled', false);

//     updateCallStatus('Ready');
// });

/* Callback for when Twilio Client receives a new incoming call */
// Device.incoming(function(connection) {
//     updateCallStatus('Incoming support call');

//     // Set a callback to be executed when the connection is accepted
//     connection.accept(function() {
//         updateCallStatus('In call with customer');
//     });

//     // Set a callback on the answer button and enable it
//     answerButton.click(function() {
//         connection.accept();
//     });
//     answerButton.prop('disabled', false);
// });

/* Call a customer from a support ticket */
// function callCustomer(phoneNumber) {
//     updateCallStatus('Calling ' + phoneNumber + '...');

//     var params = { phoneNumber: phoneNumber };
//     var test = Device.connect(params, {
//         audioConstraints: {
//             optional: [{ googAutoGainControl: false }],
//         },
//     });
//     $('.callPop').toggle();
// }

/* End a call */
// function hangUp() {
//     Device.disconnectAll();
//     $('#callPop').toggle();
// }
