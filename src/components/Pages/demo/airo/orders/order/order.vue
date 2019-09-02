<template>
    <tr class="order order_table-row">
        <td>{{ order.id }}</td>
        <td>{{ created_at }}</td>
        <td>{{ order.client.name }}</td>
        <td>{{ order.client.phone }}</td>
        <td>{{ order.trip.address }}</td>
        <td>{{ date_from }}</td>
        <td>{{ date_to }}</td>
        <items :items="JSON.parse(order.items)"/>
    </tr>
</template>

<script>
    import items from './__items/__items.vue'

    export default {
        props: {
            order: Object
        },
        data() {
            return {
                months: [
                    'января',
                    'февраля',
                    'марта',
                    'апреля',
                    'мая',
                    'июня',
                    'июля',
                    'августа',
                    'сентября',
                    'октябра',
                    'ноября',
                    'декабря'
                ]
            }
        },
        computed: {
            created_at() {
                const date = new Date(this.order.created_at);

                return `
                    ${date.getDate()}
                    ${this.months[date.getMonth()]}
                    ${date.getFullYear()}
                    ${date.getHours()}:${date.getMinutes()}
                    `
            },
            date_from() {
                const date = new Date(this.order.trip.date_from);

                return `
                    ${date.getDate()}
                    ${this.months[date.getMonth()]}
                    ${date.getFullYear()}
                    ${date.getHours()}:${date.getMinutes()}
                    `
            },
            date_to() {
                const date = new Date(this.order.trip.date_to);

                return `
                    ${date.getDate()}
                    ${this.months[date.getMonth()]}
                    ${date.getFullYear()}
                    ${date.getHours()}:${date.getMinutes()}
                    `
            },
        },
        components: {
            items
        },
    }
</script>

<style lang="stylus">
    .order_table-row
        border-bottom solid 1px #ccc
        td
            padding 12px 6px
            font-size 13px

</style>
