<template>
    <section class="setting-page">
        <v-container grid-list-xl>
            <v-card>
                <v-card-title>
                    <h2>Company Information</h2>
                    <v-spacer></v-spacer>

                </v-card-title>

                <v-card-text>
                    <v-layout row wrap>
                        <v-flex xs6>
                            <v-text-field
                                    label="Company Name"
                                    v-model="company_name"
                                    hint="Name of company">

                            </v-text-field>
                        </v-flex>

                        <v-flex xs6>
                            <v-text-field
                                label="Company Shop number"
                                hint="Enter you shop number"
                                v-model="company_shop_number"></v-text-field>
                        </v-flex>

                        <v-flex xs12>
                            <v-text-field
                                    label="Address"
                                    multi-line
                                    v-model="company_address"
                                    hint="Address of company">
                            </v-text-field>
                        </v-flex>

                        <v-flex xs6>
                            <v-text-field
                                    label="Phone"
                                    v-model="company_phone"
                                    hint="Company phone number">
                            </v-text-field>
                        </v-flex>

                        <v-flex xs6>
                            <v-text-field
                                    label="Mobile"
                                    v-model="company_mobile"
                                    hint="Company mobile number">
                            </v-text-field>
                        </v-flex>

                        <v-flex xs6>
                            <v-text-field
                                label="Email"
                                hint="Company email"
                                v-model="company_email"></v-text-field>
                        </v-flex>

                        <v-flex xs6>
                            <v-text-field
                                    label="Fax"
                                    v-model="company_fax"
                                    hint="Company fax"></v-text-field>
                        </v-flex>


                    </v-layout>
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                            dark
                            raised
                            color="dark"
                            @click="onUpdateSetting()">Update company info
                    </v-btn>
                </v-card-actions>
            </v-card>
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
    </section>
</template>

<script>
    import axios from 'axios'

    export default {
        data: () => ({

            snackbar: false,
            snackbar_message: '',

            company_name: '',
            company_address: '',
            company_email: '',
            company_phone: '',
            company_mobile: '',
            company_fax: '',
            company_shop_number:''

        }),

        computed: {},

        watch: {},

        created() {
            this.initialize()
        },

        methods: {
            initialize() {
                axios.get('/settings')
                    .then((response) => {

                        this.company_name = response.data.company_name;
                        this.company_address = response.data.company_address;
                        this.company_email = response.data.company_email;
                        this.company_phone = response.data.company_phone;
                        this.company_mobile = response.data.company_mobile;
                        this.company_fax = response.data.company_fax;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            onUpdateSetting() {
                let form = new FormData();
                let url = 'api/categories';

                form.append('name', this.e);
                form.append('description', this.editedItem.description);


                axios.post(url, form)
                    .then((response) => {
                        this.items.push(response.data);
                        this.snackbar_message = "Category " + this.editedItem.name + " successfully created.";
                        this.snackbar = true;
                    });
            }
        }
    }
</script>