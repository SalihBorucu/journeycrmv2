/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

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


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#create-lead-app',
    router,
});
