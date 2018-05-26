<template>
    <div id="app">
        <v-app
                dark
                id="inspire"
        >
            <h2>Headeri test</h2>
            <navigation-component></navigation-component>
            <header-component></header-component>

            <v-content>
                <v-container fill-height class="pt-0">
                    <v-layout justify-left>
                        <v-flex>
                            <router-view></router-view>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-content>
        </v-app>
    </div>
</template>

<script>
    import  HeaderComponent  from '../components/layout/HeaderComonent.vue';
    import  NavigationComponent  from '../components/layout/NavigationComponent.vue';

    export default {
        name: 'App',
        components: {
            NavigationComponent,
            HeaderComponent
        },

        data: () => ({

        }),
        props: {
            source: String
        },
    }
</script>