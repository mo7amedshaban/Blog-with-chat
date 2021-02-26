"use strict";

var _laravelEcho = _interopRequireDefault(require("laravel-echo"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

// window._ = require('lodash');
// try {
//     window.Popper = require('popper.js').default;
//     window.$ = window.jQuery = require('jquery');
//     require('bootstrap');
// } catch (e) {}
// window.axios = require('axios');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// /******** Add    *******/
// let token = document.head.querySelector('meta[name="csrf-token"]');
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }
window._ = require('lodash');
window.axios = require('axios');
window.moment = require('moment'); // import 'vue-tel-input/dist/vue-tel-input.css';

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.PostResource['Content-Type'] = 'application/x-www-form-urlencoded';
window.axios.defaults.headers.common.crossDomain = true; //window.axios.defaults.baseURL = '/api';

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://adonisjs.com/docs/4.1/csrf');
} // window.Pusher = require('pusher-js');

/******** Add  and Remove Comments   *******/


window.Pusher = require('pusher-js'); //Pusher.logToConsole = true; //add  can delete it

window.Echo = new _laravelEcho["default"]({
  broadcaster: 'pusher',
  key: process.env.MIX_PUSHER_APP_KEY,
  cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  encrypted: true,
  // for ssl
  host: window.location.hostname + ':8000',
  //http:localhost:8000
  authEndpoint: "/api/broadcasting/auth",
  // prefix fixed for api  , web->  authEndpoint: "/broadcasting/auth"
  csrfToken: token.content,
  //exist in top
  auth: {
    headers: {
      Authorization: JSON.parse(localStorage.getItem('userToken')) //userToken   it's token of user

    }
  },
  authorizer: function authorizer(channel, options) {
    return {
      authorize: function authorize(socketId, callback) {
        axios.PostResource('/api/broadcasting/auth', {
          socket_id: socketId,
          channel_name: channel.name
        }).then(function (response) {
          callback(false, response.data);
        })["catch"](function (error) {
          callback(true, error);
        });
      }
    };
  }
});
