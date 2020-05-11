/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// window.$ = window.JQuery = require('jquery')

require('./bootstrap');


window.Vue = require('vue');
window.axios = require('axios');
window.moment = require('moment');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import VueToastr2 from 'vue-toastr-2'
import 'vue-toastr-2/dist/vue-toastr-2.min.css'

import { Form, HasError, AlertError } from 'vform'
import Swal from 'sweetalert2'

// tosastr
window.toastr = require('toastr')

// Vue.use(VueToastr2)
Vue.use(VueToastr2, {
    defaultTimeout: 3000,
    defaultProgressBar: true,
  });

// Sweet alert
window.Swal = Swal;

// Form
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


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

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// const app = new Vue({
//     el: '#app',
// });
