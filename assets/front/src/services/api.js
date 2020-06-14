import axios from 'axios'
import store from '../store'

const API_URL = 'http://crm.test/wp-json/poc-crm/v1'

const apiService = {
  init() {
    axios.defaults.baseURL = API_URL
  },
  setHeader() {
    axios.defaults.headers.common = {
      'X-WP-Nonce': store.state.auth.wp_nonce
    }
  },
  get(path, params) {
    return axios.get(path, {
      params: params
    })
  },
  post(path, params) {
    return axios.post(path, params);
  },
}

export default apiService