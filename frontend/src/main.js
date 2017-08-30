import Vue from 'vue'
import App from './App'
import router from '@/router'
import store from '@/store'
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
  if (route.name === 'Login') {
    delete sessionStorage.token
    vue.$store.commit('getOneself', null)
  }
  if (!sessionStorage.token && route.name !== 'Login') router.replace('/login')
  if (sessionStorage.token && !route.name) router.replace('/home/bp/mobile')
  if ((!store.state.oneself || !store.state.oneself.power) && route.name === 'SettingUserCreate') router.replace('/home/bp/mobile')
})

export default vue
