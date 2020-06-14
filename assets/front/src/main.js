import Vue from 'vue'
import App from './App.vue'
import Antd from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css'
import router from './router'
import store from './store'

Vue.config.productionTip = false

Vue.use(Antd)

new Vue({
  render: h => h(App),
  router,
  store
}).$mount('#app')
