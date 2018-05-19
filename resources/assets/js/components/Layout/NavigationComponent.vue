<template>
    <v-navigation-drawer
            fixed
            clipped
            v-model="drawer"
            app
    >
        <v-list dense>
            <v-list-tile v-for="item in items" :key="item.link" @click="">
                <v-list-tile-action>
                    <v-icon>{{ item.icon }}</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        <router-link :to="{name: item.link}">{{ item.text }}</router-link>
                    </v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
            
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    export default {
        data() {
            return {
                drawer: true,
                items: [
                    {
                        icon: 'trending_up', 
                        text: 'Dashboard',
                        link: 'home',
                    },
                    {
                        icon: 'subscriptions', 
                        text: 'Categories',
                        link:'categories'
                    },
                    {
                        icon: 'history', 
                        text: 'Products',
                        link:'products'
                    },
                    {
                        icon: 'featured_play_list', 
                        text: 'Transition',
                        link: 'transaction'
                    },
                    {
                        icon: 'watch_later', 
                        text: 'Customers',
                        link: 'customers'
                    }
                ]
            }
        }
    }
</script>