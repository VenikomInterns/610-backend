<template>
    <Head title="Brand Model"/>
    <div>
        <form @submit.prevent="submit">
            <div>
                <label for="name">Brand Name: </label>
                <input
                    name="name"
                    id="name"
                    type="text"
                    v-model="form.name"/>
            </div>
            <button type="submit">
                Save
            </button>
        </form>
    </div>
</template>

<script setup>
import {Head, Link} from "@inertiajs/inertia-vue3";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    category: Array
})

const form = useForm({
    name: props.category.name
});

const submit = () => {
    form.put(route("categories.update", props.category));
}

//nice
</script>
