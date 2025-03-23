import Home from './views/Home.vue';
import Products from './views/Products.vue';
import Cart from './views/Cart.vue';
import Orders from './views/Orders.vue';
import AccountSettings from './views/AccountSettings.vue';
import Login from './views/Login.vue';
import Signup from './views/Signup.vue';

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
    }
]; 