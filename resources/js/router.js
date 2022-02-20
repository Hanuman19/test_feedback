import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);


import Index from "./components/index.vue";
import Test from "./components/form.vue";


const routes = [
    {
        path: '/',
        component: Index
    },
    {
        path: '/form',
        component: Test
    },
];

export default new VueRouter({
    mode:'history',
    routes
});
