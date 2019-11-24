<template>
  <div id="app">
    <div id="nav">
      <md-toolbar class="md-primary" md-elevation="1">
        <h3 class="md-title" style="flex: 1">Marvelous App</h3>
        <router-link :to="{ name: 'store' }">
          <md-button>Store</md-button>
        </router-link>
        <router-link :to="{ name: 'cart' }">
          <md-button class="md-primary">
            <md-icon>shopping_cart</md-icon> 
            Cart ({{this.$store.getters.cartItemsUniqueCount}})
          </md-button>
        </router-link>
      </md-toolbar>
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

div#content {
  padding: 1em;
}
</style>
