<template>
    <v-container>
        <h2 class="text-h4 mb-6">Shopping Cart</h2>
        
        <v-row v-if="cartItems.length">
            <v-col cols="12" md="8">
                <v-card>
                    <v-list>
                        <v-list-item v-for="item in cartItems" :key="item.id">
                            <template v-slot:prepend>
                                <v-img :src="item.image" width="100" height="100" cover></v-img>
                            </template>
                            
                            <v-list-item-title>{{ item.name }}</v-list-item-title>
                            <v-list-item-subtitle>${{ item.price }}</v-list-item-subtitle>
                            
                            <template v-slot:append>
                                <v-text-field
                                    v-model="item.quantity"
                                    type="number"
                                    min="1"
                                    density="compact"
                                    style="width: 80px"
                                    @change="updateQuantity(item.id, $event)"
                                ></v-text-field>
                                <v-btn icon="mdi-delete" variant="text" color="error" 
                                    @click="removeItem(item.id)"></v-btn>
                            </template>
                        </v-list-item>
                    </v-list>
                </v-card>
            </v-col>
            
            <v-col cols="12" md="4">
                <v-card>
                    <v-card-title>Order Summary</v-card-title>
                    <v-card-text>
                        <div class="d-flex justify-space-between mb-2">
                            <span>Subtotal:</span>
                            <span>${{ cartTotal }}</span>
                        </div>
                        <div class="d-flex justify-space-between mb-4">
                            <span>Tax (10%):</span>
                            <span>${{ cartTotal * 0.1 }}</span>
                        </div>
                        <v-divider></v-divider>
                        <div class="d-flex justify-space-between my-4">
                            <span class="text-h6">Total:</span>
                            <span class="text-h6">${{ cartTotal * 1.1 }}</span>
                        </div>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn block color="primary" @click="checkout">
                            Proceed to Checkout
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
        
        <v-row v-else>
            <v-col cols="12" class="text-center">
                <v-icon size="64" color="grey">mdi-cart-off</v-icon>
                <h3 class="text-h5 mt-4">Your cart is empty</h3>
                <v-btn color="primary" class="mt-4" to="/products">
                    Continue Shopping
                </v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    mounted() {
        this.$store.dispatch('cart/fetchCart');
    },
    computed: {
        cartItems() {
            return this.$store.getters['cart/cartItems'];
        },
        cartTotal() {
            return this.$store.getters['cart/cartTotal'];
        }
    },
    methods: {
        updateQuantity(itemId, event) {
            const quantity = parseInt(event.target.value);
            if (quantity > 0) {
                this.$store.dispatch('cart/updateQuantity', { itemId, quantity });
            }
        },
        async removeItem(itemId) {
            await this.$store.dispatch('cart/removeItem', itemId);
            await this.$store.dispatch('cart/fetchCart');
        },
        checkout() {
            this.$router.push('/checkout');
            this.$store.dispatch('checkout/processCheckout');
        }
    }
}
</script> 