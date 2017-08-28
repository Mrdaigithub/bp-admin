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
    }
  }
})
