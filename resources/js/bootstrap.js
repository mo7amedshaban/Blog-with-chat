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
    window.moment = require('moment')


     window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    window.axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    window.axios.defaults.headers.common.crossDomain = true;


    //window.axios.defaults.baseURL = '/api';

    let token = document.head.querySelector('meta[name="csrf-token"]');

    if (token) {
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    } else {
        console.error('CSRF token not found: https://adonisjs.com/docs/4.1/csrf');
    }



/******** Add  and Remove Comments   *******/
//Pusher.logToConsole = true; //add  can delete it

import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');
window.Echo = new Echo({
        broadcaster: 'pusher',
        key: process.env.MIX_PUSHER_APP_KEY,
        wsHost: window.location.hostname,
        wsPort: 6001,
        forceTLS: false,   //must write it
        disableStats: true,
        enabledTransports: ['ws', 'flash'],
    csrfToken: token.content,    //exist in top
    auth: {
        headers: {
            Authorization:JSON.parse(localStorage.getItem('userToken'))   //userToken   it's token of user
        }
     },
    authorizer: (channel, options) => {
        return {
            authorize: (socketId, callback) => {
                axios.post('/api/broadcasting/auth', {
                    socket_id: socketId,
                    channel_name: channel.name
                })
                .then(response => {
                    callback(false, response.data);
                })
                .catch(error => {
                    callback(true, error);
                });
            }
        };
    },
});

