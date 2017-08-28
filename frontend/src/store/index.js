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
