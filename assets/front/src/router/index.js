import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from './routes'
import { isAuthenticated } from '../utils/auth'

Vue.use(VueRouter)

const router = new VueRouter({
  base: '/crm',
  mode: 'history',
  routes,
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    ! isAuthenticated() ? next({name: 'login'}) : next()
  } else {
    next()
  }
})

export default router