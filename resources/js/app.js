/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import "alpinejs"
import Swal from "sweetalert2"

require('./bootstrap');
require('livewire-vue')

window.Swal = Swal
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.mixin({
    data() {
        return {
            error_data: null,
        }
    },

    methods: {
        get: lodash.get,
    }
});

// Import vue2-google-maps
import * as VueGoogleMaps from 'vue2-google-maps'
import lodash from "lodash";
Vue.use(VueGoogleMaps, {
    load: {
        libraries: ["geometry"],
        key: 'AIzaSyCt1SXMaJ-9Yb7xley_wWlvi54f5ckafOQ'
    },
})

const app = new Vue({
    el: '#app',
});

window.confirmDialog = (attributes) => {
    return Swal.fire({
        title: `Confirmación`,
        titleText: `Confirmación de acción`,
        text: `¿Está seguro de que desea realizar esta acción?`,
        icon: `warning`,
        showCancelButton: true,
        confirmButtonText: `Sí`,
        cancelButtonText: `Cancelar`,
        ...attributes,
    })
}
