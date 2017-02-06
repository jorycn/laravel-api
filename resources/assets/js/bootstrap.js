
window._ = require('lodash');
window.laravel = {
    'csrf': document.querySelector('meta[name="csrf-token"]').content
};
/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');

var VueResource = require('vue-resource');
var VueRouter = require('vue-router');
var Vuex = require('vuex');
var zPagenav = require('vue-pagenav');
import { fromNow,toLetter } from './filters/index';

Vue.use(VueResource);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(zPagenav);

Vue.filter('fromNow', fromNow);
Vue.filter('toLetter', toLetter);

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */
import router from './router';

var NProgress = require('nprogress');
Vue.http.interceptors.push((request, next) => {
    NProgress.start();

    const token = localStorage.getItem('jwt-token');
    request.headers.set('Authorization', 'Bearer ' + token);
    request.headers.set('X-CSRF-TOKEN', laravel.csrf);

    next((response) => {
        NProgress.done();
        if (response.status == 404) {
            router.go('/');
        } else if (response.status == 401 && response.data.refreshed_token) {
            localStorage.setItem('jwt-token', token);
        }

        return response;
    })
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
