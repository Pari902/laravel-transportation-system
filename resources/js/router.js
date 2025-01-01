import { createRouter, createWebHistory } from 'vue-router';
import HomePage from './Components/HomePage.vue';
import RegisterPage from './Components/RegisterPage.vue';
import LoginPage from './Components/LoginPage.vue';
import DashboardPage from './Pages/Dashboard.vue';
import AdminDashboard from './Components/AdminDashboard.vue';

const routes = [
  { path: '/', component: HomePage, name: 'home' },
  { path: '/register', component: RegisterPage, name: 'register' },
  { path: '/login', component: LoginPage, name: 'login' },
  {
    path: '/dashboard',
    component: DashboardPage,
    name: 'dashboard',
    meta: { requiresAuth: true },
  },
  {
    path: '/admin',
    component: AdminDashboard,
    name: 'admin',
    meta: { requiresAuth: true, adminOnly: true },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('token');
  const userRole = localStorage.getItem('role');

  if (to.meta.requiresAuth && !isAuthenticated) {
    next('/login');
  } else if (to.meta.adminOnly && userRole !== 'admin') {
    next('/dashboard');
  } else {
    next();
  }
});

export default router;


