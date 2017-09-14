import Vue from 'vue'
import App from '@/App'
import router from '@/router'
import store from '@/store'
import toast from '@/plugins/toast'
import museUI from '@/plugins/museUI'
import veeValidate from '@/plugins/vee-validate'
import VCharts from '@/plugins/v-charts'

Vue.config.productionTip = false

/* eslint-disable no-new */
const vue = new Vue({
  el: '#app',
  router,
  store,
  toast,
  museUI,
  veeValidate,
  VCharts,
  template: '<App/>',
  components: {App}
})

router.beforeEach((to, from, next) => {
  next()
})

router.afterEach(route => {
  if (route.name === 'Login') {
    delete sessionStorage.token
    vue.$store.commit('getUsers', null)
    vue.$store.commit('getOneself', null)
    vue.$store.commit('getConfig', null)
    vue.$store.commit('getAd', null)
  }
  if (!sessionStorage.token && route.name !== 'Login') router.replace('/login')
  if ((sessionStorage.token && !route.name) ||
    (!store.state.oneself || !store.state.oneself.power) &&
    (route.name === 'settingUserCreate' || route.name === 'settingUserList')) {
    router.replace('/home/dashboard')
  }
})

export default vue
