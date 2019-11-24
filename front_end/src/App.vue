<template>
  <div id="app">
    <div id="nav">
      <router-link :to="{ name: 'store' }">Store</router-link>
      <router-link :to="{ name: 'cart' }">Cart ({{cartItemsUnique}})</router-link>
    </div>
    <div id="content">
      <router-view></router-view>
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

    }
  },
  mounted () {
     this.getCart()
  },
  computed: {
    cartItemsUnique () {
      return this.$store.state.cart.numItemsUnique
    }
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
      this.$store.commit('updateCart', cart)
    }
  }
}
</script>

<style>
</style>
