import Home from './views/Home.vue';
import Products from './views/Products.vue';
import Cart from './views/Cart.vue';
import Orders from './views/Orders.vue';
import AccountSettings from './views/AccountSettings.vue';
import Login from './views/Login.vue';
import Signup from './views/Signup.vue';
import Checkout from './views/Checkout.vue';
import OrderConfirmation from './views/OrderConfirmation.vue';
import { createRouter, createWebHistory } from 'vue-router';

export default [
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/products',
        component: Products,
        name: 'products'
    },
    {
        path: '/cart',
        component: Cart,
        name: 'cart'
    },
    {
        path: '/orders',
        component: Orders,
        name: 'orders'
    },
    {
        path: '/account',
        component: AccountSettings,
        name: 'account'
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/signup',
        component: Signup,
        name: 'signup'
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
        meta: {
            requiresAuth: false
        }
    },
    {
        path: '/order-confirmation',
        name: 'order-confirmation',
        component: OrderConfirmation,
        meta: {
            requiresAuth: false
        }
    }
];

// const router = createRouter({
//     history: createWebHistory(),
//     routes
// });

// export default router; 