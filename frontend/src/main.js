import Vue from 'vue'
import App from './App'
import router from './router'
import store from './store'
import MuseUI from 'muse-ui'
import 'muse-ui/dist/muse-ui.css'
import VeeValidate, { Validator } from 'vee-validate'
import zh from 'vee-validate/dist/locale/zh_CN'
import Toast from 'vue-easy-toast'
import 'vue-easy-toast/dist/vue-easy-toast.css'

Vue.config.productionTip = false

Vue.use(MuseUI)
Validator.addLocale(zh)
Vue.use(VeeValidate, {
  locale: 'zh_CN'
})
Vue.use(Toast)

/* eslint-disable no-new */
const vue = new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {App}
})

router.beforeEach((to, from, next) => {
  next()
})

router.afterEach(route => {
  if (route.name === 'Login') delete sessionStorage.token
  if (!sessionStorage.token && route.name !== 'Login') router.replace('/login')
})

export default vue
