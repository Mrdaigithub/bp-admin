import vue from '../main'
import axios from 'axios'

const errors = {
  400000: '用户名请求参数缺失',
  400001: '密码请求参数缺失',
  400002: '用戶名请求参数存在非法字符',
  400003: '密码请求参数存在非法字符',
  400004: '用户名不存在',
  400005: '用户名已存在',
  400006: '新密码参数缺失',
  400007: '新密码参数存在非法字符',
  401000: '密码错误',
  401001: '用户有效期限已过',
  500000: '网络错误',
  500001: '保存失败'
}

let axiosInstance = axios.create({
  baseURL: 'http://127.0.0.1',
  timeout: 3000,
  headers: {'Content-Type': 'application/x-www-form-urlencoded'}
})

axiosInstance.interceptors.request.use(
  config => {
    if (sessionStorage.token) {
      config.headers.common['Authorization'] = `Bearer ${sessionStorage.token}`
    }
    return config
  },
  err => {
    return Promise.reject(err)
  })

axiosInstance.interceptors.response.use(
  response => {
    // if (response.headers.authorization) sessionStorage.token = response.headers.authorization.replace(/Bearer\s/,'');
    vue.$store.commit('closeLoading')
    return response.data
  },
  error => {
    if (error.response) {
      vue.$store.commit('closeLoading')
      let errorCode = error.response.data['error_code']
      vue.$toast(errors[errorCode], {
        horizontalPosition: 'center',
        className: ['et-alert'],
        duration: 1000
      })
    }
    return Promise.reject(error.response.data)
  })

export default axiosInstance
