<template>
    <div class="container">
        <h1>{{ title }}</h1>

        <ul>
            <li v-for="product in products">{{ product.name }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                title: 'Products',
            };
        },

        mounted() {
        }
    }
</script>

<style scoped></style>
