import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/pages/Login'
import Home from '@/pages/home/Home'
import BpMobile from '@/pages/home/bp/Mobile'
import UpdatePassword from '@/pages/home/setting/user/UpdatePassword'
import SettingUserCreate from '@/pages/home/setting/user/Create'
import SettingUserList from '@/pages/home/setting/user/List'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'index',
      redirect: { name: 'Login' }
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
      redirect: { name: 'bpMobile' },
      children: [
        {
          path: 'bp/mobile',
          name: 'bpMobile',
          component: BpMobile
        },
        {
          path: 'setting/user/update/password',
          name: 'UpdatePassword',
          component: UpdatePassword
        },
        {
          path: 'setting/user/create',
          name: 'SettingUserCreate',
          component: SettingUserCreate
        },
        {
          path: 'setting/user/list',
          name: 'SettingUserList',
          component: SettingUserList
        }
      ]
    }
  ]
})
