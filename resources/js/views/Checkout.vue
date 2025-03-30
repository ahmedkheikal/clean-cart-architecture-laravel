<template>
  <v-container class="py-8">
    <div class="checkout-container max-w-4xl mx-auto space-y-10">
      <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>
      
      <!-- Order Summary -->
      <div class="bg-white p-8 rounded-lg shadow-md border border-gray-100">
        <h2 class="text-xl font-semibold mb-8 text-gray-800">Order Summary</h2>
        <div v-if="cart.items.length" class="space-y-6">
          <table class="w-full" style="width: 100%;">
            <thead class="border-b border-gray-200">
              <tr>
                <th class="text-left py-3 text-gray-600">Item</th>
                <th class="text-center py-3 text-gray-600">Quantity</th>
                <th class="text-right py-3 text-gray-600">Price</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in cart.items" :key="item.id" class="border-b border-gray-100">
                <td class="py-4 text-gray-700">{{ item.name }}</td>
                <td class="py-4 text-center text-gray-600">{{ item.quantity }}</td>
                <td class="py-4 text-right font-medium">${{ (item.price * item.quantity).toFixed(2) }}</td>
              </tr>
            </tbody>
            <tfoot class="border-t border-gray-200">
              <tr>
                <td colspan="2" class="py-3 text-right text-gray-600">Subtotal:</td>
                <td class="py-3 text-right text-gray-600">${{ cartTotal.toFixed(2) }}</td>
              </tr>
              <tr>
                <td colspan="2" class="py-3 text-right text-gray-600">Tax (10%):</td>
                <td class="py-3 text-right text-gray-600">${{ tax.toFixed(2) }}</td>
              </tr>
              <tr class="border-t border-gray-200">
                <td colspan="2" class="py-4 text-right font-semibold text-xl">Total:</td>
                <td class="py-4 text-right font-semibold text-xl text-indigo-600">${{ total.toFixed(2) }}</td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div v-else class="text-gray-500 text-center py-8">
          Your cart is empty
        </div>
      </div>

      <!-- Checkout Form -->
      <form @submit.prevent="handleCheckout" class="space-y-10">
        <!-- Shipping Information -->
        <div class="bg-white p-8 rounded-lg shadow-md border border-gray-100">
          <h2 class="text-xl font-semibold mb-8 text-gray-800">Shipping Information</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-3">
              <label class="block text-sm font-medium text-gray-700">First Name</label>
              <input 
                v-model="shippingInfo.firstName"
                type="text"
                required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150 ease-in-out"
              >
            </div>
            <div class="space-y-3">
              <label class="block text-sm font-medium text-gray-700">Last Name</label>
              <input 
                v-model="shippingInfo.lastName"
                type="text"
                required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150 ease-in-out"
              >
            </div>
            <div class="col-span-2 space-y-3">
              <label class="block text-sm font-medium text-gray-700">Address</label>
              <input 
                v-model="shippingInfo.address"
                type="text"
                required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150 ease-in-out"
              >
            </div>
            <div class="space-y-3">
              <label class="block text-sm font-medium text-gray-700">City</label>
              <input 
                v-model="shippingInfo.city"
                type="text"
                required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150 ease-in-out"
              >
            </div>
            <div class="space-y-3">
              <label class="block text-sm font-medium text-gray-700">Postal Code</label>
              <input 
                v-model="shippingInfo.postalCode"
                type="text"
                required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-150 ease-in-out"
              >
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between items-center pt-4">
          <v-btn
            type="submit"
            :disabled="processing || !cart.items.length"
            color="primary"
            size="large"
            block
            class="mb-4"
          >
            <span v-if="processing">
              <v-progress-circular indeterminate size="20" width="2" color="white" class="mr-2"></v-progress-circular>
              Processing...
            </span>
            <span v-else>
              Place Order (${{ total.toFixed(2) }})
            </span>
          </v-btn>
          <v-btn
            type="button"
            @click="$router.push('/products')"
            color="black"
            variant="text"
            block
          >
            Continue Shopping
          </v-btn>
        </div>
      </form>
    </div>
  </v-container>
</template>

<script>
import { ref, computed } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

export default {
  name: 'Checkout',
  setup() {
    const store = useStore()
    const router = useRouter()
    const processing = ref(false)

    const cart = computed(() => store.state.cart)
    const cartTotal = computed(() => {
      return cart.value.items.reduce((total, item) => {
        return total + (item.price * item.quantity)
      }, 0)
    })

    const tax = computed(() => cartTotal.value * 0.1)
    const total = computed(() => cartTotal.value + tax.value)

    const shippingInfo = ref({
      firstName: store.state.auth.user?.name.split(' ')[0]  || '',
      lastName: store.state.auth.user?.name.split(' ')[1]  || '',
      address: store.state.auth.user?.address || '',
      city: store.state.auth.user?.city || '',
      postalCode: store.state.auth.user?.postal_code || ''
    })

    const paymentInfo = ref({
      cardNumber: '',
      expiryDate: '',
      cvv: ''
    })

    const handleCheckout = async () => {
      processing.value = true
      try {
        // Here you would typically make an API call to process the payment
        await store.dispatch('processCheckout', {
          shippingInfo: shippingInfo.value,
          paymentInfo: paymentInfo.value,
          subtotal: cartTotal.value,
          tax: tax.value,
          total: total.value
        })
        
        // Clear the cart after successful checkout
        await store.dispatch('clearCart')
        
        // Redirect to order confirmation
        router.push('/order-confirmation')
      } catch (error) {
        console.error('Checkout failed:', error)
        // Handle error (show error message to user)
      } finally {
        processing.value = false
      }
    }

    return {
      cart,
      cartTotal,
      tax,
      total,
      shippingInfo,
      paymentInfo,
      processing,
      handleCheckout
    }
  }
}
</script> 