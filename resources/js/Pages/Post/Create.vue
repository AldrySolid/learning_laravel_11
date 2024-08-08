<template>
    <div class="w-1/2 mx-auto">
        <div>
            <div>
                <input v-model="post.title" type="text" placeholder="title"/>
            </div>
            <div>
                <input v-model="post.content" type="text" placeholder="content"/>
            </div>
            <div class="mb-4">
                <Link @click="storePost" href="#" class="inline-block px3 py-2 bg-indigo-600 text-while">Add</Link>
            </div>
        </div>
    </div>

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
                .then(res => {
                    console.log(res);
                    router('posts.index');
                })
        },
    }
}
</script>

<style scoped>

</style>
