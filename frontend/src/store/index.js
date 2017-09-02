import Vue from 'vue'
import Vuex from 'vuex'
import axios from '@/config/axios'
import qs from 'qs'
import vm from '@/main'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loading: false,
    oneself: null,
    configs: null,
    ad: null,
    users: null
  },
  mutations: {
    getUsers (state, users) {
      state.users = users
    },
    getOneself (state, oneself) {
      state.oneself = oneself
    },
    getConfig (state, configs) {
      state.configs = configs
    },
    getAd (state, ad) {
      state.ad = ad
    },
    pushAd (state, adItem) {
      state.ad.push(adItem)
    },
    closeLoading (state) {
      state.loading = false
    },
    openLoading (state) {
      state.loading = true
    }
  },
  actions: {
    updateConfig ({commit}, _configs) {
      let configs = JSON.parse(JSON.stringify(_configs))
      if (configs.area) configs.area = configs.area.join()
      axios.put('/config', qs.stringify(configs))
        .then(res => {
          commit('getConfig', res)
          vm.$toast('修改成功', {
            horizontalPosition: 'center',
            duration: 1000
          })
        })
    },
    updateAd ({commit, state}, _ad) {
      _ad.forEach(each => {
        let args = {
          keyds: each.keyds ? each.keyds : '',
          nokeyds: each.nokeyds ? each.nokeyds : '',
          title: each.title ? each.title : '',
          description: each.description ? each.description : '',
          link: each.link ? each.link : '',
          show_link: each.show_link ? each.show_link : ''
        }
        if (each.type === 'default') {
          args.type = 'default'
          args.bshow = each.bshow ? each.bshow : ''
        } else if (each.type === 'brand') {
          args.type = 'brand'
          args.brand_link = each['brand_link'] ? each['brand_link'] : ''
          args.brand_title1 = each['brand_title1'] ? each['brand_title1'] : ''
          args.brand_description1 = each['brand_description1'] ? each['brand_description1'] : ''
          args.brand_title2 = each['brand_title2'] ? each['brand_title2'] : ''
          args.brand_description2 = each['brand_description2'] ? each['brand_description2'] : ''
        } else if (each.type === 'doctor') {
          args.type = 'doctor'
          args.doctor_name = each['doctor_name'] ? each['doctor_name'] : ''
          args.doctor_job = each['doctor_job'] ? each['doctor_job'] : ''
          args.doctor_pic = each['doctor_pic'] ? each['doctor_pic'] : ''
        }
        for (let key in each) {
          if (key === 'id' || key === 'bshow') continue
          each[key] = ''
        }
        for (let key in args) {
          each[key] = args[key]
        }
      })
      commit('getAd', [])
      _ad.forEach(item => {
        axios.put(`/ad/${item.id}`, qs.stringify(item))
          .then(adItem => {
            // commit('pushAd', adItem)
          })
      })
    },
    removeAd ({commit, state}, adId) {
      axios.delete(`/ad/${adId}`)
        .then(res => {
          if (res === 1) {
            for (let i = 0; i < state.ad.length; i++) {
              if (state.ad[i].id === adId) {
                this.ad.splice(i, 1)
                break
              }
            }
            vm.$toast('删除成功', {
              horizontalPosition: 'center',
              duration: 1000
            })
          } else {
            vm.$toast('删除失败', {
              horizontalPosition: 'center',
              duration: 1000
            })
          }
        })
    }
  }
})
