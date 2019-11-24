<template>
  <div class="cart">
    <md-list class="md-double-line">
      <md-subheader>Cart</md-subheader>
      <div v-bind:key="item.id" v-for="item in cartItems">
        <CartItem v-bind:item="item" />
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
  props: ['cartItems']
}
</script>

<style scoped>
  div.cart {
    margin: auto;
    width: 500px;
  }
</style>
