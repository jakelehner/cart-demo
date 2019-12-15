<template>
  <md-list-item>
    <md-icon class="md-accent">whatshot</md-icon>

    <div class="md-list-item-text">
      <span>{{product.displayName}}</span>
      <span>${{product.unitCost}}</span>
    </div>

    <md-button class="md-raised md-accent" @click="addItemToCart(product)">
      <md-icon>add_shopping_cart</md-icon> Add to Cart
    </md-button>
  </md-list-item>
</template>

<script>

export default {
  name: 'ProductListItem',
  props: {
    product: Object
  },
  data: function() {
    return {};
  },
  methods: {
    addItemToCart: function (product) {
      this.axios
        .post(process.env.VUE_APP_API_BASE_URL + '/cart/items', {
          sku: product.sku,
          quantity: 1
        })
        .then(response => {
          this.$store.commit('updateCart', response.data.data)
          this.$store.commit('showSnackbar', 'Product added to cart!')
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
