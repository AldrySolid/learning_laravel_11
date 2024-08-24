<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <Head title="Post Create"/>

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
                    <Multiselect
                        v-model="post.tagsTitles"
                        mode="tags"
                        placeholder="Select tags"
                        label="title"
                        :options="tagsTitles"
                        :search="true"
                        :searchable="true"
                        :createTag="true"
                    >
                        <template v-slot:option="{ option }">{{ option.title }}</template>
                    </Multiselect>
                </div>
                <div class="mb-4">
                    <Link @click="storePost" href="#" class="inline-block px-3 py-2 bg-green-600 text-white">Add</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import Multiselect from '@vueform/multiselect'

export default {
    name: "Create",

    components: {
        Multiselect,
    },

    props: {
        post: Object,
        tagsTitles: Array,
    },

    data() {
        return {
            post: {}
        }
    },

    methods: {
        storePost() {
            axios.post('/posts/store', this.post, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(response => {
                    this.redirectToPostsIndex();
                })
        },
        redirectToPostsIndex() {
            window.location.href = '/posts/index';
        },
    }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
