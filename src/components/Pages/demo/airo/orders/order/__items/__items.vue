<template>
    <td class="order__items order__items_table-cell">
        <ul
                v-for="item in items"
        >
            <li class="order-item__name">
                {{ item.name }} - {{ item.quantity }}шт. {{ parseFloat(item.price) }}руб.
            </li>
        </ul>
    </td>
</template>

<script>
    export default {
        props: {
            items: Array
        }
    }
</script>

<style lang="stylus">
    .order__items_table-cell
        min-width 180px

</style>
