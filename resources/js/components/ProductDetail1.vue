<template>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="product-detail">
        <img :src="product.image" :alt="product.name" class="product-image"  />
        <h1 class="product-name">{{ product.name }}</h1>
        <p class="product-description">{{ product.description }}</p>
        <p class="product-price">${{ product.price }}</p>
        <button @click="addToCart" class="buy-button">Купити</button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'ProductDetail1',
    props: {
        product: {
            type: Object,
            required: true
        }
    },

    methods: {
        productImage(image) {
            return `${image}`; // Впевніться, що ваш шлях до зображення правильний
        },
        addToCart() {
            console.log("Product added to cart:", this.product);
            axios.post('/add-to-cart', {
                product_id: this.product.id,
            })
                .then(response => {
                    console.log('Product added to cart:', response.data);
                });
        }

    }
};
</script>

<style scoped>
.product-detail {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 16px;
    text-align: center;
}

.product-image {
    max-width: 400px;
    height: 400px;
    border-radius: 5px;
    margin-bottom: 16px;
}

.product-name {
    font-size: 2rem;
    margin: 16px 0;
}

.product-description {
    font-size: 1.25rem;
    margin: 16px 0;
    color: #666;
}

.product-price {
    font-size: 1.5rem;
    color: #333;
    margin: 16px 0;
}

.buy-button {
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.buy-button:hover {
    background-color: #218838;
}
</style>
