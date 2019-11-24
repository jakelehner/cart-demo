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
      <md-snackbar md-position="center" :md-duration="3000" :md-active.sync="snackbarVisible">
        <span>{{this.$store.state.snackbar.message}}</span>
        <md-button class="md-primary" @click="snackbarVisible = false">Close</md-button>
      </md-snackbar>
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
      snackbarVisible: false
    }
  },
  mounted () {
     this.getCart()
  },
  computed: {
    stateSnackbarVisible () {
      return this.$store.state.snackbar.visible
    }
  },
  watch: {
    stateSnackbarVisible: function (newval) {
      if (newval == true) {
        this.snackbarVisible = true
      }
    },
    snackbarVisible: function (newval) {
      if (newval == false) {
        this.$store.commit('toggleSnackbarVisibility', false)
      }
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

div#content {
  padding: 1em;
}
</style>
