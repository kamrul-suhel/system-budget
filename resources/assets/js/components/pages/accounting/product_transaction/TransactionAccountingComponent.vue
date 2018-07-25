<template>
    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <h2>Transaction accounting</h2>
                <v-divider class="mb-3 dark"></v-divider>
            </v-flex>
        </v-layout>

        <search-component></search-component>

        <over-view-component></over-view-component>

        <chart-component></chart-component>

    </v-container>
</template>

<script>
    import SearchComponent from '../partials/SearchComponent'
    import OverViewComponent from '../partials/OverviewComponent'
    import ChartComponent from '../../../Partials/ChartComponent'
    export default {

        data: () => ({
        }),
        components: {
            chartComponent: ChartComponent,
            SearchComponent,
            OverViewComponent
        },

        computed: {

        },

        watch: {

        },

        created () {
            console.log('expense');
        },

        methods: {
        }
    }
</script>