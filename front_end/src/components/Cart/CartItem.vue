<template>
    <md-list-item>
      <md-icon class="md-accent">whatshot</md-icon>

        <div class="md-list-item-text">
          <span>{{item.displayName}}</span>
          <span>{{item.sku}} - {{item.quantity}}</span>
        </div>

        <md-button class="md-raised md-accent" @click="removeItemFromCart(item)">
          <md-icon>remove_shopping_cart</md-icon> Remove
        </md-button>
      </md-list-item>
</template>

<script>

export default {
  name: 'CartItem',
  props: {
    item: Object
  },
  data: function() {
    return {};
  },
  methods: {
    removeItemFromCart: function (item) {
      this.axios
        .delete('http://localhost:8082/cart/items/' + item.id)
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

</style>
