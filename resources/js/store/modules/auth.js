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
                // todo implement csrf token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const response = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(credentials)
                });
                const data = await response.json();

                if (response.status !== 200) {
                    throw new Error(data.message);
                }

                commit('SET_USER', data.data.user);
                commit('SET_TOKEN', data.data.authorization.token);
                commit('fetchCart');
                return data;
            } catch (error) {
                console.error('Login error:', error);
                throw error;
            }
        },
        async register({ commit }, credentials) {
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const response = await fetch('/api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(credentials)
                });
                const data = await response.json();
                if (response.status !== 200) {
                    if (response.status === 422) {
                        for (const element in data.errors) {
                            throw new Error(data.errors[element]);  
                        }
                    }
                    throw new Error(data.message);
                }
                
                commit('SET_USER', data.data.user);
                commit('SET_TOKEN', data.data.authorization.token);
                return data;
            } catch (error) {
                console.error('Register error:', error);
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