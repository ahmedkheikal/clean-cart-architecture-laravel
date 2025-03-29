<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <h2 class="text-3xl font-bold mb-6">Our Products</h2>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="3" class="mb-4">
                <v-card>
                    <v-card-title>Filters</v-card-title>
                    <v-card-text>
                        <v-select
                            v-model="selectedCategory"
                            :items="categories"
                            label="Category"
                        ></v-select>
                        <v-range-slider
                            v-model="priceRange"
                            :max="1000"
                            :min="0"
                            label="Price Range"
                        ></v-range-slider>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="9">
                <v-row>
                    <v-col v-for="product in products" :key="product.id" cols="12" sm="6" md="4">
                        <v-card>
                            <v-img
                                :src="product.image"
                                height="200"
                                cover
                            ></v-img>
                            <v-card-title>{{ product.name }}</v-card-title>
                            <v-card-text>
                                <div class="text-h6 mb-2">${{ product.price }}</div>
                                <p>{{ product.description }}</p>
                            </v-card-text>
                            <v-card-actions>
                                <v-btn
                                    color="primary"
                                    @click="addToCart(product)"
                                >
                                    Add to Cart
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            selectedCategory: null,
            categories: ['Electronics', 'Clothing', 'Books', 'Home & Garden'],
            priceRange: [0, 1000],
            products: [
                {
                    id: 1,
                    name: 'Sample Product 1',
                    price: 99.99,
                    description: 'This is a sample product description',
                    image: 'https://via.placeholder.com/300'
                },
                // Add more sample products...
            ]
        }
    },
    async mounted() {
        await this.fetchProducts();
    },
    methods: {
        async fetchProducts() {
            const response = await fetch('/api/products');
            
            const data = await response.json();
            this.products = data.data;
            
        },
        addToCart(product) {
            this.$store.dispatch('cart/addItem', product);
        }
    }
}
</script> 