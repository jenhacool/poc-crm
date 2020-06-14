import store from '../store'

export const isAuthenticated = () => {
  return store.state.auth.isAuthenticated
}