import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login'
import SignUp from "../components/login/SignUp";
import Logout from "../components/login/Logout";
import Forum from "../components/forum/Forum";

const routes = [
    { path: '/login', component: Login ,name: 'login'},
    { path: '/signup', component: SignUp ,name: 'signup'},
    { path: '/logout', component: Logout ,name: 'logout'},
    { path: '/forum', component: Forum ,name: 'forum'},
]

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})

export default router
