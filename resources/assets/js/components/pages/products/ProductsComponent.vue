<template>
    <div class="products">

        <v-dialog
                v-model="dialog"
                persistent>
            <v-card class="px-2 py-2">
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                    <v-container fluid grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field label="Title" v-model="editedItem.name"></v-text-field>
                            </v-flex>

                            <v-flex xs12>
                                <v-text-field
                                        label="Description"
                                        v-model="editedItem.description"
                                        multi-line
                                ></v-text-field>
                            </v-flex>

                            <v-flex xs6>
                                <v-text-field
                                        label="Quantity"
                                        type="number"
                                        placeholder="00.00"
                                        v-model="editedItem.quantity"
                                ></v-text-field>
                            </v-flex>

                            <v-flex xs6>
                                <v-select
                                        label="Quantity type"
                                        :items="quantity_type"
                                        v-model="editedItem.quantity_type"
                                        auto
                                ></v-select>
                            </v-flex>

                            <v-flex xs6>
                                <v-select
                                        :items="status"
                                        v-model="editedItem.status"
                                        label="Status"
                                        auto
                                ></v-select>
                            </v-flex>

                            <v-flex xs6>
                                <v-text-field
                                        label="Sale Price"
                                        type="number"
                                        placeholder="00.00"
                                        prefix="TK"
                                        v-model="editedItem.sale_price"
                                ></v-text-field>
                            </v-flex>

                            <v-flex xs6>
                                <v-text-field
                                        label="Purchase price"
                                        type="number"
                                        placeholder="00.00"
                                        prefix="TK"
                                        v-model="editedItem.purchase_price">
                                </v-text-field>
                            </v-flex>

                            <v-flex xs6>
                                <v-select
                                        label="Categories"
                                        :items="categories"
                                        v-model="selectedCategories"
                                        multiple
                                        chips
                                        persistent-hint
                                >
                                </v-select>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn dark color="dark" raised @click.native="close">Cancel</v-btn>

                    <v-btn dark color="dark" raised @click.native="save">{{ editedIndex === -1 ? 'Create product' :
                        'Update product' }}
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-container grid-list-md class="pt-0">
            <v-layout row wrap>
                <v-flex xs12 class="pt-0">
                    <h2>Products</h2>
                </v-flex>
            </v-layout>

            <v-divider class="mb-3 dark"></v-divider>

            <v-layout row wrap>
                <v-flex xs3>
                    <v-card flat class="cyan lighten-1 white--text">
                        <v-card-title>Total product</v-card-title>
                        <v-card-text class="pt-0">
                            <h2 class="display-2 white--text text-xs-center"><strong>350</strong></h2>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <v-flex xs3>
                    <v-card flat class="light-blue white--text">
                        <v-card-title>Total product</v-card-title>
                        <v-card-text class="pt-0">
                            <h2 class="display-2 white--text text-xs-center"><strong>350</strong></h2>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <v-flex xs3>
                    <v-card flat class="light-green lighten-1 white--text">
                        <v-card-title>Total product</v-card-title>
                        <v-card-text class="pt-0">
                            <h2 class="display-2 white--text text-xs-center"><strong>350</strong></h2>
                        </v-card-text>
                    </v-card>
                </v-flex>

                <v-flex xs3>
                    <v-card flat class="orange darken-1 white--text">
                        <v-card-title>Total product</v-card-title>
                        <v-card-text class="pt-0">
                            <h2 class="display-2 white--text text-xs-center"><strong>350</strong></h2>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>

        <v-container grid-list-md>
            <v-layout row wrap>
                <v-card width="100%">
                    <v-card-title>
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
                                <td>{{ props.index +=1 }}</td>
                                <td class="text-xs-center">{{ props.item.name }}</td>
                                <td class="text-xs-center">{{ props.item.quantity }}</td>
                                <td class="text-xs-center">{{ props.item.quantity_type }}</td>
                                <td class="text-xs-center">TK. {{ props.item.sale_price }}</td>
                                <td class="text-xs-center">TK. {{ props.item.purchase_price }}</td>
                                <td class="text-xs-center">{{ props.item.status }}</td>
                                <td class="justify-start layout px-0">
                                    <v-btn icon class="mx-0" @click="editItem(props.item)">
                                        <v-icon color="primary">edit</v-icon>
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

        <v-snackbar
                :timeout="4000"
                top
                right
                color="success"
                multi-line
                v-model="snackbar">
            {{ snackbar_message }}
        </v-snackbar>
    </div>
