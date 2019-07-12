
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue';
window.Vue = require('vue');
window.$ = require('jquery');
require('popper.js');
require('jquery');
require('bootstrap');
require('vuejs-uib-pagination');
require('sweetalert2');
require('vue-moment');
import Datepicker from 'vuejs-datepicker';
import Multiselect from 'vue-multiselect'
import pagination from "vuejs-uib-pagination";
Vue.use(pagination);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('vuejs-datepicker', Datepicker);
Vue.component('custom-datepicker',require('./components/DatePickerComponent.vue').default);
Vue.component('multiselect', Multiselect);
Vue.component('multiselect',require('./components/VueMultiSelectComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
})

