<template>
    <div id="app">
        <v-app
                light
                id="inspire"
        >
            <navigation-component v-if="login"></navigation-component>
            <header-component v-if="login"></header-component>

            <v-content>
                <v-container fill-height class="pt-0" v-if="login">
                    <v-layout justify-left>
                        <v-flex>
                            <router-view ></router-view>
                        </v-flex>
                    </v-layout>
                </v-container>

                <v-container fill-height justify-center align-content-center v-else>
                    <router-view></router-view>
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
            login:false
        }),
        props: {
            source: String
        },
    }
</script>