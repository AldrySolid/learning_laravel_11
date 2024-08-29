<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
    <Head title="Post Show"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Post Show</h2>
        </template>

        <div class="w-1/2 mx-auto">
            <div class="mb-4 mt-4">
                <div class="mb-4">
                    <b>Title:</b><br/>
                    {{ post.title }}
                </div>
                <div class="mb-4">
                    <b>Content:</b><br/>
                    {{ post.content }}
                </div>
                <div class="mb-4">
                    <b>Tags:</b><br/>
                    <ul>
                        <li v-for="tag in post.tagsTitles"> #{{ tag }}</li>
                    </ul>
                </div>
                <div v-if="post.image_path" class="mb-4">
                    <img :src="post.image_path" width="320px"/>
                </div>
                <div class="mb-4">
                    <b>Comments:</b><br/>
                    <ul>
                        <li v-for="comment in post.comments">
                            <i>{{ comment.created_at }}</i> {{ comment.profile.first_name }}<br/>
                            {{ comment.content }}
                            <div class="mb-4 mt-4 ml-10">
                                <hr/>
                                <div class="mb-4">
                                    <b>Child comments:</b><br/>
                                    <ul>
                                        <li v-for="childComment in comment.comments">
                                            <i>{{ childComment.created_at }}</i> {{ childComment.profile.first_name }}<br/>
                                            {{ childComment.content }}
                                        </li>
                                    </ul>
                                    <div class="mb-4 mt-4">
                                        <hr/>
                                        <b class="mt-4">Add child comment:</b><br/>
                                        <input v-model="addChildCommentData.content" type="text" placeholder="insert your comment"/><br/>
                                        <Link href="#" @click.prevent="postChildCommentAdd(comment.id)"
                                              class="inline-block mt-3 px-3 py-2 bg-green-600 text-white">Add
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="mb-4 mt-4">
                    <hr/>
                    <b class="mt-4">Add comment:</b><br/>
                    <input v-model="addCommentData.content" type="text" placeholder="insert your comment"/><br/>
                    <Link href="#" @click.prevent="postCommentAdd" class="inline-block mt-3 px-3 py-2 bg-green-600 text-white">Add</Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Link} from '@inertiajs/vue3';

export default {
    name: "Show",

    props: {
        post: Object,
    },

    data() {
        return {
            addCommentData: {
                content: ''
            },
            addChildCommentData: {
                content: ''
            },
        }
    },

    methods: {
        postCommentAdd() {
            axios.post('/posts/' + this.post.id + '/comments', this.addCommentData)
                .then(response => {
                    this.refreshPost();
                })
        },
        postChildCommentAdd(parent_comment_id) {
            axios.post('/posts/' + this.post.id + '/comments/' + parent_comment_id, this.addChildCommentData)
                .then(response => {
                    this.refreshPost();
                })
        },
        refreshPost() {
            window.location.href = '/posts/show/' + this.post.id;
        },
    }
}
</script>
