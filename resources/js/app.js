require('./bootstrap');

import Vue from 'vue'
// window.Vue = require('vue');
window.Vue = new Vue;
window.EventBus = new Vue;

import Vuetify from 'vuetify'
Vue.use(Vuetify);

import VueSimplemde from 'vue-simplemde'
Vue.use(VueSimplemde);

import User from './helpers/User'
window.User = User


Vue.component('app-home', require('./components/AppHome.vue').default);

import router from './router/router.js'

const app = new Vue({
    el: '#app',
    router
});


