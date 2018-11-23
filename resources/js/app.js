require('./bootstrap');

window.Vue = require('vue');
import Buefy from 'buefy';
import router from './routes.js';

window.VueRouter = require('vue-router').default;
window.axios = require('axios').default;
Vue.use(Buefy,{ defaultIconPack: 'fa' }, VueRouter, axios);

const AppLayout = Vue.component('app-layout', require('./components/appLayout.vue'))

new Vue(
    Vue.util.extend(
        {router},
        AppLayout,
    )
).$mount('#mainLayout');