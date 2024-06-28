<template>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div>
        <h1>Категорія Товарів</h1>
        <div class="product-list">
            <product-card1
                v-for="product in products"
                :key="product.id"
                :product="product"
                @add-to-cart="handleAddToCart"
            />
        </div>
    </div>
</template>

<script>

import axios from 'axios';
import ProductCard1 from './ProductCard1.vue';

export default {
    name: 'CategoryPage1',
    components: {
        ProductCard1
    },
    props: {
        products: {
            type: Array,
            required: true
        }
    },
    methods: {
        handleAddToCart(product) {
            console.log("Product added to cart:", product);
            axios.post('/add-to-cart', {
                product_id: product.id
            })
                .then(response => {
                    console.log('Product added to cart:', response.data);
                });
        }

    }
};
</script>

<style scoped>
.product-list {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
}
</style>
