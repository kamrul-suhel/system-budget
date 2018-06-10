import Vue from 'vue';

const TransactionEventBus = new Vue({
    data(){
        return{

        }
    },

    methods: {
        updateProduct(){
            this.$emit('updateProduct');
        }
    }

})
export default TransactionEventBus;