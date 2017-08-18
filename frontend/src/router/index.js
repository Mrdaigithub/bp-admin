import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import UserSetting from '@/pages/home/setting/UserSetting'
import Login from '@/pages/Login'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/home',
      name: 'Home',
      component: Home,
      children: [
        {
          path: 'setting/user',
          component: UserSetting
        }
      ]
    }
  ]
})
