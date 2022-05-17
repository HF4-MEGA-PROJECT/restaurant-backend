<template>
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Table</th>
                    <th class="px-4 py-3">Guests</th>
                    <th class="px-4 py-3">Amount</th>
                    <th class="px-4 py-3">Arrived at</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <tr v-for="table in currentTables" :key="table.id" class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Table {{ table.number }}
                            </p>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ table.amount_of_people }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        DKK {{ table.order_total ?? 0 }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ table.created_at }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "CurrentTables",
    props: {
        currentTables: Array
    }
}
</script>

<style scoped>

</style>
