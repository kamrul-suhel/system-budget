<template>
    <section class="expense-page">

        <v-dialog v-model="dialog" max-width="500px">
            <v-btn
                    dark
                    :color="theme"
                    slot="activator"
                    raised
                    class="mb-2 ml-0">Add Expense</v-btn>

            <v-card>
                <v-card-title>
                    <span class="headline">{{ formTitle }}</span>
                </v-card-title>

                <v-card-text>
                    <v-container grid-list-md>
                        <v-layout wrap>
                            <v-flex xs12>
                                <v-text-field
                                        label="Title"
                                        v-model="editedItem.title"
                                        :color="theme"
                                ></v-text-field>
                            </v-flex>

                            <v-flex xs12>
                                <v-text-field
                                        :color="theme"
                                    label="Description" 
                                    v-model="editedItem.description"
                                    multi-line
                                    ></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn :color="theme"
                           dark
                           raised
                           @click.native="close">Cancel</v-btn>

                    <v-btn :color="theme" dark raised @click.native="save">{{ buttonTitle }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-card>
            <v-card-title>
                <h2>Expense</h2>
                <v-spacer></v-spacer>
                <v-text-field
                        :color="theme"
                    hide-details
                    v-model="search"
                    append-icon="search"></v-text-field>
            </v-card-title>

            <v-card-text>
                <v-data-table
                    :headers="headers"
                    :items="items"
                    :search="search"
                    :rows-per-page-items=row_per_page
                    >

                    <template slot="items" slot-scope="props">
                        <td>{{ props.index + 1 }}</td>
                        <td class="text-xs-left">{{ props.item.title }}</td>
                        <td class="text-xs-left">{{ props.item.description }}</td>
                        <td class="text-xs-left">TK.{{ props.item.amount }}</td>
                        <td class="text-xs-left">{{ props.item.payment_type }}</td>
                        <td class="text-xs-left">{{ getCategory(props.item)}}</td>
                        <td class="justify-start layout px-0">
                            <v-btn
                                    :color="theme"
                                    icon
                                    class="mx-0"
                                    @click="editItem(props.item)">
                                <v-icon :color="theme">edit</v-icon>
                            </v-btn>
                            <v-btn
                                    :color="theme"
                                    icon
                                    class="mx-0"
                                    @click="deleteItem(props.item)">
                                <v-icon :color="theme">delete</v-icon>
                            </v-btn>
                        </td>
                    </template>

                    <v-alert slot="no-results" :value="true" color="error" icon="warning">
                        Your search for "{{ search }}" found no results.
                    </v-alert>    

                    <template slot="no-data">
                        <v-btn
                                :color="theme"
                                @click="initialize">Reset</v-btn>
                    </template>
                </v-data-table>
            </v-card-text>
        </v-card>

        <v-snackbar
                :timeout="4000"
        top
        right
        color="success"
        multi-line
        v-model="snackbar">
            {{ snackbar_message }}
        </v-snackbar>
    </section>
</template>

<script>
    import axios from 'axios'
    export default {
        data: () => ({
            dialog: false,
            search:'',
            pagination: {
                sortBy: 'name'
            },
            snackbar: false,
            snackbar_message:'',
            headers: [
                {
                    text: 'Id',
                    align: 'left',
                    sortable: true,
                    value: 'id'
                },
                { 
                    text: 'Title', 
                    value: 'title',
                    sortable: true
                },
                { 
                    text: 'Description', 
                    value: 'description',
                },
                {
                    text: 'Amount',
                    value: 'amount',
                },
                {
                    text: 'Payment Type',
                    value: 'payment_type',
                },

                {
                    text: 'Category',
                    value: 'category',
                },
                {
                    text: 'Action',
                    value: 'action'
                }
            ],
            items: [],
            expenseCategories: [],
            editedIndex: -1,
            editedItem: {
                id:'',
                title: '',
                description: '',
                payment_type:'',
                amount:'',
                expense_categories_id:''
            },
            defaultItem: {
                name: '',
                descriptin: '',
            },
            row_per_page: [20, 30, 50, {'text': 'All', 'value': -1}],
        }),

        computed: {

            theme(){
              return this.$store.getters.getTheme;
            },

            formTitle () {
                return this.editedIndex === -1 ? 'New Category' : 'Edit Category'
            },

            buttonTitle () {
                return this.editedIndex === -1 ? 'Create Category' : 'Update Category'
            }
        },

        watch: {
            dialog (val) {
                val || this.close()
            }
        },

        created () {
            this.initialize()
        },

        methods: {
            initialize () {
                axios.get('api/expense')
                .then((response) => {
                    this.items = response.data.expenses;
                    console.log(this.items[0].category);
                    this.expenseCategories = response.data.expense_categories;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            getCategory(item){
                if(item.category){
                    return item.category.title
                }
                return 'unknown';
            },

            editItem (item) {
                this.editedIndex = this.items.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.items.indexOf(item)
                confirm('Are you sure you want to delete this item?') && this.items.splice(index, 1)
            },

            close () {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1;
                }, 300)
            },

            save () {
                let form = new FormData();
                let url = 'api/categories';

                form.append('name', this.editedItem.name);
                form.append('description', this.editedItem.description);
                    
                if (this.editedIndex > -1) {
                    form.append('_method', 'PUT');
                    url = url +'/'+ this.editedItem.id;
                
                    axios.post(url, form)
                        .then((response) => {
                            Object.assign(this.items[this.editedIndex], this.editedItem);
                            this.snackbar_message = "Category "+this.editedItem.name+" successfully update.";
                            this.snackbar = true;
                        })
                    .catch((error)=> {

                    });
                } else {
                    axios.post(url, form)
                    .then((response) => {
                        this.items.push(response.data);
                        this.snackbar_message = "Category "+this.editedItem.name+" successfully created.";
                        this.snackbar = true;
                    });
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
        }
    }
</script>