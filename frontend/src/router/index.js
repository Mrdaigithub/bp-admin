import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/pages/Login'
import Home from '@/pages/home/Home'
import BpMobile from '@/pages/home/bp/Mobile'
import StatisticsMobile from '@/pages/home/statistics/Mobile'
import SettingUser from '@/pages/home/setting/User'

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
          path: 'statistics/mobile',
          name: 'statistics mobile',
          component: StatisticsMobile
        },
        {
          path: 'bp/mobile',
          name: 'bp mobile',
          component: BpMobile
        },
        {
          path: 'setting/user',
          name: 'Setting user',
          component: SettingUser
        }
      ]
    }
  ]
})
