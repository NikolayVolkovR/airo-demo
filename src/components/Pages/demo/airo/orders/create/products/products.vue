<template>
    <section class="products products_theme_oder">
        <header class="header products__header">Вещи</header>
            <products-list :products="addedProducts"/>
        <div class="product-add">
            <autocomplete
                    :source="products"
                    @selected="onAutocompleteSelect"
                    @clear="onAutocompleteClear"

            >
            </autocomplete>
            <s-input
                    :icon="false"
                    type="number"
                    :value="product.quantity"
                    @input="onInput_quantity"
            />
            <button
                    class="button product-add__button"
                    :class="buttonClass"
                    @click="onAddClick"
            >Добавить</button>
        </div>
    </section>
</template>

<script>
    import Autocomplete from 'vuejs-auto-complete'
    import sInput from 'Components/common/SInput/SInput.vue'
    import productsList from '../products-list/productsList.vue'

    export default {
        props: {
            products: Array,
            addedProducts: Array,
        },
        data() {
            return {
                product: {
                    value: null,
                    quantity: 1,
                }
            }
        },
        computed: {
            addingAvailable() {
                return this.product.value !== null && this.product.quantity !== null;
            },
            buttonClass() {
                return this.addingAvailable ? 'item-add__button_active' : '';
            },
        },
        methods: {
            onAutocompleteSelect(value) {
                this.product.value = value.value;
            },
            onAutocompleteClear(){
                this.product.value = null;
            },
            onAutocompleteNothingSelected() {
                this.product.value = null;
            },

            onInput_quantity({index, value}) {
                this.product.quantity = value
            },
            onAddClick() {
                if(!this.addingAvailable) {
                    return false;
                }
                let product = this.products.find(product => product.id == this.product.value);
                product['quantity'] = this.product.quantity;
                this.$emit('add', {product: JSON.parse(JSON.stringify(product))});
                this.product.quantity = 1;
            },
        },
        components: {
            Autocomplete,
            sInput,
            productsList
        }
    }
</script>

<style lang="stylus">
    .products_theme_oder
        max-width 400px
        margin 20px auto

    .products__header
        margin-bottom 12px
        font-size 20px
        font-weight bold

    .product-add
        display flex
        .autocomplete
            .autocomplete__box
                border-radius 5px
                border-color #3f6b30

            input
                padding 7px 10px
                font-size 14px

        .s-input
            margin 0!important
            .s-input__label
                display none


        .product-add__button
            font-size 14px!important
            padding 7px 10px
            transition all .2s
            &.item-add__button_active
                background #639355
                color #fff
                cursor pointer



    .product-add__button
        color #888

</style>
