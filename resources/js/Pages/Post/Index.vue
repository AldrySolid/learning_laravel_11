<template>
    <div class="w-1/2 mx-auto">
        <div class="mb-4">
            <Link :href="route('posts.create')" class="inline-block px3 py-2 bg-indigo-600 text-while">Add</Link>
        </div>
        <div v-for="post in posts" class="mb-4 pb-4 border-b border-gray-200">
            <h3>
                {{ post.title }}
            </h3>
            <p>{{ post.content }}</p>
        </div>
        post {{ person.name }} age {{ person.age }}
    </div>

</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: "Index",

    data() {
        return {
            person: {
                name: 'Ivan',
                age: 20
            }
        }
    },

    props: {
        posts: Array
    },

    methods: {
      test() {

      },
    },

    components: {
        Link
    }
}
</script>

<style scoped>

</style>
