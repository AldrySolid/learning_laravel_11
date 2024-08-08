<template>
    <div class="w-1/2 mx-auto">
        <div>
            <div>
                <input v-model="article.title" type="text" placeholder="title"/>
            </div>
            <div>
                <input v-model="article.content" type="text" placeholder="content"/>
            </div>
            <div class="mb-4">
                <Link @click="storeArticle" href="#" class="inline-block px3 py-2 bg-indigo-600 text-while">Add</Link>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: "Create",

    data() {
        return {
            article: {}
        }
    },

    methods: {
        storeArticle() {
            axios.post('/articles/store', this.article)
                .then(res => {
                    console.log(res);
                    router('articles.index');
                })
        },
    }
}
</script>

<style scoped>

</style>
