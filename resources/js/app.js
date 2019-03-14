require('./bootstrap');

import Vue from 'vue'
// window.Vue = require('vue');
window.Vue = new Vue;
window.EventBus = new Vue;

import Vuetify from 'vuetify'
Vue.use(Vuetify);

import User from './helpers/User'
window.User = User;

import VueSimplemde from 'vue-simplemde'
Vue.use(VueSimplemde);

import md from 'marked'
window.md = md;


Vue.component('app-home', require('./components/AppHome.vue').default);

import router from './router/router.js'

const app = new Vue({
    el: '#app',
    router
});


