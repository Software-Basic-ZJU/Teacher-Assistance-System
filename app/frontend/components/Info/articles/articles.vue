<template>
    <div>
        <div class="articleBox">
            <article-item
                    v-for="item in articleList"
                    :key="item.articleId"
                    :art-id="item.artId"
                    :title="item.title"
                    :author="item.author"
                    :publish-time="item.publishTime"
                    :content="item.content"
                    :reply-num="item.replyNum"
            >
            </article-item>
        </div>
    </div>
</template>
<style scoped>
    .articleBox{
        margin-top:-20px;
    }
</style>
<script>
    import articleItem from "./articleItem.vue";
    export default{
        data(){
            return{
            }
        },
        computed:{
            articleList(){
                return this.$store.state.info.articleList
            }
        },
        components:{
            articleItem
        }
    }
</script>
