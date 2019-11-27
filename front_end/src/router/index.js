import Vue from 'vue'
import VueRouter from 'vue-router'
import Cart from '../components/Cart/Cart.vue'
import ProductList from '../components/Products/ProductList.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'home',
        meta: {},
        component: ProductList,
    },
    {
        path: '/store',
        name: 'store',
        meta: {},
        component: ProductList,
    },
    {
        path: '/cart',
        name: 'cart',
        meta: {},
        component: Cart,
        props: true
    }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
