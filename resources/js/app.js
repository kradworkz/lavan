/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import VueRouter from 'vue-router';

Vue.component('laptop-create', require('./Pages/Laptop/Create.vue').default);

Vue.component('home-index', require('./components/Admin/Home/Index.vue').default);

Vue.component('dropdown-index', require('./components/Admin/Dropdown/Index.vue').default);
Vue.component('dropdown-create', require('./components/Admin/Dropdown/Create.vue').default);

Vue.component('users-index', require('./components/Admin/User/Index.vue').default);
Vue.component('user-create', require('./components/Admin/User/Create.vue').default);
Vue.component('user-status', require('./components/Admin/User/Status.vue').default);

Vue.component('logs-index', require('./components/Admin/Logs/Index.vue').default);
Vue.component('log-details', require('./components/Admin/Logs/Details.vue').default);

Vue.component('facility-index', require('./components/Facility/Index.vue').default);
Vue.component('facility-view', require('./components/Facility/View.vue').default);
Vue.component('facility-create', require('./components/Facility/Create.vue').default);
Vue.component('facility-beds', require('./components/Facility/Bed.vue').default);
Vue.component('facility-create-beds', require('./components/Facility/CreateBed.vue').default);

Vue.component('patient-index', require('./components/Patient/Index.vue').default);
Vue.component('patient-create', require('./components/Patient/Create.vue').default);
Vue.component('patient-view', require('./components/Patient/View.vue').default);
Vue.component('patient-create-history', require('./components/Patient/History.vue').default);

Vue.component('admission-index', require('./components/Admission/Index.vue').default);
Vue.component('admission-check', require('./components/Admission/Checkin.vue').default);
Vue.component('admission-checkout', require('./components/Admission/Checkout.vue').default);
Vue.component('admission-result', require('./components/Admission/Result.vue').default);

Vue.use(VueRouter)
import VueToast from 'vue-toast-notification';
Vue.use(VueToast);

import router from './Router/index';

const app = new Vue({
    data: { 
        currentUrl: window.location.origin,
        windowHeight: window.innerHeight,
        windowWidth: window.innerWidth,
    },
    
    computed : {
        height: function() {
            return this.windowHeight - 170;
        },
        width: function() {
            return this.windowWidth;
        },
        counts: function(){
            return Math.floor((this.height - 175) / 54);
        }
    },
    el: '#app',
    router,
});

// router.beforeEach((to, from, next) => {
//     app.loading = true
//     next()
// });
  
// router.afterEach(() => {
//     setTimeout(() => app.loading = false, 1000) // timeout for demo purposes
// });
