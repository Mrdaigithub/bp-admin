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
    config: null,
    ad: null
  },
  mutations: {
    getOneself (state, oneself) {
      state.oneself = oneself
    },
    getConfig (state, config) {
      state.config = config
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
    updateConfig ({commit}, _config) {
      let config = JSON.parse(JSON.stringify(_config))
      if (config.area) config.area = config.area.join()
      axios.put('/config', qs.stringify(config))
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
        let args = {}
        if (each.adtype === 'default') {
          args = {
            adtype: 'default',
            keyds: each.keyds ? each.keyds : '',
            nokeyds: each.nokeyds ? each.nokeyds : '',
            title: each.title ? each.title : '',
            depict: each.depict ? each.depict : '',
            link: each.link ? each.link : '',
            xslink: each.xslink ? each.xslink : '',
            bshow: each.bshow ? each.bshow : ''
          }
        } else if (each.adtype === 'brand') {
          args = {
            adtype: 'brand',
            keyds: each.keyds ? each.keyds : '',
            nokeyds: each.nokeyds ? each.nokeyds : '',
            title: each.title ? each.title : '',
            depict: each.depict ? each.depict : '',
            link: each.link ? each.link : '',
            xslink: each.xslink ? each.xslink : '',
            brandlogo: each.brandlogo ? each.brandlogo : '',
            brand_title1: each['brand_title1'] ? each['brand_title1'] : '',
            brand_lnke1: each['brand_lnke1'] ? each['brand_lnke1'] : '',
            brand_title2: each['brand_title2'] ? each['brand_title2'] : '',
            brand_lnke2: each['brand_lnke2'] ? each['brand_lnke2'] : '',
            telephone: each['telephone'] ? each['telephone'] : ''
          }
        } else if (each.adtype === 'doctorind') {
          args = {
            adtype: 'doctorind',
            keyds: each.keyds ? each.keyds : '',
            nokeyds: each.nokeyds ? each.nokeyds : '',
            title: each.title ? each.title : '',
            depict: each.depict ? each.depict : '',
            link: each.link ? each.link : '',
            xslink: each.xslink ? each.xslink : '',
            dtname: each.dtname ? each.dtname : '',
            docposition: each.docposition ? each.docposition : '',
            dtpic: each.dtpic ? each.dtpic : ''
          }
        } else if (each.adtype === 'imgturn') {
          args = {
            adtype: 'imgturn',
            keyds: each.keyds ? each.keyds : '',
            nokeyds: each.nokeyds ? each.nokeyds : '',
            adimgurl_1: each['adimgurl_1'] ? each['adimgurl_1'] : '',
            adimglink_1: each['adimglink_1'] ? each['adimglink_1'] : '',
            adimgurl_2: each['adimgurl_2'] ? each['adimgurl_2'] : '',
            adimglink_2: each['adimglink_2'] ? each['adimglink_2'] : '',
            adimgurl_3: each['adimgurl_3'] ? each['adimgurl_3'] : '',
            adimglink_3: each['adimglink_3'] ? each['adimglink_3'] : '',
            adimgurl_4: each['adimgurl_4'] ? each['adimgurl_4'] : '',
            adimglink_4: each['adimglink_4'] ? each['adimglink_4'] : ''
          }
        } else if (each.adtype === 'custom_code') {
          args = {
            adtype: 'custom_code',
            keyds: each.keyds ? each.keyds : '',
            nokeyds: each.nokeyds ? each.nokeyds : '',
            custom_code: each['custom_code'] ? each['custom_code'] : ''
          }
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
