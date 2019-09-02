<template>
    <form class="s-form" @submit.prevent="">
        <div class="s-form__inputs">
            <s-input
                    :label="fields.name.label"
                    :required="true"
                    :icon="true"
                    :value="fields.name.value"
                    @validate="onValidate_name"
                    @input="onInput_name"
            />
            <s-input-phone
                    :label="fields.phone.label"
                    :required="true"
                    :value="fields.phone.value"
                    :icon="true"
                    @validate="onValidate_phone"
                    @input="onInput_phone"
            />
            <s-input
                    :label="fields.address.label"
                    :required="true"
                    :icon="true"
                    :value="fields.address.value"
                    @validate="onValidate_address"
                    @input="onInput_address"
            />
            <div class="s-input">
                <div class="s-input__label">Дата и время "C" *</div>
                <div class="s-input__input-message">
                    <date-picker
                            v-model="fields.tripFrom.value"
                            lang="ru"
                            type="datetime"
                            :time-picker-options="timePickerOptions"
                            @input="onInput_tripFrom"
                            @clear="onClear_tripFrom"
                    />
                </div>
                <div class="s-input__icon-wrap"></div>
            </div>
            <div class="s-input">
                <div class="s-input__label">Дата и время "До" *</div>
                <div class="s-input__input-message">
                    <date-picker
                            v-model="fields.tripTo.value"
                            lang="ru"
                            type="datetime"
                            :time-picker-options="timePickerOptions"
                            @input="onInput_tripTo"
                            @clear="onClear_tripTo"
                    />
                </div>
                <div class="s-input__icon-wrap"></div>
            </div>
        </div>
        <products
                :products="products"
                :added-products="addedProducts"
                @add="onProductAdd"
        />
        <div class="s-form__buttons">
            <button
                    class="button s-form__button"
                    :class="buttonClass"
                    @click="onSubmit"
            >
                Создать заказ
            </button>
        </div>
    </form>
</template>

<script>
    import sInput from 'Components/common/SInput/SInput.vue'
    import sInputPhone from 'Components/common/SInput/SInputPhone.vue'
    import DatePicker from 'vue2-datepicker'
    import products from '../products/products.vue'

    export default {
        props: {
            products: Array
        },
        data() {
            return {
                fields: {
                    name: {
                        label: 'Имя клиента',
                        value: null,
                        isValid: false
                    },
                    phone: {
                        label: 'Телефон клиента',
                        value: null,
                        isValid: false
                    },
                    address: {
                        label: 'Адрес выезда',
                        value: null,
                        isValid: false
                    },
                    tripFrom: {
                        label: 'Выезд С',
                        value: null,
                        isValid: false
                    },
                    tripTo: {
                        label: 'Выезд С',
                        value: null,
                        isValid: false
                    },
                },
                timePickerOptions:{
                    start: '00:00',
                    step: '00:10',
                    end: '23:30'
                },
                addedProducts: [],
            }
        },
        computed: {
            isComplete() {
                return this.fields.name.isValid
                    && this.fields.phone.isValid
                    && this.fields.address.isValid
                    && this.fields.tripFrom.isValid
                    && this.fields.tripTo.isValid;
            },
            buttonClass() {
                return this.isComplete ? 's-form__button_active' : '';
            },
        },
        methods: {
            onValidate_name({isValid, index}) {
                this.fields.name.isValid = isValid;
            },
            onInput_name({index, value}) {
                this.fields.name.value = value;
            },
            onValidate_phone({isValid, index}) {
                this.fields.phone.isValid = isValid;
            },
            onInput_phone({index, value}) {
                this.fields.phone.value = value;
            },
            onValidate_address({isValid, index}) {
                this.fields.address.isValid = isValid;
            },
            onInput_address({index, value}) {
                this.fields.address.value = value;
            },
            onInput_tripFrom(value) {
                this.fields.tripFrom.value = value;
                this.fields.tripFrom.isValid = true;
            },
            onClear_tripFrom(value) {
                this.fields.tripFrom.value = null;
                this.fields.tripFrom.isValid = false;
            },
            onInput_tripTo(value) {
                this.fields.tripTo.value = value;
                this.fields.tripTo.isValid = true;
            },
            onClear_tripTo(value) {
                this.fields.tripTo.value = null;
                this.fields.tripTo.isValid = false;
            },
            onSubmit() {
                if (this.isComplete) {
                    this.$emit('submit', {
                        name: this.fields.name.value,
                        phone: this.fields.phone.value,
                        address: this.fields.address.value,
                        tripFrom: this.fields.tripFrom.value,
                        tripTo: this.fields.tripTo.value,
                        products: JSON.stringify(this.addedProducts),
                    })
                }
            },

            onProductAdd({product}) {
                this.addedProducts.push(product)
            }
        },
        components: {
            sInput, sInputPhone, DatePicker, products
        },
    }
</script>

<style lang="stylus">
    .s-form {
        margin: 20px auto 0;
        position: relative;
        .s-input, .s-select {
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            margin: 10px 0;
            position: relative;
            .s-input__label, .s-select__label {
                flex-basis: 25%;
                text-align: right;
                margin-top: 9px;
            }
            .s-input__input-message, .s-select__input-message {
                box-sizing: border-box;
                flex-basis: 70%;
                max-width: 200px;
                padding: 0 10px;
                input, select {
                    box-sizing: border-box;
                    width: 100%;
                    padding: 7px 10px;
                    border: solid 1px #3f6b30;
                    border-radius: 5px;
                    font-size: 16px;
                    outline: none;
                }
                .s-input__hint {
                    font-size: 13px;
                    color: #888;
                }
                .s-input__message {
                    margin: 5px 0 20px;
                    font-size: 13px;
                    font-family: "Century Gothic";
                    color: #AF4925;
                }
                .s-select__message {
                    margin: 10px 0;
                    font-size: 13px;
                    font-family: "Century Gothic";
                    color: #333;
                }
            }
            .s-select__input-message {
                margin-right: 21px;
            }
            .s-input__icon-wrap {
                width: 21px;
                height: 21px;
                margin-top: 5px;
            }
        }
    }
    .s-form__buttons {
        margin-top: 30px;
        display: flex;
        justify-content: center
        .s-form__button {
            display: block;
            color: #888;
            transition: all .3s;
            margin: 0 20px;
            font-size 16px
            padding 12px 18px
            text-transform uppercase

            &.s-form__button_active {
                background: #639355;
                color: #fff;
                cursor: pointer;
            }
        }
        .s-form__cancel-button {
            background: #567f96;
            color: #fff;
            cursor: pointer;
        }
    }

    .button
        font-family "Century Gothic"
        text-align center
        border none
        border-radius 4px
        font-weight bold
</style>
