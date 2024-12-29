import { createRouter, createWebHistory } from 'vue-router';
import HomePage from './Components/HomePage.vue';
import RegisterPage from './Components/RegisterPage.vue';
import LoginPage from './Components/LoginPage.vue';
import DashboardPage from './Pages/Dashboard.vue';


const routes = [
    { path: '/', component: HomePage, name: 'home' },
    { path: '/register', component: RegisterPage, name: 'register' },
    { path: '/login', component: LoginPage, name: 'login' },
    {
        path: '/dashboard',
        component: DashboardPage,
        name: 'dashboard',
        meta: { requiresAuth: true }, // Add meta field to protect the route
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// Add route guard for authentication
router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('token'); // Check if token exists
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login'); // Redirect to login if not authenticated
    } else {
        next(); // Allow navigation
    }
});

export default router;

