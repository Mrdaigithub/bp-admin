import Vue from 'vue'
import veeValidate, { Validator } from 'vee-validate'
import zh from 'vee-validate/dist/locale/zh_CN'

Vue.use(veeValidate, {
  locale: 'zh_CN'
})
Validator.addLocale(zh)

Validator.extend('phone', {
  messages: {
    zh_CN: field => field + '格式不正确'
  },
  validate: value => {
    return /(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/.test(value)
  }
})

export default veeValidate
