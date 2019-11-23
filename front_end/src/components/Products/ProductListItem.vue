<template>
    <md-list-item>
      <md-icon class="md-accent">whatshot</md-icon>

        <div class="md-list-item-text">
          <span>{{product.displayName}}</span>
          <span>${{product.unitCost}}</span>
        </div>

        <md-button class="md-raised md-accent">
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
  }
}
</script>

<style scoped>

</style>
