<template>
    <v-container>
        <h2 class="text-h4 mb-6">Account Settings</h2>
        
        <v-row>
            <v-col cols="12" md="8">
                <v-card>
                    <v-tabs v-model="activeTab">
                        <v-tab value="profile">Profile</v-tab>
                        <v-tab value="security">Security</v-tab>
                        <v-tab value="addresses">Addresses</v-tab>
                    </v-tabs>
                    
                    <v-card-text>
                        <v-window v-model="activeTab">
                            <v-window-item value="profile">
                                <v-form @submit.prevent="updateProfile">
                                    <v-text-field
                                        v-model="profile.firstName"
                                        label="First Name"
                                        required
                                    ></v-text-field>
                                    
                                    <v-text-field
                                        v-model="profile.lastName"
                                        label="Last Name"
                                        required
                                    ></v-text-field>
                                    
                                    <v-text-field
                                        v-model="profile.email"
                                        label="Email"
                                        type="email"
                                        required
                                    ></v-text-field>
                                    
                                    <v-text-field
                                        v-model="profile.phone"
                                        label="Phone Number"
                                    ></v-text-field>
                                    
                                    <v-btn color="primary" type="submit">
                                        Save Changes
                                    </v-btn>
                                </v-form>
                            </v-window-item>
                            
                            <v-window-item value="security">
                                <v-form @submit.prevent="updatePassword">
                                    <v-text-field
                                        v-model="security.currentPassword"
                                        label="Current Password"
                                        type="password"
                                        required
                                    ></v-text-field>
                                    
                                    <v-text-field
                                        v-model="security.newPassword"
                                        label="New Password"
                                        type="password"
                                        required
                                    ></v-text-field>
                                    
                                    <v-text-field
                                        v-model="security.confirmPassword"
                                        label="Confirm New Password"
                                        type="password"
                                        required
                                    ></v-text-field>
                                    
                                    <v-btn color="primary" type="submit">
                                        Update Password
                                    </v-btn>
                                </v-form>
                            </v-window-item>
                            
                            <v-window-item value="addresses">
                                <v-list>
                                    <v-list-item v-for="address in addresses" :key="address.id">
                                        <v-list-item-title>{{ address.name }}</v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{ formatAddress(address) }}
                                        </v-list-item-subtitle>
                                        
                                        <template v-slot:append>
                                            <v-btn icon="mdi-pencil" variant="text" 
                                                @click="editAddress(address)"></v-btn>
                                            <v-btn icon="mdi-delete" variant="text" color="error"
                                                @click="deleteAddress(address.id)"></v-btn>
                                        </template>
                                    </v-list-item>
                                </v-list>
                                
                                <v-btn color="primary" class="mt-4" @click="addNewAddress">
                                    Add New Address
                                </v-btn>
                            </v-window-item>
                        </v-window>
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
            activeTab: 'profile',
            profile: {
                firstName: '',
                lastName: '',
                email: '',
                phone: ''
            },
            security: {
                currentPassword: '',
                newPassword: '',
                confirmPassword: ''
            },
            addresses: []
        }
    },
    methods: {
        updateProfile() {
            // TODO: Implement profile update
            console.log('Updating profile:', this.profile);
        },
        updatePassword() {
            // TODO: Implement password update
            console.log('Updating password');
        },
        formatAddress(address) {
            return `${address.street}, ${address.city}, ${address.state} ${address.zip}`;
        },
        editAddress(address) {
            // TODO: Implement address editing
            console.log('Editing address:', address);
        },
        deleteAddress(addressId) {
            // TODO: Implement address deletion
            console.log('Deleting address:', addressId);
        },
        addNewAddress() {
            // TODO: Implement new address addition
            console.log('Adding new address');
        }
    }
}
</script> 