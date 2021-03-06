/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import global from './mixins/global';

Vue.mixin(global);

Vue.component('create-account', require('./components/admin/CreateAccount.vue').default);
Vue.component('edit-account', require('./components/admin/EditAccount.vue').default);
Vue.component('edit-user', require('./components/admin/EditUser.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#admin-app',
});
