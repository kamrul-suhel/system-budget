<template>
    <v-layout row wrap>
        <v-flex xs6>
            <v-select
                    label="Select Product"
                    :items="products"
                    :hint="'Per unit sale price: '+ current_product_sale_price"
                    append-icon="add_shopping_cart"
                    v-model="selectedProduct"
                    chips
                    return-object
                    persistent-hint
            ></v-select>
        </v-flex>

        <v-flex xs6>
            <v-text-field
                    label="Quantity"
                    type="number"
                    min="1"
                    :placeholder="'You have '+ current_product_quantity + ' in your stock'"
                    :hint="'How much you want to sale. your stock is : ' + current_product_quantity"
                    persistent-hint
                    v-model="selectedQuantity"
            ></v-text-field>
        </v-flex>
    </v-layout>
</template>

<script>

    import TransactionEventBus from '../../../../event_bus/transaction_event';

    export default {
        data() {
            return {
                products: [],
                selectedProduct: [],
                current_product_quantity: '',
                current_product_sale_price:0,
                selectedQuantity:1,
                allProductData:'',
                previous_selected_id:''
            }
        },

        props:['index'],
        watch: {
            selectedProduct(val) {
                console.log(this.selectedProduct);
                this.updateStore(val.value);
            },

            selectedQuantity(val){
                console.log(this.selectedProduct);
                this.updateStore(this.selectedProduct.value);
            },

        },

        created() {
            this.initialize()
        },

        methods: {
            initialize() {

                //get all product
                axios.get('/api/products')
                    .then((response) => {
                        this.products = response.data.products;
                        this.allProductData = response.data.products;
                        var array_products = [];
                        this.products.forEach((product)=> {
                            var product = { text: product.name, value : product.id, quantity: product.quantity, current_product_sale_price: product.sale_price};
                            array_products.push(product);
                        })
                        this.products = array_products;
                        this.selectedProduct = this.products[0];
                        this.current_product_quantity = this.products[0].quantity;
                        this.current_product_sale_price = this.products[0].current_product_sale_price;

                        this.updateStore(this.selectedProduct.value);
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },

            // onBlueQuantity(){
            //     this.updateStore(this.selectedProduct.value);
            // },

            updateStore(val){
                var change_product = {};
                this.allProductData.forEach((product)=> {
                    if(val === product.id){
                        change_product.selected_quantity = this.selectedQuantity;
                        this.current_product_quantity = product.quantity;
                        this.current_product_sale_price = product.sale_price;
                        change_product.index = this.index;
                        change_product.product = product;

                        this.$store.dispatch('setTransaction', change_product)
                            .then(()=>{
                                TransactionEventBus.updateProduct();
                            });
                    }
                });
            }
        }
    }
</script>