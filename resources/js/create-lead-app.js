require('./bootstrap');


window.Vue = require('vue');
import VueRouter from 'vue-router';
import Autocomplete from '@trevoreyre/autocomplete-vue';
import '@trevoreyre/autocomplete-vue/dist/style.css';
import global from './mixins/global';


Vue.use(Autocomplete);
Vue.use(VueRouter);
Vue.mixin(global);

const router = new VueRouter({
    mode: 'history',
});

Vue.component('create-lead', require('./components/lead-management/CreateLead.vue').default);
Vue.component('unassigned-leads', require('./components/lead-management/UnassignedLeads.vue').default);
Vue.component('lead-shopping', require('./components/lead-management/LeadShopping.vue').default);
Vue.component('incomplete-leads', require('./components/lead-management/IncompleteLeads.vue').default);

const app = new Vue({
    el: '#create-lead-app',
    router,
});
