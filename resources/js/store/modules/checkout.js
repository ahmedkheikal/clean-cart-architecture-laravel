// Checkout store module
export default {
  state: {
    checkoutStatus: null,
    error: null,
    processingOrder: false,
    lastOrder: null
  },

  mutations: {
    SET_CHECKOUT_STATUS(state, status) {
      state.checkoutStatus = status
    },
    SET_ERROR(state, error) {
      state.error = error
    },
    SET_PROCESSING(state, status) {
      state.processingOrder = status
    },
    SET_LAST_ORDER(state, order) {
      state.lastOrder = order
    }
  },

  actions: {
    async processCheckout({ commit, dispatch }, { shippingInfo, paymentInfo, orderTotal }) {
      commit('SET_PROCESSING', true)
      commit('SET_ERROR', null)
      
      try {
        // Here you would integrate with your payment processing service
        // This is a placeholder for the actual API call
        const response = await fetch('/api/checkout', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            shipping: shippingInfo,
            payment: paymentInfo,
            total: orderTotal
          })
        })

        if (!response.ok) {
          throw new Error('Checkout failed')
        }

        const order = await response.json()
        
        commit('SET_LAST_ORDER', order)
        commit('SET_CHECKOUT_STATUS', 'success')
        
        // Clear the cart after successful checkout
        await dispatch('clearCart', null, { root: true })
        
        return order
      } catch (error) {
        commit('SET_ERROR', error.message)
        commit('SET_CHECKOUT_STATUS', 'failed')
        throw error
      } finally {
        commit('SET_PROCESSING', false)
      }
    },

    resetCheckout({ commit }) {
      commit('SET_CHECKOUT_STATUS', null)
      commit('SET_ERROR', null)
      commit('SET_PROCESSING', false)
      commit('SET_LAST_ORDER', null)
    }
  },

  getters: {
    isProcessing: state => state.processingOrder,
    checkoutError: state => state.error,
    lastOrderDetails: state => state.lastOrder,
    isCheckoutComplete: state => state.checkoutStatus === 'success'
  }
} 