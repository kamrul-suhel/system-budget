<template>
    <div class="products">
        <v-container grid-list-md>
            <v-layout row wrap>
                <v-flex xs12>
                    <h2>Transition</h2>
                </v-flex>
            </v-layout>

            <v-divider class="mb-3 dark"></v-divider>

            <v-layout row wrap>
                <v-flex xs3>
                    <v-card flat class="cyan lighten-1 white--text">
                        <v-card-title>Total Transactions</v-card-title>
                        <v-card-text class="pt-0">
                            <h2 class="display-2 white--text text-xs-center"><strong>{{ total_transactions }}</strong>
                            </h2>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <v-flex xs3>
                    <v-card flat class="light-blue white--text">
                        <v-card-title>Total Amount Transactions</v-card-title>
                        <v-card-text class="pt-0">
                            <h2 class="display-2 white--text text-xs-center"><strong>&#2547;
                                {{ total_amount_transactions }}</strong></h2>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <!--<v-flex xs3>-->
                <!--<v-card flat class="light-green lighten-1 white&#45;&#45;text">-->
                <!--<v-card-title>Deactive Customer</v-card-title>-->
                <!--<v-card-text class="pt-0">-->
                <!--<h2 class="display-2 white&#45;&#45;text text-xs-center"><strong>350</strong></h2>-->
                <!--</v-card-text>-->
                <!--</v-card>-->
                <!--</v-flex>-->

                <!--<v-flex xs3>-->
                <!--<v-card flat class="orange darken-1 white&#45;&#45;text">-->
                <!--<v-card-title>Highest Customer</v-card-title>-->
                <!--<v-card-text class="pt-0">-->
                <!--<h2 class="display-2 white&#45;&#45;text text-xs-center"><strong>350</strong></h2>-->
                <!--</v-card-text>-->
                <!--</v-card>-->
                <!--</v-flex>-->
            </v-layout>
        </v-container>

        <v-dialog
                v-model="dialog"
                persistent>
            <v-card class="px-2 py-2">
                <v-card-title>
                    <v-container grid-list-xl pa-0>
                        <v-layout wrap>
                            <v-flex>
                                <span class="headline">{{ formTitle }}</span>
                            </v-flex>
                        </v-layout>
                    </v-container>

                </v-card-title>
                <v-card-text class="pt-0">
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs6>
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

                            <v-flex xs6>
                                <v-select
                                    label="Payment Status"
                                    hint="What is the payment status."
                                    :items="paymentStatus"
                                    v-model="selectedPaymentStatus"
                                    ></v-select>
                            </v-flex>

                                <v-flex xs6 v-if="selectedPaymentStatus > 1">
                                    <v-text-field
                                      name="payment_due"
                                      label="Payment left"
                                      v-model="payment_due"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs6 v-if="selectedPaymentStatus > 1">
                                    <v-text-field
                                        label="How much paied"
                                        v-model="paied"
                                        hint="Put how much paied">
                                        
                                    </v-text-field>
                                </v-flex>

                        </v-layout>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn dark color="dark" raised @click.native="close">Cancel</v-btn>

                    <v-btn dark color="dark" raised @click.native="save">{{ editedIndex == -1 ? 'Create Transaction' :
                        'Update Transaction' }}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-container grid-list-lg>
            <v-layout row wrap>
                <v-card
                        raised
                        width="100%">
                    <v-card-title class="pb-0 pt-0">
                        <v-btn dark fab small color="dark" @click="dialog = true">
                            <v-icon>add</v-icon>
                        </v-btn>

                        <v-spacer></v-spacer>
                        <v-text-field
                                prepend-icon="search"
                                label="Search"
                                v-model="search"></v-text-field>
                    </v-card-title>

                    <v-card-text>
                        <v-data-table
                                :headers="headers"
                                :items="items"
                                :search="search"
                                :pagination.sync="pagination"
                                :rows-per-page-items="row_per_page"
                                item-key="name"
                        >

                            <template slot="headers" slot-scope="props">
                                <tr>
                                    <th
                                            v-for="header in props.headers"
                                            :key="header.value"
                                            :class="['column sortable', pagination.descending ? 'desc' : 'asc', header.value === pagination.sortBy ? 'active' : '']"
                                            @click="changeSort(header.value)"
                                    >
                                        <v-icon small>arrow_upward</v-icon>
                                        {{ header.text}}
                                    </th>
                                </tr>
                            </template>

                            <template slot="items" slot-scope="props">
                                <td class="text-xs-center">{{ props.item.customer.name }}</td>
                                <td class="text-xs-center">{{ props.item.customer.phone }}</td>
                                <td class="text-xs-center">{{ props.item.customer.mobile }}</td>
                                <td class="text-xs-center">{{ props.item.product.name }}</td>
                                <td class="text-xs-center">{{ props.item.quantity }}</td>
                                <td class="text-xs-center">{{ props.item.payment_status }}</td>
                                <td class="text-xs-center">{{ props.item.product.seller.name }}</td>
                                <td class="justify-start layout px-0">
                                    <v-btn icon class="mx-0" @click="editItem(props.item)">
                                        <v-icon color="dark">edit</v-icon>
                                    </v-btn>
                                    <v-btn icon class="mx-0" @click="viewTransition(props.item)">
                                        <v-icon clor="dark">view_comfy</v-icon>
                                    </v-btn>
                                    <v-btn icon class="mx-0" @click="deleteItem(props.item)">
                                        <v-icon color="pink">delete</v-icon>
                                    </v-btn>
                                </td>
                            </template>

                            <v-alert slot="no-results" :value="true" color="error" icon="warning">
                                Your search for "{{ search }}" found no results.
                            </v-alert>

                            <template slot="no-data">
                                Sorry no products found
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-layout>
        </v-container>
    </div>
