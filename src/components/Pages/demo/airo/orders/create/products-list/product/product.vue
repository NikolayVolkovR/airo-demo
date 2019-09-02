<template>
    <article class="product product_theme_list">
        <div class="product__name text_centered">{{product.name}}</div>
        <div class="product__quantity text_centered">{{product.quantity}} шт </div>
        <div class="product__price text_centered">{{product.price * product.quantity}} руб.</div>
    </article>
</template>

<script>
    export default {
        props: {
            product: Object
        }
    }
</script>

<style lang="stylus">
    .product_theme_list
        display: flex;
        justify-content: space-around;
        margin: 5px 0;

        .product__name
            flex-basis 30%
            max-width 100px
        .product__quantity
            flex-basis 30%
            max-width 60px
        .product__price
            flex-basis 30%
            max-width 100px

    .text_centered {

    }
</style>
