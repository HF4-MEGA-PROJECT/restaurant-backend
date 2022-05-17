<script setup>
import AppLayout from '../Layouts/AppLayout.vue';
import TotalClients from "../Components/Widgets/TotalClients";
import RevenueThisMonth from "../Components/Widgets/RevenueThisMonth";
import ProductsSoldThisMonth from "../Components/Widgets/ProductsSoldThisMonth";
import ReservationsToday from "../Components/Widgets/ReservationsToday";
import CurrentTables from "../Components/Tables/CurrentTables";

defineProps({
    totalGuests: Number,
    revenueThisMonth: Number,
    productsSoldThisMonth: Number,
    reservationsToday: Number,
    currentTables: Array
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <TotalClients :totalGuests="totalGuests"/>
                    <RevenueThisMonth :revenueThisMonth="revenueThisMonth"/>
                    <ProductsSoldThisMonth :productsSoldThisMonth="productsSoldThisMonth"/>
                    <ReservationsToday :reservationsToday="reservationsToday"/>
                </div>

                <CurrentTables :currentTables="currentTables"/>
            </div>
        </div>
    </AppLayout>
</template>
