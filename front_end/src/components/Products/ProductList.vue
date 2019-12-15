<template>
  <div class="product-list">
    <span class="md-title">Products</span>
    <md-list class="md-double-line">
      <div v-if="loading" class="md-layout md-alignment-center-center">
        <md-progress-spinner md-mode="indeterminate" class="md-primary"></md-progress-spinner>
      </div>
      <div v-else :key="product.id" v-for="product in products">
        <ProductListItem :product="product" />
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
      loading: true,
      products: []
    };
  },
  mounted () {
    this.getProductList()
  },
  methods: {
    getProductList: function () {
      this.loading = true
      this.axios
        .get(process.env.VUE_APP_API_BASE_URL + '/products')
        .then(response => {
          this.products = response.data.data
          this.loading = false
        })
        .catch(function (error) {
          console.log(error);
        })
    }
  }
}
</script>

<style scoped>
  div.product-list {
    margin: auto;
    width: 500px;
  }
  .md-progress-spinner {
    margin: 24px;
  }
</style>
