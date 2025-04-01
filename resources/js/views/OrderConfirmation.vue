<template>
  <div class="order-confirmation max-w-4xl mx-auto p-6">
    <div class="text-center mb-8 flex flex-col items-center justify-center">
      <div class="flex items-center justify-center w-16 h-16 rounded-full bg-green-100 mb-4 mx-auto">
        <img src="https://openclipart.org/image/2400px/svg_to_png/19803/andrea-S-checkmark-on-circle-1.png" 
             class="h-full w-full object-contain" style="max-height: 60vh; max-width: 80vw;"
             alt="Checkmark">
      </div>

    </div>
    
    <div class="text-center">
      <h1 class="text-3xl font-bold text-gray-900 mb-2">Thank You for Your Order!</h1>
      <p class="text-gray-600">Your order has been successfully placed.</p>
    </div>

    <div v-if="lastOrder" class="bg-white rounded-lg shadow p-6 mb-6">
      <h2 class="text-xl font-semibold mb-4">Order Details</h2>
      <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
          <div>
            <h3 class="text-sm font-medium text-gray-500">Order Number</h3>
            <p class="mt-1">{{ lastOrder.id }}</p>
          </div>
          <div>
            <h3 class="text-sm font-medium text-gray-500">Order Date</h3>
            <p class="mt-1">{{ new Date().toLocaleDateString() }}</p>
          </div>
        </div>

        <div class="border-t pt-4">
          <h3 class="text-sm font-medium text-gray-500 mb-2">Shipping Address</h3>
          <p class="text-gray-700">
            {{ lastOrder.shipping.firstName }} {{ lastOrder.shipping.lastName }}<br>
            {{ lastOrder.shipping.address }}<br>
            {{ lastOrder.shipping.city }}, {{ lastOrder.shipping.postalCode }}
          </p>
        </div>

        <div class="border-t pt-4">
          <h3 class="text-sm font-medium text-gray-500 mb-2">Order Summary</h3>
          <div class="space-y-2">
            <div class="flex justify-between text-sm">
              <span class="text-gray-500">Subtotal</span>
              <span class="text-gray-900">${{ lastOrder.total.toFixed(2) }}</span>
            </div>
            <div class="flex justify-between text-sm">
              <span class="text-gray-500">Shipping</span>
              <span class="text-gray-900">Free</span>
            </div>
            <div class="flex justify-between font-medium pt-2 border-t">
              <span>Total</span>
              <span>${{ lastOrder.total.toFixed(2) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center">
      <router-link to="/products">
        <v-btn color="primary" variant="text" block>
          Continue Shopping
        </v-btn>
      </router-link>
    </div>
  </div>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'

export default {
  name: 'OrderConfirmation',
  setup() {
    const store = useStore()
    const lastOrder = computed(() => store.getters.lastOrderDetails)

    return {
      lastOrder
    }
  }
}
</script> 