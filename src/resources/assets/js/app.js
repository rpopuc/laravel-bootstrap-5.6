
require('./bootstrap');

import Vue from 'vue';
import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'http://localhost:6001',
});

Vue.component('events', require( './components/Events.vue' ));

const app = new Vue({
    el: '#app'
});
