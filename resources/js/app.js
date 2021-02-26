require("./bootstrap");
import Vue from "vue";
import {
    BootstrapVue,IconsPlugin
} from "bootstrap-vue";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue/dist/bootstrap-vue.css";
import axios from "axios";
import VueRouter from "vue-router";
import Vuex from "vuex";
import AdminRoutes from './routes/admin.js';
import UserRoutes from './routes/user.js';
import ChatRoutes from './routes/chat.js';

import state from './vuex/states.js';
import getters from './vuex/getters.js';
import mutations from './vuex/mutations.js';
//import actions from './vuex/actions.js';
axios.defaults.withCredentials = true;



Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(VueRouter);
Vue.use(Vuex);




Vue.component("global-home", require("./components/user/GlobalHome.vue").default);
Vue.component("nav-bar", require("./components/user/NavBar.vue").default);
Vue.component("pagination", require("laravel-vue-pagination")); //from decumentation of npm
Vue.component("register", require("./components/user/Register.vue").default);
Vue.component("login", require("./components/user/Login.vue").default);
Vue.component("conversiation", require("./components/chat/Conversation.vue").default);

const VueUploadComponent = require('vue-upload-component');
Vue.component('file-upload', VueUploadComponent);


var allRoutes = []
allRoutes = allRoutes.concat(AdminRoutes, UserRoutes,ChatRoutes);
const routes = allRoutes;
const router = new VueRouter({
    routes,   //concat    admin & user -->
    hashbang: false,
    mode: "history"
});

// axios.defaults.baseURL = 'http://localhost:8000'

const store = new Vuex.Store({
    state: state,
    getters: getters,
    mutations: mutations,

    // actions: actions
    // medules:{}
});
const app = new Vue({
    el: "#app",
    router,
    store
});
