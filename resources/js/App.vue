<template>
    <v-app>
        <v-app-bar app color="primary" dark>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>E-Commerce</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon to="/cart">
                <v-badge :content="cartItemCount" color="error" v-if="cartItemCount">
                    <v-icon>mdi-cart</v-icon>
                </v-badge>
                <v-icon v-else>mdi-cart</v-icon>
            </v-btn>
        </v-app-bar>

        <v-navigation-drawer v-model="drawer" app>
            <v-list>
                <v-list-item to="/" link>
                    <v-list-item-icon>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Home</v-list-item-title>
                </v-list-item>

                <v-list-item to="/products" link>
                    <v-list-item-icon>
                        <v-icon>mdi-store</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Products</v-list-item-title>
                </v-list-item>

                <v-list-item to="/orders" link>
                    <v-list-item-icon>
                        <v-icon>mdi-package</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Orders</v-list-item-title>
                </v-list-item>

                <v-list-item to="/account" link>
                    <v-list-item-icon>
                        <v-icon>mdi-account-settings</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Account Settings</v-list-item-title>
                </v-list-item>

                <v-list-item to="/login" link v-if="!isAuthenticated">
                    <v-list-item-icon>
                        <v-icon>mdi-login</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Login</v-list-item-title>
                </v-list-item>

                <v-list-item to="/signup" link v-if="!isAuthenticated">
                    <v-list-item-icon>
                        <v-icon>mdi-account-plus</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Sign Up</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script>
export default {
    data() {
        return {
            drawer: false,
        }
    },
    computed: {
        isAuthenticated() {
            return this.$store.state.auth.isAuthenticated
        },
        cartItemCount() {
            return this.$store.state.cart.items.length
        }
    }
}
</script> 