import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { MdButton, MdIcon, MdList, MdSubheader } from 'vue-material/dist/components'
import Routes from './router.js';
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueRouter)
Vue.use(VueAxios, axios)
Vue.use(MdButton)
Vue.use(MdIcon)
Vue.use(MdList)
Vue.use(MdSubheader)

Vue.config.productionTip = false

import App from './App.vue'

const RouterConfig = {
  routes: Routes
};
const router = new VueRouter(RouterConfig);

new Vue({
  router: router,
  render: h => h(App),
}).$mount('#app')
