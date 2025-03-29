<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" sm="8" md="6" lg="4">
                <v-card class="mt-12">
                    <v-card-title class="text-h4 text-center pa-4">
                        Login
                    </v-card-title>

                    <v-card-text>
                        <v-form @submit.prevent="handleLogin" ref="form">
                            <v-text-field
                                v-model="formData.email"
                                :rules="[rules.required, rules.email]"
                                label="Email"
                                type="email"
                                prepend-inner-icon="mdi-email"
                                variant="outlined"
                                required
                            ></v-text-field>

                            <v-text-field
                                v-model="formData.password"
                                :rules="[rules.required, rules.min]"
                                label="Password"
                                :type="showPassword ? 'text' : 'password'"
                                prepend-inner-icon="mdi-lock"
                                :append-inner-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                                @click:append-inner="showPassword = !showPassword"
                                variant="outlined"
                                required
                            ></v-text-field>

                            <div class="d-flex justify-space-between align-center mb-4">
                                <v-checkbox
                                    v-model="formData.remember"
                                    label="Remember me"
                                    hide-details
                                ></v-checkbox>
                                <v-btn variant="text" color="primary" size="small">
                                    Forgot Password?
                                </v-btn>
                            </div>

                            <v-alert
                                v-if="error"
                                type="error"
                                class="mb-4"
                                closable
                            >
                                {{ error }}
                            </v-alert>

                            <v-btn
                                type="submit"
                                color="primary"
                                block
                                :loading="loading"
                                size="large"
                            >
                                Login
                            </v-btn>
                        </v-form>
                    </v-card-text>

                    <v-card-text class="text-center">
                        Don't have an account?
                        <v-btn variant="text" color="primary" to="/signup">
                            Sign up
                        </v-btn>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            formData: {
                email: '',
                password: '',
                remember: false
            },
            showPassword: false,
            loading: false,
            error: null,
            rules: {
                required: v => !!v || 'This field is required',
                email: v => /.+@.+\..+/.test(v) || 'Please enter a valid email',
                min: v => v.length >= 8 || 'Password must be at least 8 characters'
            }
        }
    },
    methods: {
        async handleLogin() {
            try {
                const { valid } = await this.$refs.form.validate()
                
                if (!valid) return

                this.loading = true
                this.error = null;

                
                await this.$store.dispatch('auth/login', this.formData)
                this.$router.push('/')
            } catch (error) {
                this.error = error.message || 'Failed to login. Please try again.'
            } finally {
                this.loading = false
            }
        }
    }
}
</script> 