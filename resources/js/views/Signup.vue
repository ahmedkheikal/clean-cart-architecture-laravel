<template>
    <v-container>
        <v-row justify="center">
            <v-col cols="12" sm="8" md="6" lg="4">
                <v-card class="mt-12">
                    <v-card-title class="text-h4 text-center pa-4">
                        Create Account
                    </v-card-title>

                    <v-card-text>
                        <v-form @submit.prevent="handleSignup" ref="form">
                            <v-row>
                                <v-col cols="12">
                                    <v-text-field
                                        v-model="formData.name"
                                        :rules="[rules.required]"
                                        label="Name"
                                        variant="outlined"
                                        required
                                    ></v-text-field>
                                </v-col>
                            </v-row>

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

                            <v-text-field
                                v-model="formData.confirmPassword"
                                :rules="[rules.required, rules.passwordMatch]"
                                label="Confirm Password"
                                :type="showPassword ? 'text' : 'password'"
                                prepend-inner-icon="mdi-lock"
                                variant="outlined"
                                required
                            ></v-text-field>

                            <v-checkbox
                                v-model="formData.terms"
                                :rules="[rules.required]"
                                label="I agree to the Terms and Conditions"
                                required
                            ></v-checkbox>

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
                                Create Account
                            </v-btn>
                        </v-form>
                    </v-card-text>

                    <v-card-text class="text-center">
                        Already have an account?
                        <v-btn variant="text" color="primary" to="/login">
                            Login
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
                name: '',
                email: '',
                password: '',
                confirmPassword: '',
                terms: false
            },
            showPassword: false,
            loading: false,
            error: null,
            rules: {
                required: v => !!v || 'This field is required',
                email: v => /.+@.+\..+/.test(v) || 'Please enter a valid email',
                min: v => v.length >= 8 || 'Password must be at least 8 characters',
                passwordMatch: v => v === this.formData.password || 'Passwords must match'
            }
        }
    },
    methods: {
        async handleSignup() {
            try {
                const { valid } = await this.$refs.form.validate()
                
                if (!valid) return

                this.loading = true
                this.error = null

                // Remove confirmPassword and terms from the data sent to the server
                const { confirmPassword, terms, ...signupData } = this.formData
                await this.$store.dispatch('auth/register', signupData)
                
                this.$router.push('/login')
            } catch (error) {
                this.error = error.message || 'Failed to create account. Please try again.'
            } finally {
                this.loading = false
            }
        }
    }
}
</script> 