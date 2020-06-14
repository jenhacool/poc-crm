import loginPage from '../pages/Login.vue';
import dashboardPage from '../pages/Dashboard.vue';

export const routes = [
  {
    path: '/login',
    name: 'login',
    component: loginPage
  },
  {
    path: '/',
    name: 'dashboard',
    meta: {
      requiresAuth: true
    },
    component: dashboardPage
  }
];