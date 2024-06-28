import { createRouter, createWebHistory } from 'vue-router';
import CategoryPage from './components/CategoryPage1.vue';
import ProductDetail from './components/ProductDetail1.vue';
import CheckoutPage from './components/CheckoutPage1.vue';

const routes = [
    { path: '/category', component: CategoryPage },
    { path: '/product/:id', component: ProductDetail, props: true },
    { path: '/checkout', component: CheckoutPage }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
