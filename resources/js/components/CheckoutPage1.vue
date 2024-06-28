<template>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="checkout-page">
        <h1>Оформлення замовлення</h1>
        <form @submit.prevent="submitOrder">
            <div class="form-group">
                <label for="name">Ім'я</label>
                <input type="text" v-model="form.customer_name" id="name" required />
            </div>
            <div class="form-group">
                <label for="phone">Номер телефону</label>
                <input type="tel" v-model="form.customer_phone" id="phone" required />
            </div>
            <div class="form-group">
                <label for="email">Ел. пошта</label>
                <input type="email" v-model="form.customer_email" id="email" required />
            </div>
            <h2>Ваші товари</h2>
            <ul class="cart-items">
                <li v-for="item in cartItems" :key="item.id">
                    <img :src="item.product.image" :alt="item.product.name" class="cart-item-image" />
                    <span class="cart-item-name">{{ item.product.name }}</span>
                    <span class="cart-item-price">${{ item.product.price }}</span>
                </li>
            </ul>
            <button type="submit" class="submit-button">Оформити замовлення</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'CheckoutPage1',
    data() {
        return {
            form: {
                customer_name: '',
                customer_phone: '',
                customer_email: ''
            },
            cartItems: []
        };
    },
    methods: {
        getImageUrl(image) {
            return `/${image}`;
        },
        submitOrder() {
            console.log('Замовлення оформлено', this.form);

            axios.post('/store-order', {
                customer_name: this.form.customer_name,
                customer_phone: this.form.customer_phone,
                customer_email: this.form.customer_email,
                cart_items: this.cartItems.map(item => ({
                    product_id: item.product.id,
                    count: item.count
                }))
            })
                .then(response => {
                    window.location.href = '/';
                    console.log('Замовлення збережено:', response.data);
                })
                .catch(error => {
                    console.error('Помилка при збереженні замовлення:', error);
                });
        },
        fetchCartItems() {
            axios.get('/show-basket')
                .then(response => {
                    this.cartItems = response.data.products;
                })
                .catch(error => {
                    console.error('Помилка при завантаженні кошика:', error);
                });
        }
    },
    mounted() {
        this.fetchCartItems();
    }
};
</script>

<style scoped>
.checkout-page {
    max-width: 600px;
    margin: 0 auto;
    padding: 16px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #fff;
}

h1, h2 {
    text-align: center;
}

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
}

.form-group input {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}

.cart-items {
    list-style: none;
    padding: 0;
    margin: 16px 0;
}

.cart-items li {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.cart-item-image {
    width: 50px;
    height: 50px;
    margin-right: 16px;
    border-radius: 5px;
}

.cart-item-name {
    flex: 1;
}

.cart-item-price {
    font-size: 1.1rem;
    color: #333;
}

.submit-button {
    width: 100%;
    padding: 12px;
    border: none;
    background-color: #28a745;
    color: #fff;
    font-size: 1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.submit-button:hover {
    background-color: #218838;
}
</style>

