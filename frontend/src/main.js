import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import MuseUI from 'muse-ui'
import 'muse-ui/dist/muse-ui.css'
import VeeValidate from 'vee-validate'
import zh from 'vee-validate/dist/locale/zh_CN'

Vue.config.productionTip = false

Vue.use(MuseUI)
VeeValidate.addLocale(zh)
Vue.use(VeeValidate, {locale: 'zh_CN'})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {App}
})
