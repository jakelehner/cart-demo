<template>
  <div class="md-layout md-gutter md-alignment-center-center">
    <div class="md-layout-item md-size-5">
      <md-icon class="md-accent">whatshot</md-icon>
    </div>
    <div class="md-layout-item md-size-15">
      <md-field>
        <md-select :value="item.quantity" @md-selected="updateItemQuantity(item, $event)" name="quantity" id="quantity">
          <md-option value="1">1</md-option>
          <md-option value="2">2</md-option>
          <md-option value="3">3</md-option>
          <md-option value="4">4</md-option>
          <md-option value="5">5</md-option>
          <md-option value="6">6</md-option>
          <md-option value="7">7</md-option>
          <md-option value="8">8</md-option>
          <md-option value="9">9</md-option>
        </md-select>
      </md-field>
    </div>
    <div class="md-layout-item md-size-40">
      <div class="md-list-item-text">
        <span>{{item.displayName}}</span>
        <span>{{item.sku}}</span>
      </div>
    </div>
    <div class="md-layout-item md-size-30">
      <md-button class="md-raised md-accent" @click="removeItemFromCart(item)">
        <md-icon>remove_shopping_cart</md-icon> Remove
      </md-button>
    </div>
  </div>
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
    },
    updateItemQuantity: function (item, newQuantity) {
      if (item.quantity != newQuantity) {
        this.axios
        .post('http://localhost:8082/cart/items/' + item.id, {
          quantity: newQuantity
        })
        .then(response => {
          this.$store.commit('updateCart', response.data.data)
        })
        .catch(function (error) {
          console.log(error);
        })
      }
    },
  }
}
</script>

<style scoped>
  div.center { text-align:center; }
</style>
