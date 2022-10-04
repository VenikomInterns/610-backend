<template>
    <Head title="Product"/>
    <div>
        <Link :href="route('products.create')" class="text-sm text-gray-700 dark:text-gray-500 underline">
            Create New Product
        </Link>
    </div>
    <div>
        <table class="table border-4 text-center">
            <tr class="table-row text-center">
                <th class=" border-4 columns-3">
                    #
                </th>
                <th class=" border-4 columns-3">
                    Name
                </th>
                <th class=" border-4 columns-3">
                    Price
                </th>
                <th class=" border-4 columns-3">
                    Description
                </th>
                <th class=" border-4 columns-3">
                    Category
                </th>
                <th class=" border-4 columns-3">
                </th>
                <th class=" border-4 columns-3">
                </th>
                <th class=" border-4 columns-3">
                </th>
            </tr>
            <tr v-for="(product, index) in products.data" :key="product.id" class="table-row">
                <td class="table-cell border-4">
                    {{ index+1 }}
                </td>
                <td class="table-cell border-4">
                    {{ product.name }}
                </td>
                <td class="table-cell border-4">
                    {{ product.price }}
                </td>
                <td class="table-cell border-4">
                    {{ product.description }}
                </td>
                <td class="table-cell border-4">
                    {{ product.category.name }}
                </td>
                <td class="table-cell border-4">
                    <Link :href="route('products.edit', product.id)"
                          class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Edit
                    </Link>
                </td>
                <td class="table-cell border-4">
                    <Link :href="route('products.show', product.id)"
                          class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Show
                    </Link>
                </td>
                <td class="table-cell border-4">
                    <Link method="DELETE" type="button" as="button" :href="route('products.destroy', product.id)"
                          class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Delete
                    </Link>
                </td>
            </tr>
        </table>
        <div class="flex justify-center">
            <div v-for="link in products.links">
                <Link class="mx-2"
                      :href="link.url"
                      v-html="link.label"/>
            </div>
        </div>
    </div>
</template>

<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';

defineProps({
    products: Array,
});
//excellent
</script>
