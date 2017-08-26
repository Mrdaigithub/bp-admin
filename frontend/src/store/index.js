import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loading: false,
    oneself: null,
    config: null
  },
  mutations: {
    getOneself (state, oneself) {
      state.oneself = oneself
    },
    getConfig (state, config) {
      state.config = config
    },
    closeLoading (state) {
      state.loading = false
    },
    openLoading (state) {
      state.loading = true
    }
  }
})