</template>
<script>
    /* eslint-disable no-unreachable */

    import axios from 'axios'

    export default {
        data: () => ({
            dialog: false,
            search: '',
            pagination: {
                sortBy: 'name'
            },

            snackbar: false,
            snackbar_message: '',

            headers: [
                {
                    text: 'Id',
                    align: 'left',
                    sortable: true,
                    value: 'id'
                },
                {
                    text: 'Title',
                    value: 'name',
                    sortable: true
                },

                {
                    text: 'Quantity',
                    value: 'quantity',
                    sortable: true
                },
                {
                    text: 'Type',
                    value: 'quantity_types',
                    sortable: true
                },
                {
                    text: 'Sale price',
                    value: 'sale_price',
                    sortable: true
                },
                {
                    text: 'Purchase price',
                    value: 'purchase_price',
                    sortable: true
                },
                {
                    text: 'Status',
                    value: 'status',
                    sortable: true
                },
                {
                    text: 'Action',
                    value: 'action'
                }
            ],
            total_product: '',
            items: [],
            status: [
                {
                    text: 'Avaliable',
                    value: 'available'
                },
                {
                    text: 'Unavaliable',
                    value: 'unavailable'
                }
            ],
            editedIndex: -1,
            editedItem: {
                id: '',
                name: '',
                description: '',
                quantity: '',
                status: 'available',
                sale_price: '200',
                purchase_price: '150',
                quantity_type: 'kg'
            },

            quantity_type: [],

            categories: [],
            selectedCategories: [],
            update_form : false,

            defaultItem: {
                name: '',
                descriptin: ''
            },
            row_per_page: [20, 30, 50, {'text': 'All', 'value': -1}],

            purchase_price_field: false
        }),

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Product' : 'Edit Product'
            }
        },

        watch: {
            dialog(val) {
                val || this.close()
            }
        },

        created() {
            this.initialize()
        },

        methods: {
            initialize() {
                // get all product
                axios.get('/api/products')
                    .then((response) => {
                        this.items = response.data.products;
                        this.quantity_type = response.data.quantity_types;
                        this.total_product = response.data.total_product;
                    })
                    .catch((error) => {
                        console.log(error)
                    });

                // get all categories
                axios.get('/api/categories')
                    .then((response) => {
                        let categories = response.data;
                        categories.forEach((value) => {
                            let category = {};
                            category.value = value.id;
                            category.text = value.name;

                            this.categories.push(category)
                        })
                    })
                    .catch((error) => {
                        console.log('categories error');
                        console.log(error)
                    })
            },

            editItem(item) {
                // get selected categories & all categories
                let url = '/api/products/' + item.id + '/categories';

                axios.get(url)
                    .then((response) => {
                        let selectedCategories = response.data;
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
                this.dialog = false;
                this.selectedCategories = [];
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            },

            save() {
                let form = new FormData();
                let url = '/api/products';

                form.append('name', this.editedItem.name);
                form.append('description', this.editedItem.description);
                form.append('purchase_price', this.editedItem.purchase_price);
                form.append('sale_price', this.editedItem.sale_price);
                form.append('quantity', this.editedItem.quantity);
                form.append('status', this.editedItem.status);
                form.append('quantity_type', this.editedItem.quantity_type);

                if (this.selectedCategories) {
                    form.append('categories', JSON.stringify(this.selectedCategories));
                    console.log(this.selectedCategories);
                }

                if (this.editedIndex > -1) {
                    // update product
                    form.append('_method', 'PATCH')
                    url = url +'/'+ this.editedItem.id
                    axios.post(url, form)
                        .then((response) => {
                            Object.assign(this.items[this.editedIndex], this.editedItem);
                            this.snackbar_message = 'Product '+this.editedItem.name + ' successfully updated.';
                            this.snackbar = true;
                        })
                } else {
                    // create product
                    axios.post(url, form)
                        .then((response) => {
                            this.items.push(response.data);
                            this.snackbar_message = 'Product '+this.editedItem.name + ' successfully created.';
                            this.snackbar = true;
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
            }
        }
    }
</script>

<style>
    .products table.table thead th:first-child{
        padding:0 15px;
    }
    
</style>