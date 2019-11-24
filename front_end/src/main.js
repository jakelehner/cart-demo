import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { MdButton, MdEmptyState, MdIcon, MdList, MdSubheader } from 'vue-material/dist/components'
import Routes from './router.js';
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(MdButton)
Vue.use(MdEmptyState)
Vue.use(MdIcon)
Vue.use(MdList)
Vue.use(MdSubheader)

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
    }
  },
  mutations: {
    updateCart (state, cart) {
      state.cart = cart
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
