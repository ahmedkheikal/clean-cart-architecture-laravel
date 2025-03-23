<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <h1 class="text-h4 mb-6">Welcome to Our Store</h1>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="6">
                <v-card class="mb-4">
                    <v-img
                        src="https://via.placeholder.com/800x400"
                        height="400"
                        cover
                    ></v-img>
                    <v-card-title>Featured Products</v-card-title>
                    <v-card-text>
                        Check out our latest collection of products.
                    </v-card-text>
                    <v-card-actions>
                        <v-btn
                            color="primary"
                            to="/products"
                        >
                            Shop Now
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
            <v-col cols="12" md="6">
                <v-card class="mb-4">
                    <v-card-title>Special Offers</v-card-title>
                    <v-card-text>
                        <div class="text-h6 mb-2">Get 20% off on your first purchase!</div>
                        <p>Use code: WELCOME20</p>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    name: 'Home'
}
</script> 