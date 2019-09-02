import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Orders from '../components/Pages/demo/airo/orders/Orders.vue';
import OrderCreate from '../components/Pages/demo/airo/orders/create/Create.vue';

import E404 from '../components/Pages/Errors/e404.vue';

const routes = [
    {
        path: '',
        component: Orders
    },
    {
        path: '/orders',
        component: Orders
    },
    {
        path: '/order-create',
        component: OrderCreate
    }
];

export const router = new VueRouter({
    routes
});
