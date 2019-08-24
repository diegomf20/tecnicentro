/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.moment = require('moment');

import vSelect from 'vue-select';
Vue.component('v-select', vSelect)

var router = require('./router.js').default;

import App from './App.vue';
Vue.component('empty',require("./layouts/empty.vue").default);
Vue.component('panel',require("./layouts/panel.vue").default);

window.local=window.localStorage;
window.cuenta=(local.getItem("cuenta")===null) ? null: JSON.parse(local.getItem("cuenta"));

window.comun=new Vue();

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
