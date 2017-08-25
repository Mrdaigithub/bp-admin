import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loading: false,
    oneself: null
  },
  mutations: {
    getOneself (state, oneself) {
      state.oneself = oneself
    },
    closeLoading (state) {
      state.loading = false
    },
    openLoading (state) {
      state.loading = true
    }
  }
})
