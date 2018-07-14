<template>
    <section class="create-transaction">
        <v-container grid-list-lg>
            <v-layout row wrap>
                <v-card
                        raised
                        width="100%">
                    <v-card-text>
                        <h2>Create Transaction</h2>
                        <v-container grid-list-md>
                            <v-layout row wrap>
                                <v-flex xs12>
                                    <v-select
                                            label="Select Customer"
                                            :items="customers"
                                            v-model="selectedCustomer"
                                            append-icon="account_circle"
                                            chips
                                            persistent-hint
                                    >
                                    </v-select>
                                </v-flex>
                            </v-layout>

                            <product-component v-for="(product, index) in total_product" :key="index" :index="index"></product-component>

                            <v-layout row wrap>
                                <v-flex xs12>
                                    <v-btn fab small @click="total_product++">
                                        <v-icon>add</v-icon>
                                    </v-btn>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs6>
                                    <v-select
                                            label="Payment Status"
                                            hint="What is the payment status."
                                            :items="paymentStatus"
                                            v-model="selectedPaymentStatus"
                                    ></v-select>
                                </v-flex>

                                <v-flex xs6>
                                    <v-text-field
                                            label="Discount amount"
                                            v-model="discount"
                                            type="number"
                                            hint="Put how much paied">

                                    </v-text-field>
                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs6 v-if="selectedPaymentStatus > 1">
                                    <v-text-field
                                            label="How much paied"
                                            v-model="paied"
                                            type="number"
                                            hint="Put how much paied">

                                    </v-text-field>
                                </v-flex>
                            </v-layout>


                            <v-layout row wrap>
                                <v-spacer></v-spacer>
                                <v-flex xs3 class="text-xs-right">
                                    <p><strong>Total: {{ total_amount_transactions }}</strong></p>
                                    <p v-if="paied > 0"><strong>Paied: {{ paied }}</strong></p>
                                </v-flex>
                                <v-flex xs3 class="text-xs-right">
                                    <p v-if="selectedPaymentStatus > 1"><strong>Due: {{ total_amount_transactions - paied }}</strong></p>
                                    <p><strong>Discount: {{ discount }}</strong></p>
                                    <p><strong>Grand total: {{ total_amount_transactions - discount }}</strong></p>

                                </v-flex>
                            </v-layout>

                            <v-layout row wrap>
                                <v-flex xs12 class="text-xs-right">
                                    <v-btn dark raised @click="onCreateTransaction()">
                                        Create transaction
                                    </v-btn>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-layout>
        </v-container>


    </section>
</template>

<script>
    import ProductLoopComponent from './partials/ProductLoopComponent';
    import TransactionEventBus from '../../../event_bus/transaction_event';
    export default {
        components:{
            'productComponent': ProductLoopComponent
        },

        data: () => ({
            total_transactions: 0,
            total_amount_transactions: 0,

            items: [],
            allProductData: [],

            total_product: 1,

            customers: [{text: '', value: 1}],
            selectedCustomer:[],
            payment_due:'',
            paied:'',
            discount:0,

            paymentStatus:[{text: 'Paied', value: 1}, {text: 'Due', value:2}, {text: 'Half paied', value:3}],
            selectedPaymentStatus:1,
            active: [1, 2],





        }),

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Transaction' : 'Edit Transaction'
            }
        },

        watch: {
            selectedProduct(val) {
                var change_product = '';
                this.allProductData.forEach(function(product) {
                    if(val === product.id){
                        change_product =  product;
                    }
                });
                this.current_product_quantity = change_product.quantity;
            }
        },

        created() {
            this.initialize();

            TransactionEventBus.$on('updateProduct', () => {
                var totalTransactions = this.$store.getters.getProduct;
                var total = 0;
                totalTransactions.forEach((product) => {
                    total += product.product.sale_price * product.selected_quantity;
                });

                this.total_amount_transactions = total;
            });
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


                // get all customers
                axios.get('/customers')
                    .then((response) => {
                        this.customers = response.data;
                        var array_customer = [];
                        this.customers.forEach((customer)=> {
                            var customer = { text: customer.name, value : customer.id};
                            array_customer.push(customer);
                        })
                        this.customers = array_customer;

                    })
                    .catch((error) => {
                        console.log(error)
                    });

            },

            onCreateTransaction(){
                let form = new FormData()
                let total = this.total_amount_transactions - this.discount;

                let url = '/api/customers/'+this.selectedCustomer+'/transactions';

                form.append('payment_status', this.selectedPaymentStatus);
                form.append('discount', this.discount);
                form.append('total', total);

                if(this.selectedPaymentStatus > 1){
                    form.append('payment_due', total - this.paied);
                }
                form.append('paied', this.paied);

                var products = JSON.stringify(this.$store.getters.getProduct);
                form.append('products', products);

                axios.post(url, form)
                    .then((response)=>{
                        if(response.data){
                            TransactionEventBus.createProduct('Transaction successfully created');
                            this.$router.push({'name': 'transaction'});
                        }
                    });
            },


            close() {
                this.dialog = false
                this.selectedCategories = []
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },


        }
    }
</script>