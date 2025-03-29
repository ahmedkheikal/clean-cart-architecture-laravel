export default {
    namespaced: true,
    state: {
        items: JSON.parse(localStorage.getItem('cart')) || [],
    },
    mutations: {
        async ADD_ITEM(state, item) {
            const token = localStorage.getItem('token');
            // request {product_id: item.id, quantity: item.quantity}
            const response = await fetch('/api/carts/current/items', {
                method: 'POST',
                body: JSON.stringify({product_id: item.id, quantity: 1}),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    ...(token ? { 'Authorization': `Bearer ${token}` } : {})
                }
            });
            const data = await response.json();
            if (response.status >= 300) {  
                throw new Error(data.message);
            }
            
            const existingItem = state.items.find(i => i.id === item.id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                state.items.push({ ...item, quantity: 1 });
            }
            localStorage.setItem('cart', JSON.stringify(state.items));
        },
        async REMOVE_ITEM(state, itemId) {
            const token = localStorage.getItem('token'); 
            const response = await fetch(`/api/carts/current/items/${itemId}`, {
                method: 'DELETE',
                body: JSON.stringify({product_id: itemId, quantity: 1}),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    ...(token ? { 'Authorization': `Bearer ${token}` } : {})
                }
            });
            const data = await response.json();
            if (response.status >= 300) {  
                throw new Error(data.message);
            }
            state.items = state.items.filter(item => item.id !== itemId);
            localStorage.setItem('cart', JSON.stringify(state.items));
        },
        UPDATE_QUANTITY(state, { itemId, quantity }) {
            const item = state.items.find(i => i.id === itemId);
            if (item) {
                item.quantity = quantity;
                localStorage.setItem('cart', JSON.stringify(state.items));
            }
        },
        CLEAR_CART(state) {
            state.items = [];
            localStorage.removeItem('cart');
        }
    },
    actions: {
        addItem({ commit }, item) {
            commit('ADD_ITEM', item);
        },
        removeItem({ commit }, itemId) {
            commit('REMOVE_ITEM', itemId);
        },
        updateQuantity({ commit }, payload) {
            commit('UPDATE_QUANTITY', payload);
        },
        clearCart({ commit }) {
            commit('CLEAR_CART');
        }
    },
    getters: {
        cartItems: state => state.items,
        cartTotal: state => state.items.reduce((total, item) => total + (item.price * item.quantity), 0),
        itemCount: state => state.items.reduce((count, item) => count + item.quantity, 0)
    }
}; 