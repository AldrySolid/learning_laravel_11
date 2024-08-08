<template>
    <div class="w-1/2 mx-auto">
        <div class="mb-4">
            <Link :href="route('articles.create')" class="inline-block px3 py-2 bg-indigo-600 text-while">Add</Link>
        </div>
        <div v-for="article in articles" class="mb-4 pb-4 border-b border-gray-200">
            <h3>
                {{ article.title }}
            </h3>
            <p>{{ article.content }}</p>
        </div>
    </div>

</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: "Index",

    data() {
        return {

        }
    },

    props: {
        articles: Array
    },

    methods: {

    },

    components: {
        Link
    }
}
</script>

<style scoped>

</style>
