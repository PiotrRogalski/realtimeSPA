import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login'
import SignUp from "../components/login/SignUp";
import Logout from "../components/login/Logout";
import Forum from "../components/forum/Forum";
import CreateQuestion from "../components/forum/CreateQuestion";
import CreateCategory from "../components/category/CreateCategory";
import Read from "../components/forum/Read";

const routes = [
    { path: '/login', component: Login ,name: 'login'},
    { path: '/signup', component: SignUp ,name: 'signup'},
    { path: '/logout', component: Logout ,name: 'logout'},
    { path: '/forum', component: Forum ,name: 'forum'},
    { path: '/category', component: CreateCategory },
    { path: '/ask', component: CreateQuestion },
    { path: '/question/:slug', component: Read ,name: 'read'},
]

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
})

export default router
