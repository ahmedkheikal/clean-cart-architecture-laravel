<template>
    <v-container>
        <h2 class="text-h4 mb-6">My Orders</h2>
        
        <v-tabs v-model="activeTab" class="mb-6">
            <v-tab value="active">Active Orders</v-tab>
            <v-tab value="completed">Completed Orders</v-tab>
        </v-tabs>
        
        <v-window v-model="activeTab">
            <v-window-item value="active">
                <v-row>
                    <v-col v-for="order in activeOrders" :key="order.id" cols="12">
                        <v-card>
                            <v-card-title class="d-flex justify-space-between">
                                <span>Order #{{ order.id }}</span>
                                <span class="text-subtitle-1">{{ order.date }}</span>
                            </v-card-title>
                            
                            <v-card-text>
                                <v-list>
                                    <v-list-item v-for="item in order.items" :key="item.id">
                                        <v-list-item-title>{{ item.name }}</v-list-item-title>
                                        <v-list-item-subtitle>
                                            Quantity: {{ item.quantity }} | ${{ item.price }}
                                        </v-list-item-subtitle>
                                    </v-list-item>
                                </v-list>
                                
                                <v-divider class="my-4"></v-divider>
                                
                                <div class="d-flex justify-space-between">
                                    <span class="text-h6">Total:</span>
                                    <span class="text-h6">${{ order.total }}</span>
                                </div>
                                
                                <div class="mt-4">
                                    <v-chip :color="getStatusColor(order.status)">
                                        {{ order.status }}
                                    </v-chip>
                                </div>
                            </v-card-text>
                            
                            <v-card-actions>
                                <v-btn variant="text" @click="trackOrder(order.id)">
                                    Track Order
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-window-item>
            
            <v-window-item value="completed">
                <v-row>
                    <v-col v-for="order in completedOrders" :key="order.id" cols="12">
                        <v-card>
                            <!-- Similar structure to active orders -->
                        </v-card>
                    </v-col>
                </v-row>
            </v-window-item>
        </v-window>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            activeTab: 'active',
            // Sample data - replace with actual API calls
            activeOrders: [
                {
                    id: '1001',
                    date: '2024-03-23',
                    status: 'Processing',
                    total: 299.99,
                    items: [
                        { id: 1, name: 'Product 1', quantity: 2, price: 149.99 }
                    ]
                }
            ],
            completedOrders: []
        }
    },
    methods: {
        getStatusColor(status) {
            const colors = {
                'Processing': 'warning',
                'Shipped': 'info',
                'Delivered': 'success',
                'Cancelled': 'error'
            };
            return colors[status] || 'grey';
        },
        trackOrder(orderId) {
            // TODO: Implement order tracking
            console.log('Tracking order:', orderId);
        }
    }
}
</script> 