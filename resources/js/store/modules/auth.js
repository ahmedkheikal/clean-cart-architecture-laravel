export default {
    namespaced: true,
    state: {
        user: null,
        isAuthenticated: false,
        token: localStorage.getItem('token') || null
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
            state.isAuthenticated = !!user;
        },
        SET_TOKEN(state, token) {
            state.token = token;
            if (token) {
                localStorage.setItem('token', token);
            } else {
                localStorage.removeItem('token');
            }
        }
    },
    actions: {
        async login({ commit }, credentials) {
            try {
                // TODO: Implement actual API call
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(credentials)
                });
                const data = await response.json();
                
                commit('SET_USER', data.user);
                commit('SET_TOKEN', data.token);
                return data;
            } catch (error) {
                console.error('Login error:', error);
                throw error;
            }
        },
        async logout({ commit }) {
            try {
                // TODO: Implement actual API call
                await fetch('/api/logout', {
                    method: 'POST'
                });
                
                commit('SET_USER', null);
                commit('SET_TOKEN', null);
            } catch (error) {
                console.error('Logout error:', error);
                throw error;
            }
        }
    },
    getters: {
        isAuthenticated: state => state.isAuthenticated,
        user: state => state.user
    }
}; 