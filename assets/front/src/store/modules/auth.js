import api from '../../services/api'

api.init()

export default {
  namespaced: true,
  state: {
    isAuthenticated: !!localStorage.getItem('wp_nonce'),
    loginFailed: false,
    loginFailMessage: '',
  },
  mutations: {
    authenticate(state) {
      state.isAuthenticated = true
    },
    loginFailed(state, message) {
      state.loginFailed = true
      state.loginFailMessage = message
    }
  },
  actions: {
    login(context, info) {
      context.commit('submitting', true, { root: true })
      api.post('/login', info).then((response) => {
        context.commit('submitting', false, { root: true })
        localStorage.setItem('wp_nonce', response.data.nonce)
        context.commit('authenticate')
      }).catch((error) => {
        context.commit('submitting', false, { root: true })
        context.commit('loginFailed', error.response.data.message)
      })
    }
  },
  getters: {
    loginFailed: state => {
      return state.loginFailed
    },
    loginFailMessage: state => {
      return state.loginFailMessage
    }
  }
}