import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios'
import {router} from '../routes/airo'
import CamelToKebab from '../helpers/camelToKebab'

Vue.use(Vuex);

axios.defaults.baseURL = getCorsBaseUrl();
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['Access-Control-Allow-Methods'] = 'GET,PUT,POST,DELETE,PATCH,OPTIONS';
axios.defaults.headers.common['Access-Control-Allow-Headers'] = 'Origin, Accept, Content-Type, Authorization, Access-Control-Allow-Origin';
axios.defaults.headers.common['Access-Control-Allow-Credentials'] = 'include';
axios.defaults.responseType = 'json';
axios.defaults.withCredentials = true;

export const store = new Vuex.Store({
    state: {

    },
    getters: {
        orders(state) {
            return state.orders ? state.orders : null;
        },
        products(state) {
            return state.products ? state.products : null;
        }
    },
    mutations: {
        setOrders(state, {orders}) {
            Vue.set(state, 'orders', orders);
        },
        setProducts(state, {products}) {
            Vue.set(state, 'products', products);
        },
        handleError(state, {error}) {
            // Error
            if (error.response) {
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                //console.log(1, error.response.data);
                console.log(1, error.response.data.message);
                // console.log(error.response.status);
                // console.log(error.response.headers);
            } else if (error.request) {
                // The request was made but no response was received
                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                // http.ClientRequest in node.js
                console.log(2, error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                console.log(3, 'Error', error.message);
            }
            //console.log(error.config);
        },
    },
    actions: {
        getOrders(store) {
            let url = '/demo/airo/get-orders' ;
            axios.get(url)
                .then(response => {
                    store.commit('setOrders', {orders: response.data})
                })
                .catch(error => {
                    store.commit('handleError', {error: error})
                });
        },
        orderCreate(store, {name, phone, address, tripFrom, tripTo, products}) {
            let url = '/demo/airo/create-order';
            axios.post(url, {name, phone, address, tripFrom, tripTo, products})
                .then(response => {
                    router.push('/')
                })
                .catch(error => {
                    store.commit('handleError', {error: error})
                });
        },
        getProducts(store) {
            let url = '/demo/airo/get-products' ;
            axios.get(url)
                .then(response => {
                    store.commit('setProducts', {products: response.data})
                })
                .catch(error => {
                    store.commit('handleError', {error: error})
                });
        },
    },
    strict: process.env.NODE_ENV !== 'production'
});

function getCorsBaseUrl() {
    if (location.hostname.indexOf('movements.ru') >= 0) {
        return 'http://api.movements.ru';
    } else {
        return 'http://dev-api.chasovye-mehanizmy.ru';
    }
}



