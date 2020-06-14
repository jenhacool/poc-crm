import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import auth from './modules/auth'

const store = new Vuex.Store({
  state: {
    submitting: false,
  },
  mutations: {
    submitting(state, status) {
      state.submitting = status;
    }
  },
  modules: {
    auth
  }
})

export default store