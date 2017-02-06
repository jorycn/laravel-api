
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import App from './App.vue'
import router from './router'
import swal from 'sweetalert'
import { sync } from 'vuex-router-sync'

import store from './store'

const app = new Vue({
  router,
  render: h => h(App)
})

Vue.prototype.$swal = (msg, cb, type) => {
  swal({
    title: _.upperFirst(type), 
    text: msg, 
    type: type || "warning", // "warning", "error", "success" and "info"
    showCancelButton: true,
    closeOnConfirm: true,
    confirmButtonText: '确认',
    cancelButtonText: '取消'
  }, () => {
    cb()
  })
}

sync(store, router);

app.$mount("#app");
