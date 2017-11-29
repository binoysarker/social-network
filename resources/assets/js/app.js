
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('related-friend', require('./components/Friend.vue'));
Vue.component('pending-friend', require('./components/PendingFriend.vue'));
Vue.component('vue-search', require('./components/Search.vue'));
Vue.component('profile-cover', require('./components/ProfileCover.vue'));

import TimeLine from './components/TimeLine.vue'
import PfofileAbout from './components/ProfileAbout.vue'
import PfofileFriends from './components/ProfileFriends.vue'
import PfofilePhotos from './components/ProfilePhotos.vue'


const routes = [
    { path: '/profile/:slug/time-line', component: TimeLine },
    { path: '/profile/:slug/about', component: PfofileAbout },
    { path: '/profile/:slug/friends', component: PfofileFriends },
    { path: '/profile/:slug/photos', component: PfofilePhotos },
];


const router = new VueRouter({
    // mode: 'history',
    routes // short for `routes: routes`
});

const app = new Vue({
    el: '#app',
    data:{
      isActive:false,
      isAnotherActive:false,
    },
    router,
    props:[],
    methods:{

    },

});
