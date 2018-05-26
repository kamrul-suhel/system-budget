<template>
    <v-toolbar
            dark
            fixed
            clipped-left
            app
    >
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-icon class="mx-3">fab fa-youtube</v-icon>
        <v-toolbar-title class="mr-5 align-center">
            <span class="title">NS Software</span>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-layout row align-center style="max-width: 650px">
            <v-text-field
                    placeholder="Search..."
                    single-line
                    append-icon="search"
                    :append-icon-cb="() => {}"
                    color="white"
                    hide-details
            ></v-text-field>
        </v-layout>
    </v-toolbar>
</template>

<script>
    export default {
        data() {
            return {

            }
        },

        created() {
        },

        methods: {

        }
    }
</script>