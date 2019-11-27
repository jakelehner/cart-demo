import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueMaterial from 'vue-material'
import router from './router'
import store from './store'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueAxios, axios)
Vue.use(VueMaterial)

Vue.config.productionTip = false

import App from './App.vue'

new Vue({
  store,
  router,
  render: h => h(App),
}).$mount('#app')
