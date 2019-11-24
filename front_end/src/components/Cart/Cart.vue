<template>
  <div class="cart">
    <md-list class="md-double-line">
      <md-subheader>Cart</md-subheader>
      <div v-if="cartEmpty">
        Your cart is empty
      </div>
      <div v-else :key="item.id" v-for="item in cartItems">
        <CartItem :item="item" />
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
}
</script>

<style scoped>
  div.cart {
    margin: auto;
    width: 500px;
  }
</style>
