<template>
    <section class="setting-page">

        <v-card>
            <v-card-title>
                Setting
                <v-spacer></v-spacer>
               
            </v-card-title>

            <v-card-text>
                
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
           
            snackbar: false,
            snackbar_message:'',
            
            items: [],
         
        }),

        computed: {
           
        },

        watch: {
            
        },

        created () {
            this.initialize()
        },

        methods: {
            initialize () {
                axios.get('/settings')
                .then((response) => {
                    this.items = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            editItem (item) {
                this.editedIndex = this.items.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
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
            
            }
        }
    }
</script>