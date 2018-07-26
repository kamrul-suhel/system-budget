import Vue from 'vue';
import Vuex from 'vuex';

import settings from './modules/settings';
import productTransaction from './modules/accounting/product_transaction'

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        products:[],
    },

    mutations: {

    },

    actions: {
        setTransaction({state}, product){

            return new Promise((resolve, reject) => {
                if(state.products.length === 0){
                    state.products.push(product);
                    resolve();
                }else{

                    if(state.products[product.product.index] === 'undefined'){
                        state.products.push(product);
                        resolve();
                    }else{
                        state.products[product.index] = product;
                        resolve();
                    }
                }
            });

        }
    },

    getters: {
        getProduct(state){
            return state.products;
        }
    },

    modules: {
        settings,
        productTransaction
    }
});

export default store;