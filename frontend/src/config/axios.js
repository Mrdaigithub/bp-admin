import vm from '@/main'
import axios from 'axios'

const errors = {
  400000: '用户名请求参数缺失',
  400001: '密码请求参数缺失',
  400002: '用戶名请求参数存在非法字符',
  400003: '密码请求参数存在非法字符',
  400004: '用户不存在',
  400005: '用户已存在',
  400006: '新密码请求参数缺失',
  400007: '新密码请求参数存在非法字符',
  400008: '用户名请求参数过短',
  400009: '用户名请求参数过长',
  400010: '密码请求参数过短',
  400011: '密码请求参数过长',
  400012: '账户有效期请求参数缺失',
  400013: '账户有效期请求参数存在非法字符',
  400014: '请求参数存在非法字符',
  401000: '密码错误',
  401001: '用户有效期限已过',
  403000: '权限不足',
  500000: '网络错误',
  500001: '保存失败',
  'token_not_provided': 'Access token 不存在请重新登录',
  'token_expired': 'Access token 已过期请重新登录',
  'token_invalid': 'Access token 无效请重新登录'
}

let axiosInstance = axios.create({
  // baseURL: 'http://127.0.0.1',
  timeout: 3000,
  headers: {'Content-Type': 'application/x-www-form-urlencoded'}
})
axiosInstance.interceptors.request.use(
  config => {
    vm.$store.commit('openLoading')
    if (sessionStorage.token) {
      config.headers.common['Authorization'] = `Bearer ${sessionStorage.token}`
    }
    return config
  },
  err => {
    vm.$store.commit('openLoading')
    return Promise.reject(err)
  })

axiosInstance.interceptors.response.use(
  response => {
    if (response.headers.authorization) sessionStorage.token = response.headers.authorization.replace(/Bearer\s/, '')
    vm.$store.commit('closeLoading')
    return response.data
  },
  error => {
    if (error.response.data.error) {
      vm.$store.commit('closeLoading')
      let errorCode = error.response.data['error']
      vm.$toast(errors[errorCode], {
        horizontalPosition: 'center',
        className: ['et-alert'],
        duration: 2000
      })
      if (errorCode === 'token_not_provided' || errorCode === 'token_expired' || errorCode === 'token_invalid') {
        setTimeout(() => {
          vm.$router.replace('/login')
        }, 2000)
      }
    } else {
      vm.$store.commit('closeLoading')
      vm.$toast('服务器请求超时', {
        horizontalPosition: 'center',
        className: ['et-alert'],
        duration: 2000
      })
    }
    return Promise.reject(error.response.data)
  })

export default axiosInstance
