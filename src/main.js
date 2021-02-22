import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import routes from './router/index'
import { store } from './store/store'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.config.productionTip = false
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueAxios, axios);
export const router = new VueRouter({
  routes
})
Vue.directive("click-outside", {
  bind: function (el) {
    el.clickOutside = function (event) {
      if (!(el == event.target || el.contains(event.target))) {
        if (store.state.isShowingFormTask && event.target.contains(el)) {
          store.commit("closeFormTask");

        }
      }
    }
    document.body.addEventListener('click', el.clickOutside)
  },
  unbind: function (el) {
    document.body.removeEventListener('click', el.clickOutside)
  },
})
new Vue({
  router,
  store: store,
  render: h => h(App),
}).$mount('#app')
