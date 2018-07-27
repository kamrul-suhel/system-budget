<template>
    <v-layout row wrap>
        <v-flex xs6>
        <v-card flat class="cyan lighten-1 white--text">
                <v-card-title>Payment due today</v-card-title>
                <v-card-text class="pt-0">
                    <h2 class="display-2 white--text text-xs-center">
                        <span style="font-size:12px">TK.</span>
                        <strong>{{paymentDue}}</strong>
                    </h2>
                </v-card-text>
            </v-card>
        </v-flex>

        <v-flex xs6>
            <v-card flat class="light-blue white--text">
                <v-card-title>Paied today</v-card-title>
                <v-card-text class="pt-0">
                    <h2 class="display-2 white--text text-xs-center">
                        <span style="font-size:12px">TK.</span>
                        <strong>{{paid}}</strong>
                    </h2>
                </v-card-text>
            </v-card>
        </v-flex>

        <v-flex xs6>
            <v-card flat class="light-green lighten-1 white--text">
                <v-card-title>Discount today</v-card-title>
                <v-card-text class="pt-0">
                    <h2 class="display-2 white--text text-xs-center">
                        <span style="font-size:12px">TK.</span>
                        <strong>{{discount}}</strong>
                    </h2>
                </v-card-text>
            </v-card>
        </v-flex>

        <v-flex xs6>
            <v-card flat class="orange darken-1 white--text">
                <v-card-title>Total today</v-card-title>
                <v-card-text class="pt-0">
                    <h2 class="display-2 white--text text-xs-center">
                        <span style="font-size:12px">TK.</span>
                        <strong>{{total}}</strong>
                    </h2>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        data(){
            return {
            }
        },

        computed: {
            ...mapGetters({
                paymentDue: 'getTPaymentDue',
                paid : 'getTPaid',
                discount : 'getTDiscount',
                total : 'getTTotal',
            }),
        },

        created(){

        },

        methods:{

        }
    }
</script>
