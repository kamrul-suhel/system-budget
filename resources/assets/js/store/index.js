import Vue from 'vue';
import Vuex from 'vuex';

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
    }
});

export default store;