</template>
<script>
    /* eslint-disable no-unreachable */

    import axios from 'axios'

    export default {
        data: () => ({
            dialog: false,
            total_transactions: 0,
            total_amount_transactions: 0,

            search: '',
            pagination: {
                sortBy: 'name'
            },

            headers: [
                {
                    text: 'C Name',
                    value: 'customer_name',
                    sortable: true
                },

                {
                    text: 'C Phone',
                    value: 'customer_phone',
                    sortable: false
                },
                {
                    text: 'C Mobile',
                    value: 'customer_mobile',
                    sortable: false
                },
                {
                    text: 'Product',
                    value: 'product',
                    sortable: true
                },
                {
                    text: 'Quantity',
                    value: 'sale_total_product',
                    sortable: true
                },
                {
                    text: 'Status',
                    value: 'transaction_status',
                    sortable: true
                },
                {
                    text: 'S name',
                    value: 'seller_name',
                    sortable: true
                },
                {
                    text: 'Actions'
                }
            ],
            total_customer: '',
            items: [],
            products: [],
            allProductData: [],
            current_product_quantity: '',
            selectedProduct: [],
            customers: [],
            selectedCustomer:[],
            payment_due:'',
            paied:'',

            editedIndex: -1,
            editedItem: {
                id: '',
                name: 'New title',
                email: 'new Description',
                quantity: '',
                active: '1',

            },
            paymentStatus:[{text: 'Paied', value: 1}, {text: 'Due', value:2}, {text: 'Half paied', value:3}],
            selectedPaymentStatus:1,
            active: [1, 2],


            defaultItem: {
                name: '',
                descriptin: ''
            },
            row_per_page: [20, 30, 40, 50, {'text': 'All', 'value': -1}],

        }),

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Transaction' : 'Edit Transaction'
            }
        },

        watch: {
            dialog(val) {
                val || this.close()
            },

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
                // get all transaction
                axios.get('/api/transactions')
                    .then((response) => {
                        this.items = response.data.transactions;
                        console.log(this.items);
                        this.total_transactions = response.data.total_transactions;
                        this.total_amount_transactions = response.data.total_tk;
                        console.log(this.items);
                    })
                    .catch((error) => {
                        console.log(error)
                    })

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

            editItem(item) {
                // get selected categories & all categories
                let url = '/api/products/' + item.id + '/categories'
                console.log('Edite item: ');
                console.log(item);
                return;

                axios.get(url)
                    .then((response) => {
                        let selectedCategories = response.data
                        selectedCategories.forEach((value) => {
                            let categories = {}
                            categories.value = value.id
                            categories.text = value.name
                            this.selectedCategories.push(categories)
                        })
                    })
                this.editedIndex = this.items.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                const index = this.items.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.items.splice(index, 1)
            },

            close() {
                this.dialog = false
                this.selectedCategories = []
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            save() {
                let form = new FormData()
                let url = ' api/products/'+this.selectedProduct+'/customers/'+this.selectedCustomer+'/transactions';

                console.log(url);

                form.append('quantity', this.editedItem.quantity);
                form.append('payment_status', this.selectedPaymentStatus);
                form.append('payment_due', this.payment_due);
                form.append('paied', this.paied);


                if (this.editedIndex !== -1) {
                    // update product
                    form.append('_method', 'PATCH')
                    url = url + '/' + this.editedItem.id
                    axios.post(url, form)
                        .then((response) => {
                            Object.assign(this.items[this.editedIndex], this.editedItem)
                        })
                } else {
                    // create product
                    axios.post(url, form)
                        .then((response) => {
                            console.log(response);
                            this.items.push(response.data)
                        })
                }

                this.close()
            },

            changeSort(column) {
                if (this.pagination.sortBy === column) {
                    this.pagination.descending = !this.pagination.descending
                } else {
                    this.pagination.sortBy = column
                    this.pagination.descending = false
                }
            },

            viewTransition(){

            }
        }
    }
</script>
