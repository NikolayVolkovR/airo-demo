<template>
    <section class="products-list products-list_theme_order-create">
        <product
                v-for="product in products"
                :key="product.id"
                :product="product"
        />
    </section>
</template>

<script>
    import product from './product/product.vue'

    export default {
        props: {
            products: Array
        },
        components: {
            product
        }
    }
</script>

<style lang="stylus">
    .products-list_theme_order-create
        margin: 20px auto

</style>
