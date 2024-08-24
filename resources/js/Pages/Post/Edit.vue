<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <Head title="Post Edit"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post Edit</h2>
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
                        placeholder="Select your characters"
                        label="title"
                        :options="tagsTitles"
                        :search="true"
                        :searchable="true"
                        :createTag="true"
                    >
                        <template v-slot:option="{ option }">{{ option.title }}</template>
                    </Multiselect>
                </div>
                <div v-if="post.image_path" class="mb-4">
                    <img :src="post.image_path" width="320px" />
                </div>
                <div class="mb-4">
                    <input @change="setImage" ref="input_image" type="file" accept=".jpg,.jpeg"/>
                </div>
                <div class="mb-4">
                    <Link @click="updatePost" href="#" class="inline-block px-3 py-2 bg-blue-600 text-white">Edit</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import Multiselect from '@vueform/multiselect'

export default {
    name: "Edit",

    components: {
        Multiselect,
    },

    props: {
        post: Object,
        tagsTitles: Array,
    },

    data() {
        return {}
    },

    methods: {
        updatePost() {
            axios.post('/posts/update/' + this.post.id, this.post, {
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
        setImage(event) {
            this.post.image = event.target.files[0];
        },
    }
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
