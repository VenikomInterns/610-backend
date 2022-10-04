<template>
    <Head title="Show Product"/>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <label>Product Name</label>
                        {{ showProduct.name }}
                    </div>
                    <div>
                        <label>Price:</label>
                        {{ showProduct.price }}
                    </div>
                    <div>
                        <label>Description:</label>
                        {{ showProduct.description }}
                    </div>
                    <div>
                        <label>Category:</label>
                        {{ showProduct.category.name }}
                    </div>
                    <div class="mt-4">
                        <label>Product Image</label>
                        <!--Image full url calculations should be done on backend. -->
                        <div v-for="image in showProduct.images" :key="image.id">
                            <img v-if="image.path.charAt(0) === 'd' " :src="image.path"/>
                            <img v-if="image.path.charAt(0) !== 'd' "
                                 :src="'http://127.0.0.1:8000/storage/'+image.path"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    showProduct: Object
});
</script>
