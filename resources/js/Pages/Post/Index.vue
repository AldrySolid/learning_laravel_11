<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <Head title="Posts List"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Posts List</h2>
        </template>

        <div class="w-1/2 mx-auto">
            <div class="mb-4 mt-4">
                <Link :href="route('posts.create')" class="inline-block px-3 py-2 bg-green-600 text-white">Add</Link>
            </div>
            <div v-for="(post, index) in posts" class="mb-4 pb-4 pt-4 border-b border-t border-gray-200">
                <h3>
                    ID {{ post.id }}
                    <br/>
                    {{ post.title }}
                </h3>
                <p>{{ post.content }}</p>
                <div class="mb-4 mt-4">
                    <Link :href="route('posts.edit', post)" class="inline-block px-3 py-2 bg-blue-600 text-white">Edit</Link>
                    <Link @click="destroyPost(post, index)" class="inline-block ml-3 px-3 py-2 bg-red-600 text-white">Del</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: "Index",

    data() {
        return {
            posts: Array
        }
    },

    props: {
        posts: Array
    },

    methods: {
        destroyPost(post, index) {
            console.log(index);
            axios.delete('/posts/destroy/' + post.id, post)
                .then(response => {
                    this.getPosts();
                })
        },
        getPosts() {
            window.location.href = '/posts/index';
        },
    },

    components: {
        Link
    }
}
</script>
