export default {
    namespaced: true,
    state: {
        products: [],
        loading: false,
        error: null,
        categories: ['Electronics', 'Clothing', 'Books', 'Home & Garden'],
        filters: {
            category: null,
            priceRange: [0, 1000],
            search: ''
        }
    },
    mutations: {
        SET_PRODUCTS(state, products) {
            state.products = products;
        },
        SET_LOADING(state, status) {
            state.loading = status;
        },
        SET_ERROR(state, error) {
            state.error = error;
        },
        SET_FILTER(state, { type, value }) {
            state.filters[type] = value;
        }
    },
    actions: {
        async fetchProducts({ commit, state }) {
            try {
                commit('SET_LOADING', true);
                // TODO: Implement actual API call
                const response = await fetch('/api/products?' + new URLSearchParams({
                    category: state.filters.category,
                    minPrice: state.filters.priceRange[0],
                    maxPrice: state.filters.priceRange[1],
                    search: state.filters.search
                }));
                const data = await response.json();
                commit('SET_PRODUCTS', data);
            } catch (error) {
                commit('SET_ERROR', error.message);
                console.error('Error fetching products:', error);
            } finally {
                commit('SET_LOADING', false);
            }
        },
        async fetchProductById({ commit }, productId) {
            try {
                commit('SET_LOADING', true);
                // TODO: Implement actual API call
                const response = await fetch(`/api/products/${productId}`);
                const data = await response.json();
                return data;
            } catch (error) {
                commit('SET_ERROR', error.message);
                console.error('Error fetching product:', error);
                throw error;
            } finally {
                commit('SET_LOADING', false);
            }
        },
        updateFilters({ commit, dispatch }, { type, value }) {
            commit('SET_FILTER', { type, value });
            dispatch('fetchProducts');
        }
    },
    getters: {
        allProducts: state => state.products,
        isLoading: state => state.loading,
        error: state => state.error,
        categories: state => state.categories,
        currentFilters: state => state.filters,
        filteredProducts: state => {
            let filtered = [...state.products];
            
            if (state.filters.category) {
                filtered = filtered.filter(p => p.category === state.filters.category);
            }
            
            filtered = filtered.filter(p => 
                p.price >= state.filters.priceRange[0] && 
                p.price <= state.filters.priceRange[1]
            );
            
            if (state.filters.search) {
                const searchLower = state.filters.search.toLowerCase();
                filtered = filtered.filter(p => 
                    p.name.toLowerCase().includes(searchLower) ||
                    p.description.toLowerCase().includes(searchLower)
                );
            }
            
            return filtered;
        }
    }
}; 