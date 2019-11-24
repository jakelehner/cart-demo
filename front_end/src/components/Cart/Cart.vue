<template>
  <div class="cart">
    <span class="md-title">Cart</span>
    <md-list class="md-double-line">
      <div v-if="cartEmpty">
        <md-empty-state
          md-icon="shopping_cart"
          md-label="Your cart is empty"
          md-description="You know you wanna buy some stuff..."
        />
      </div>
      <div v-else>
        <div :key="item.id" v-for="item in cartItems">
          <CartItem :item="item" />
        </div>
        <div class="md-alignment-center-center">
          <md-button class="md-raised md-accent" @click="emptyCart()">
            <md-icon>delete_forever</md-icon> Empty Cart
          </md-button>
        </div>
      </div>
    </md-list>
  </div>
</template>

<script>
import CartItem from './CartItem' 

export default {
  name: 'Cart',
  components: {
    CartItem
  },
  computed: {
    cartItems () {
      return this.$store.state.cart.items
    },
    cartEmpty () {
      return this.$store.getters.cartItemsUniqueCount == 0;
    }
  },
  methods: {
    emptyCart: function () {
      this.axios
        .delete('http://localhost:8082/cart/items')
        .then(response => {
          this.$store.commit('updateCart', response.data.data)
        })
        .catch(function (error) {
          console.log(error);
        })
    }
  }
}
</script>

<style scoped>
  div.cart {
    margin: auto;
    width: 500px;
  }
</style>
