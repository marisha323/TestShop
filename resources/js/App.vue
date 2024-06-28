<template>
    <div>
        <nav>
            <a class="nav-link" href="/category">Категорії</a>
            <a class="nav-link" href="/checkout">Оформлення замовлення</a>
        </nav>
    </div>
</template>

<script>
import CategoryPage from "./components/CategoryPage1.vue";

export default {
    name: 'App',
    components: {CategoryPage}
};
</script>

<style scoped>
nav {
    display: flex;
    justify-content: space-around;
    background-color: #f8f9fa;
    padding: 1rem;
}

nav a {
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

nav a:hover {
    text-decoration: underline;
}
</style>
