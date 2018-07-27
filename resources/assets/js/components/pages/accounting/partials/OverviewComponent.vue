<template>
    <v-layout row wrap>
        <v-flex xs3>
            <v-card flat class="cyan lighten-1 white--text">
                <v-card-title>Payment due today</v-card-title>
                <v-card-text class="pt-0">
                    <h2 class="display-2 white--text text-xs-center"><span style="font-size:12px">TK.</span><strong>350</strong></h2>
                </v-card-text>
            </v-card>
        </v-flex>

        <v-flex xs3>
            <v-card flat class="light-blue white--text">
                <v-card-title>Paied today</v-card-title>
                <v-card-text class="pt-0">
                    <h2 class="display-2 white--text text-xs-center"><span style="font-size:12px">TK.</span><strong>350</strong></h2>
                </v-card-text>
            </v-card>
        </v-flex>

        <v-flex xs3>
            <v-card flat class="light-green lighten-1 white--text">
                <v-card-title>Discount today</v-card-title>
                <v-card-text class="pt-0">
                    <h2 class="display-2 white--text text-xs-center"><span style="font-size:12px">TK.</span><strong>350</strong></h2>
                </v-card-text>
            </v-card>
        </v-flex>

        <v-flex xs3>
            <v-card flat class="orange darken-1 white--text">
                <v-card-title>Total today</v-card-title>
                <v-card-text class="pt-0">
                    <h2 class="display-2 white--text text-xs-center"><span style="font-size:12px">TK.</span><strong>350</strong></h2>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        data(){
            return {
                select: { state: 'Florida', abbr: 'FL' },
                items: [
                    { state: 'Florida', abbr: 'FL' },
                    { state: 'Georgia', abbr: 'GA' },
                    { state: 'Nebraska', abbr: 'NE' },
                    { state: 'California', abbr: 'CA' },
                    { state: 'New York', abbr: 'NY' }
                ]
            }
        },

        created(){

        },

        methods:{

        }
    }
</script>