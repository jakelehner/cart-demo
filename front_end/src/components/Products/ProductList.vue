<template>
  <div class="product-list">
    <md-list class="md-double-line">
      <md-subheader>Products</md-subheader>
      <div v-bind:key="product.id" v-for="product in products">
        <ProductListItem v-bind:product="product" />
      </div>
    </md-list>
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
      .catch(function (error) {
        console.log(error);
      })
  }
}
</script>

<style scoped>
  div.product-list {
    margin: auto;
    width: 500px;
  }
</style>
