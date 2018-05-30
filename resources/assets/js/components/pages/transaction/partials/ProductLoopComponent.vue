<template>
    <v-layout row wrap>
        <v-flex xs6>
            <v-select
                    label="Select Product"
                    :items="products"
                    append-icon="add_shopping_cart"
                    v-model="selectedProduct"
                    chips
                    persistent-hint
            ></v-select>
        </v-flex>

        <v-flex xs6>
            <v-text-field
                    label="Quantity"
                    type="number"
                    :placeholder="'You have '+ current_product_quantity + ' in your stock'"
                    :hint="'How much you want to sale. your stock is : ' + current_product_quantity"
                    persistent-hint
                    v-model="editedItem.quantity"
            ></v-text-field>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        data() {
            return {
                products: [],
                selectedProduct: [],
                current_product_quantity: '',
                editedItem: {
                    id: '',
                    name: 'New title',
                    email: 'new Description',
                    quantity: '',
                    active: '1',

                },
            }
        },
        watch: {
            selectedProduct(val) {
                var change_product = '';
                this.allProductData.forEach(function(product) {
                    console.log(product);
                    if(val === product.id){

                        change_product =  product;
                    }
                });
                this.current_product_quantity = change_product.quantity;
            },

            selectedPaymentStatus(selectedValue){
                console.log(selectedValue);
            }
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
                            var product = { text: product.name, value : product.id};
                            array_products.push(product);
                        })
                        this.products = array_products;
                    })
                    .catch((error) => {
                        console.log(error)
                    });
            },
        }
    }
</script>