<template>
    <div class="product-card">
        <a :href="'/product/' + product.id">
        <img :src="getImageUrl(product.image)" :alt="product.name" class="product-image"  />
            </a>
        <h2 class="product-name">{{ product.name }}</h2>
        <p class="product-price">${{ product.price}}</p>
        <button @click="addToCart"  class="buy-button">Купити</button>
    </div>
</template>

<script>
export default {
    name: 'ProductCard1',
    props: {
        product: {
            type: Object,
            required: true
        }
    },
    methods: {
        getImageUrl(image) {
            return `/${image}`; // Впевніться, що ваш шлях до зображення правильний
        },
        addToCart() {
            this.$emit('add-to-cart', this.product);
        }
    }
};
</script>

<style scoped>
.product-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 16px;
    text-align: center;
    transition: box-shadow 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.product-card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.product-image {
    max-width: 400px;
    height: 400px;
    border-radius: 5px;
}

.product-name {
    font-size: 1.25rem;
    margin: 8px 0;
}

.product-price {
    font-size: 1.15rem;
    color: #333;
    margin: 8px 0;
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
