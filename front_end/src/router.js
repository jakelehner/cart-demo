import Cart from './components/Cart/Cart.vue'
import ProductList from './components/Products/ProductList.vue'

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
export default routes;