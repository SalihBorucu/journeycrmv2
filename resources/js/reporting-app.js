require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history'
})

Vue.component('reporting-component', require('./components/ReportingComponent.vue').default);

const app = new Vue({
    el: '#reporting-app',
    router,
});
