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
            <div class="mb-4 mt-4 flex justify-between">
                <div class="mb-4">
                    <input @keyup="paginate()" v-model="postFilter.id" type="text" placeholder="post id"/>
                </div>
                <div class="mb-4">
                    <input @keyup="paginate()" v-model="postFilter.title" type="text" placeholder="post title"/>
                </div>
                <div class="mb-4">
                    <input @keyup="paginate()" v-model="postFilter.content" type="text" placeholder="post content"/>
                </div>
                <div class="mb-4">
                    <input @change="paginate()" v-model="postFilter.created_at_from" type="date"/>
                </div>
                <div class="mb-4">
                    <input @change="paginate()" v-model="postFilter.created_at_to" type="date"/>
                </div>
            </div>
            <div class="mb-4 mt-4 flex justify-between">
                <div class="mb-4">
                    <select @change="paginate()" v-model="postFilter.profile_id">
                        <option v-for="profile in profiles" :value="profile.id">
                            {{ profile.second_name }}
                            {{ profile.first_name }}
                        </option>
                    </select>
                </div>
                <div class="mb-4">
                    <Link @click="paginate(1)" href="#" class="inline-block px-3 py-2 bg-blue-600 text-white">Filter</Link>
                    <Link @click="this.postFilter = null" href="#" class="inline-block ml-4 px-5 py-2 bg-gray-600 text-white">Clear</Link>
                </div>
            </div>
            <div class="mb-4">
                <a href="#" v-for="link in postsData.meta.links" v-html="link.label" @click.prevent="paginate(link.label)"
                   :class="[(link.label == this.postsData.meta.current_page) ? ('bg-gray-600 text-white') : '', 'inline-block px-2 py-1 border border-gray-200 mr-2']">
                </a>
            </div>
            <div v-for="(post, index) in postsData.data" class="mb-4 pb-4 pt-4 border-b border-t border-gray-200">
                <h3>
                    ID {{ post.id }}
                    <br/>
                    {{ post.title }}
                </h3>
                <p>{{ post.content }}</p>
                <div class="mb-4 mt-4">
                    <Link :href="route('posts.show', post)" class="inline-block px-3 py-2 bg-gray-600 text-white">Show</Link>
                    <Link :href="route('posts.edit', post)" class="inline-block ml-3 px-3 py-2 bg-blue-600 text-white">Edit</Link>
                    <Link @click.prevent="destroyPost(post, index)" class="inline-block ml-3 px-3 py-2 bg-red-600 text-white">Del</Link>
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
            postsData: this.posts,
            postFilter: {},
        }
    },

    props: {
        posts: Array,
        profiles: Array,
    },

    methods: {
        destroyPost(post, index) {
            axios.delete('/posts/destroy/' + post.id, post)
                .then(response => {
                    this.redirectToPostsIndex();
                })
        },
        redirectToPostsIndex() {
            window.location.href = '/posts/index';
        },
        getPosts() {
            axios.get(
                '/posts/index', {
                    params: this.postFilter
                }
            ).then(response => {
                this.postsData = response.data
            })
        },
        paginate(label) {
            let page = 1;
            if (typeof label !== 'undefined') {
                page = this.postsData.meta.current_page ?? 1;
                switch (label) {
                    case 'pagination.previous':
                        page--;
                        break;
                    case 'pagination.next':
                        page++;
                        break;
                    default:
                        page = label * 1;
                }
            }

            if (page > this.postsData.meta.last_page) {
                page = this.postsData.meta.last_page;
            }
            if (page < 1) {
                page = 1;
            }

            this.postFilter.page = page;
            this.getPosts();
        }
    },

    components: {
        Link
    }
}
</script>
