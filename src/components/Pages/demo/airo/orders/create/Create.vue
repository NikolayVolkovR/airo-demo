<template>
    <div class="wrap">
        <transition name="fade" mode="out-in">
            <div v-if="loading" class="loading">
                <font-awesome-icon icon="spinner" spin  size="lg"/>
            </div>
            <section v-else class="order-create">
                <create-form
                        :products="products"
                        @submit="onFormSubmit"
                />
            </section>
        </transition>
    </div>
</template>
<script>
    import createForm from './form/form.vue'

    export default {
        created() {
            this.getProducts();
        },
        computed: {
            products() {
                return this.$store.getters.products
            },
            loading() {
                return this.products === null;
            },
        },
        methods: {
            getProducts() {
                this.$store.dispatch('getProducts');
            },
            onFormSubmit(params) {
                this.$store.dispatch('orderCreate', params)
            }
        },
        components: {
            createForm
        }
    }
</script>
<style lang="stylus">
    body
        background #fefeef
    .wrap
        position: relative
        margin: 40px auto
        max-width: 800px

    .loading
        position relative
        display flex
        justify-content center
        align-items center
        margin 40px auto
        color #555;

    .header
        font-family "Century Gothic"
        color #333
    .text_centered {
        text-align center
    }
</style>
