"use strict";

var _vue = _interopRequireDefault(require("vue"));

var _bootstrapVue = require("bootstrap-vue");

require("bootstrap/dist/css/bootstrap.css");

require("bootstrap-vue/dist/bootstrap-vue.css");

var _axios = _interopRequireDefault(require("axios"));

var _vueRouter = _interopRequireDefault(require("vue-router"));

var _PostResources = _interopRequireDefault(require("./components/PostResources.vue"));

var _PostResourceDetails = _interopRequireDefault(require("./components/PostResourceDetails.vue"));

var _CategoryPostResources = _interopRequireDefault(require("./components/CategoryPostResources.vue"));

var _Index = _interopRequireDefault(require("./components/admin/Index.vue"));

var _AllNotifications = _interopRequireDefault(require("./components/AllNotifications.vue"));

var _vuex = _interopRequireDefault(require("vuex"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

require("./bootstrap");

window.Vue = require("vue");

_vue["default"].use(_bootstrapVue.BootstrapVue);

_vue["default"].use(_vueRouter["default"]);

_vue["default"].component("example-component", require("./components/ExampleComponent.vue")["default"]);

_vue["default"].component("global-home", require("./components/GlobalHome.vue")["default"]);

_vue["default"].component("nav-bar", require("./components/NavBar.vue")["default"]);

_vue["default"].component("pagination", require("laravel-vue-pagination")); //from decumentation of npm


_vue["default"].component("register", require("./components/Register.vue")["default"]);

_vue["default"].component("login", require("./components/Login.vue")["default"]);

var routes = [{
  path: "/",
  component: _PostResources["default"],
  name: "PostResource"
}, {
  path: "/PostResource/:slug",
  component: _PostResourceDetails["default"],
  name: "PostResourceDetails"
}, {
  path: "/category/:slug/PostResources",
  component: _CategoryPostResources["default"],
  name: "CategoryPostResources"
}, {
  path: "/admin",
  component: _Index["default"],
  name: "AdminIndex"
}, {
  path: "/notifications",
  component: _AllNotifications["default"],
  name: "AllNotifications"
}];
var router = new _vueRouter["default"]({
  routes: routes,
  hashbang: false,
  mode: "history"
});

_vue["default"].use(_vuex["default"]); //axios.defaults.baseURL = 'http://blog.test/api'


var store = new _vuex["default"].Store({
  state: {
    userToken: null,
    user: null,
    EditedPostResource: {},
    notifications: []
  },
  getters: {
    isLogged: function isLogged(state) {
      return !!state.userToken;
    },
    isAdmin: function isAdmin(state) {
      if (state.user) {
        return state.user.is_admin; //return 1 or 0
      }

      return null;
    },
    PostResourceToEdit: function PostResourceToEdit(state) {
      return state.EditedPostResource;
    }
  },
  mutations: {
    // getnotification(state,notify){
    //     state.notifications = notify;
    //     console.log("notification",state.notifications);
    // },
    setUserToken: function setUserToken(state, userToken) {
      state.userToken = userToken;
      localStorage.setItem("userToken", JSON.stringify(userToken));
      _axios["default"].defaults.headers.common.Authorization = "Bearer ".concat(userToken); //store token in cookie in this browser
    },
    setUser: function setUser(state, user) {
      //for check store all details of user is admin  or not
      state.user = user;
      console.log('user-Before', state.user.id);
      Echo.connector.pusher.config.auth.headers.Authorization = "Bearer ".concat(state.userToken); //here can use ${state.user}

      console.log('user-After', state.user.id);
      Echo["private"]("App.User.".concat(state.user.id)) // run and not error
      .notification(function (notification) {
        //error here  .notification
        state.notifications.unshift(notification);
        console.log('notification ===> all', notification);
      }); //.unshift(notification);
    },
    logout: function logout(state) {
      state.userToken = null;
      localStorage.removeItem("userToken");
      window.location.pathname = "/"; //   go to home page
    },
    EditPostResource: function EditPostResource(state, PostResource) {
      state.EditedPostResource = PostResource;
    }
  },
  actions: {} // medules:{}

});
var app = new _vue["default"]({
  el: "#app",
  router: router,
  store: store
});
