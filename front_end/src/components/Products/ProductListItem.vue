<template>
  <div class="product-list-item">
    {{product.displayName}} - ${{product.unitCost}} <button :value="product.sku">Add to Cart</button>
  </div>
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
