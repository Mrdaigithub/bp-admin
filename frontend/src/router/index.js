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
      name: 'home',
      component: Home,
      redirect: { name: 'bpMobile' },
      children: [
        {
          path: 'bp/mobile',
          name: 'bpMobile',
          component: BpMobile
        },
        {
          path: 'statistics/mobile',
          name: 'statisticsMobile',
          component: StatisticsMobile
        },
        {
          path: 'setting/user',
          name: 'SettingUser',
          component: SettingUser
        }
      ]
    }
  ]
})
