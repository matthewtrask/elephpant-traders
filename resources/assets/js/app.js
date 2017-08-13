window._ = require('lodash');
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';
import Axios from 'axios';
import router from './routes.js';
import auth from './auth.js';

try {
  window.$ = window.jQuery = require('jquery');

  require('bootstrap-sass');
} catch (e) {}

Vue.use(VueRouter);
Vue.use(VueResource);
window.vue = Vue;
window.axios = Axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!auth.check()) {
      next({
        path: '/login',
        query: { redirect: to.fullPath }
      })
    } else {
      next();
    }
  } else {
    next();
  }
});

const app = new Vue({
  el: '#app',
  router,
});
