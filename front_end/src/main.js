import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueMaterial from 'vue-material'
import Routes from './router.js';
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(VueMaterial)

Vue.config.productionTip = false

import App from './App.vue'

const RouterConfig = {
  routes: Routes
};
const router = new VueRouter(RouterConfig);

const store = new Vuex.Store({
  state: {
    cart: {
      id: null,
      userFingerprint: null,
      numItemsTotal: 0,
      numItemsUnique: 0,
      items: []
    },
    snackbar: {
      visible: 'sklmalksd',
      message: ''
    }
  },
  mutations: {
    updateCart (state, cart) {
      state.cart = cart
    },
    showSnackbar (state, message) {
      state.snackbar.message = message
      state.snackbar.visible = true
    },
    toggleSnackbarVisibility (state, value) {
      if (value == false) {
        state.snackbar.message = ''
      }
      state.snackbar.visible = value
    }
  },
  getters: {
    cart: state => {
      return state.cart
    },
    cartItems: state => {
      return state.cart.items
    },
    cartItemsUniqueCount: state => {
      return state.cart.numItemsUnique
    }
  }
})

new Vue({
  store,
  router: router,
  render: h => h(App),
}).$mount('#app')
