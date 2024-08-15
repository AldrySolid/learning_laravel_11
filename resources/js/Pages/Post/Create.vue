<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <Head title="Post Create" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post create</h2>
        </template>

        <div class="w-1/2 mx-auto">
            <div class="mb-4 mt-4">
                <div class="mb-4">
                    <input v-model="post.title" type="text" placeholder="title"/>
                </div>
                <div class="mb-4">
                    <input v-model="post.content" type="text" placeholder="content"/>
                </div>
                <div class="mb-4">
                    <Link @click="storePost" href="#" class="inline-block px-3 py-2 bg-green-600 text-white">Add</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    name: "Create",

    data() {
        return {
            post: {}
        }
    },

    methods: {
        storePost() {
            axios.post('/posts/store', this.post)
                .then(response => {
                    this.getPosts();
                })
        },
        getPosts() {
            window.location.href = '/posts/index';
        },
    }
}
</script>
