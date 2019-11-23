<template>
  <div class="product-list">
    <div v-bind:key="product.id" v-for="product in products">
      <ProductListItem v-bind:product="product" />
    </div>
    <!-- <li v-for="product in products">
      {{ product.sku }}
    </li> -->
  </div>
</template>

<script>
import ProductListItem from './ProductListItem' 

export default {
  name: 'ProductList',
  components: {
    ProductListItem
  },
  props: {    
  },
  data () {
    return {
      products: []
    };
  },
  mounted () {
    this.axios
      .get('http://localhost:8082/products')
      .then(response => {
        this.products = response.data.data;
      })
  }
}
</script>

<style scoped>

</style>
