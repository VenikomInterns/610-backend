<template>
    <Head title="Category"/>
    <div>
        <table>
            <tr>
                <th>Category Name</th>
                <th></th>
            </tr>
            <tr v-for="category in categories" :key="category.id">
                <td>
                    {{ category.name }}
                </td>
                <td>
                    <Link :href="route('categories.edit', category.id)"
                          class="text-sm text-gray-700 dark:text-gray-500 underline">
                        Edit
                    </Link>
                    <Link method="DELETE" type="button" as="button" :href="route('categories.destroy', category.id)">
                        Delete
                    </Link>
                </td>
            </tr>
        </table>
        <form @submit.prevent="submit">
            <div>
                <label for="name">Category Name:</label>
                <input
                    name="name"
                    id="name"
                    type="text"
                    v-model="form.name"/>
                <button type="submit">
                    Add
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import {Head, Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";

defineProps({
    categories: Array
})

const form = useForm({
    name: null
});

const submit = () => {
    form.post(route("categories.store"), {
        onSuccess: () => {
            form.name = ''
        }
    });
}
</script>
