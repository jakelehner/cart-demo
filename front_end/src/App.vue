<template>
  <div id="app">
    <div id="nav">
      <router-link :to="{ name: 'store' }">Store</router-link>
      <router-link :to="{ name: 'cart' }">Cart ({{cart.numItemsUnique}})</router-link>
    </div>
    <div id="content">
      <router-view :cartItems="cart.items"></router-view>
    </div>
  </div>
</template>

<script>

export default {
  name: 'app',
  components: {
  },
  data () {
    return {
      cart: {
        id: null,
        userFingerprint: null,
        numItemsTotal: 0,
        numItemsUnique: 0,
        items: []
      },
    }
  },
  mounted () {
     this.getCart()
  },
  methods: {
    getCart: function () {
      this.axios
        .get('http://localhost:8082/cart')
        .then(response => {
          this.updateCart(response.data.data)
        })
        .catch(function (error) {
          console.log(error);
        })
    },
    updateCart: function (cart) {
      this.cart = cart
    }
  }
}
</script>

<style>
</style>
