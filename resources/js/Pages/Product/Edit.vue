<template>
    <Head title="Edit Product"/>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form @submit.prevent="submit">
                        <div>
                            <label for="name">Product Name</label>
                            <input
                                name="name"
                                id="name"
                                type="text"
                                v-model="form.name"/>
                        </div>
                        <div>
                            <label for="price">Price:</label>
                            <input
                                name="price"
                                id="price"
                                type="number"
                                v-model="form.price"/>
                        </div>
                        <div>
                            <label for="description">Description:</label>
                            <input
                                name="description"
                                id="description"
                                type="text"
                                v-model="form.description"/>
                        </div>
                        <div>
                            <label for="category_id">Category:</label>
                            <select
                                name="category_id"
                                id="category_id"
                                type="text"
                                v-model="form.category_id">
                                <option v-for="category in categories" :value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label for="images">Product Image</label>
                            <input
                                name="images"
                                id="images"
                                type="file"
                                ref="photo"
                                multiple
                                @change="handleChange"/>
                        </div>
                        <div class="flex items-center mt-4">
                            <button type="submit">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    showProduct: Object,
    categories: Array
});

//can be refactored to form= useForm({...props.showProduct, ...{_method:'PUT'}})
const form = useForm({
    _method:"PUT",
    category_id: props.showProduct.category.id,
    name: props.showProduct.name,
    price: props.showProduct.price,
    description: props.showProduct.description,
    images: props.showProduct.images
});

const submit = () => {
    form.post(route("products.update", props.showProduct));
}

const handleChange = (e) => {
    const file = e.target.files;
    if (!file) return;
    form.images = file;
}
</script>
