import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/pages/Login'
import Home from '@/pages/home/Home'
import BpMobileConfig from '@/pages/home/bp/mobile/Config'
import BpMobileAd from '@/pages/home/bp/mobile/Ad'
import UpdatePassword from '@/pages/home/setting/user/UpdatePassword'
import SettingUserCreate from '@/pages/home/setting/user/Create'
import SettingUserList from '@/pages/home/setting/user/List'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      redirect: {name: 'Login'}
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/home',
      name: 'home',
      component: Home,
      redirect: {name: 'bpMobileConfig'},
      children: [
        {
          path: 'bp/mobile/config',
          name: 'bpMobileConfig',
          component: BpMobileConfig
        },
        {
          path: 'bp/mobile/ad',
          name: 'bpMobileAd',
          component: BpMobileAd
        },
        {
          path: 'setting/user/update/password',
          name: 'settingUserUpdatePassword',
          component: UpdatePassword
        },
        {
          path: 'setting/user/create',
          name: 'settingUserCreate',
          component: SettingUserCreate
        },
        {
          path: 'setting/user/list',
          name: 'settingUserList',
          component: SettingUserList
        }
      ]
    }
  ]
})
