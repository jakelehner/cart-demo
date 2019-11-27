import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    cart: {
      id: null,
      userFingerprint: null,
      numItemsTotal: 0,
      numItemsUnique: 0,
      items: []
    },
    snackbar: {
      visible: false,
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
  actions: {
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
