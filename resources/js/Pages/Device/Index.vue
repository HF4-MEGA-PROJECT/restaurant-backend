<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeviceTokenManager from '@/Pages/Device/Partials/DeviceTokenManager';

defineProps({
    tokens: Array,
    availablePermissions: Array,
    defaultPermissions: Array,
});
</script>

<template>
    <AppLayout title="Device Tokens">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Device Tokens
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <DeviceTokenManager
                    :tokens="tokens"
                    :available-permissions="availablePermissions"
                    :default-permissions="defaultPermissions"
                />
            </div>
        </div>
    </AppLayout>
</template>
