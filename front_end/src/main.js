import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { MdButton, MdList, MdIcon } from 'vue-material/dist/components'
import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'

Vue.use(VueAxios, axios)
Vue.use(MdButton)
Vue.use(MdList)
Vue.use(MdIcon)

Vue.config.productionTip = false

import App from './App.vue'

new Vue({
  render: h => h(App),
}).$mount('#app')
