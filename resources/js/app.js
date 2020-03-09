/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window._ = require('lodash');
window.$ = require('jquery');
window.axios = require('axios');
window.moment = require('moment');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// const moment = require('vue-moment');

window.moment = require('./moment-with-locales.min');
window.moment.locale('nl');


import Vue from 'vue'
import VueRouter from 'vue-router'
import VueGtag from 'vue-gtag'

Vue.use(VueRouter);

// Vue.component('navigation', require('./layout/navigation.vue').default);
const home = Vue.component('app', require('./components/home').default);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: home,
        },
        // {
        //     path: '/reserveren',
        //     component: book,
        // },
        // {
        //     path: '/reserveren/:payload',
        //     component: book,
        // },
        // {
        //     path: '/privacy',
        //     component: privacy,
        // },
        // {
        //     path: '/cookie',
        //     component: cookie,
        // },
        // {
        //     path: '/algemene-voorwaarden',
        //     component: voorwaarden,
        // },
        // {
        //     path: '/veelgestelde-vragen',
        //     component: faq,
        // },
        // {
        //     path: '/veelgestelde-vragen/:search_term',
        //     component: faq,
        // },
    ],
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        }
        if (to.hash) {
            return {selector: to.hash};
        }
        return {x: 0, y: 0};
    }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
// Vue.component('navigation', require('./layout/navigation.vue').default);


/**p
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueGtag, {
    config: {
        id: ''
    }
}, router);

const app = new Vue({
    // mode: 'production',
    router,
    el: '#app',
    data() {
        return {}
    },
    // created() {
    //     this.$gtag.set({
    //         'currency': 'EUR'
    //     });
    // },
    methods: {},
    watch: {
        $route(to, from) {}
    }
});
