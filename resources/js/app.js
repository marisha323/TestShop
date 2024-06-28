import './bootstrap';

import { createApp } from "vue";

import App from "./App.vue";
import CategoryPage1 from './components/CategoryPage1.vue';
import CheckoutPage1 from  './components/CheckoutPage1.vue'
import ProductDetail1 from "./components/ProductDetail1.vue";
import ProductCard1 from "./components/ProductCard1.vue";



const app = createApp({});

// Реєстрація компонентів
app.component('category-page', CategoryPage1);
app.component('checkout-page', CheckoutPage1);
app.component('product-detail', ProductDetail1);
app.component('product-card', ProductCard1);


app.mount("#app");

