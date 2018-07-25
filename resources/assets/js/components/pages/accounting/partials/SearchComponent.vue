<template>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card>
                <v-card-text>
                    <v-layout row wrap>
                        <v-flex xs6>
                            <v-select
                                    v-model="select"
                                    :hint="`${select.state}, ${select.abbr}`"
                                    :items="items"
                                    item-text="state"
                                    item-value="abbr"
                                    label="Choose a field"
                                    persistent-hint
                                    return-object
                                    single-line
                            ></v-select>
                        </v-flex>

                        <v-flex xs6>

                        </v-flex>
                    </v-layout>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
    export default {
        data(){
            return {
                select: { state: 'Today transaction', abbr: 'TDT' },
                items: [
                    { state: 'Today transaction', abbr: 'TDT' },
                    { state: 'This week', abbr: 'TWT' },
                    { state: 'Last week', abbr: 'LWT' },
                    { state: 'This month', abbr: 'TMT' },
                    { state: 'Last month', abbr: 'LMT' }
                ]
            }
        },

        created(){

        },

        methods:{

        }
    }
</script>