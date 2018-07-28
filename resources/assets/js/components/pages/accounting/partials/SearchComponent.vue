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
                                    @input="onSelected()"
                                    return-object
                                    single-line
                            ></v-select>
                        </v-flex>

                        <v-flex xs6 v-if="customDate">
                            <v-layout row wrap>
                                <v-flex xs6>
                                    <v-menu
                                            ref="startDate"
                                            :close-on-content-click="false"
                                            v-model="startDateDialog"
                                            :nudge-right="40"
                                            lazy
                                            transition="scale-transition"
                                            offset-y
                                            full-width
                                            max-width="290px"
                                            min-width="290px"
                                    >
                                        <v-text-field
                                                slot="activator"
                                                label="Start Date"
                                                v-model="dateFormatted"
                                                persistent-hint
                                                prepend-icon="event"
                                                @blur="date = parseDate(dateFormatted)"
                                        ></v-text-field>
                                        <v-date-picker v-model="date" no-title @input="startDateDialog = false"></v-date-picker>
                                    </v-menu>
                                </v-flex>

                                <v-flex xs6>
                                    <v-menu
                                            :close-on-content-click="false"
                                            v-model="endDateDialog"
                                            :nudge-right="40"
                                            lazy
                                            transition="scale-transition"
                                            offset-y
                                            full-width
                                            max-width="290px"
                                            min-width="290px"
                                    >
                                        <v-text-field
                                                slot="activator"
                                                v-model="computedDateFormatted"
                                                label="End date"
                                                persistent-hint
                                                prepend-icon="event"
                                                readonly
                                        ></v-text-field>
                                        <v-date-picker v-model="date" no-title @input="endDateDialog = false"></v-date-picker>
                                    </v-menu>
                                </v-flex>
                            </v-layout>

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
                customDate : false,
                date: null,
                dateFormatted: null,
                startDateDialog: false,
                endDateDialog: false,


                items: [
                    { state: 'Today', abbr: 'TDT' },
                    { state: 'Yesterday', abbr: 'YDT' },
                    { state: 'This Week', abbr: 'TWT' },
                    { state: 'Last Week', abbr: 'LWT' },
                    { state: 'This Month', abbr: 'TMT' },
                    { state: 'Last Month', abbr: 'LMT' },
                    { state: 'This Year', abbr: 'TYT' },
                    { state: 'Last Year', abbr: 'LYT' },
                    { state: 'Custom Date', abbr: 'CDT' },
                    { state: 'Custom Rrange Date', abbr: 'CRT' },
                ]
            }
        },

        created(){

        },

        computed: {
            computedDateFormatted () {
                return this.formatDate(this.date)
            }
        },

        watch: {
            date (val) {
                this.dateFormatted = this.formatDate(this.date)
            }
        },

        methods: {
            formatDate (date) {
                if (!date) return null

                const [year, month, day] = date.split('-')
                return `${month}/${day}/${year}`
            },
            parseDate (date) {
                if (!date) return null

                const [month, day, year] = date.split('/')
                return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
            },

            onSelected(){
                if(this.select.abbr === 'CDT'){
                    this.customDate = true;
                    return false;
                }

                console.log(this.select);
            }
        }
    }
</script>