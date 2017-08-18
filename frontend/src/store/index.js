import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loading: false
  },
  mutations: {
    closeLoading (state) {
      state.loading = false
    },
    openLoading (state) {
      state.loading = true
    }
  }
})
