export default {
  namespaced: true,
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
      
      console.log('shippingInfo', shippingInfo);
      
      try {
        const token = localStorage.getItem('token')
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        const response = await fetch('/api/carts/current/checkout', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Authorization': `Bearer ${token}`
          },
          body: JSON.stringify({
            shipping_info: shippingInfo,
            payment_method: 'cash'
          })
        })

        if (!response.ok) {
          throw new Error('Checkout failed')
        }

        const order = await response.json()
        
        commit('SET_LAST_ORDER', order)
        commit('SET_CHECKOUT_STATUS', 'success')
        
        await dispatch('cart/clearCart', null, { root: true })
        
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