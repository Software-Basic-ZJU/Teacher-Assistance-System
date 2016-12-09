<template>
    <div>
        <el-button type="success" class="fr" icon="plus" @click="addArticle"></el-button>
        <div class="articleBox">
            <article-item
                    v-for="item in articleList"
                    :key="item.article_id"
                    :art-id="item.article_id"
                    :title="item.title"
                    :author="item.author"
                    :publish-time="item.time"
                    :content="item.content"
                    :reply-num="item.replyNum"
            >
            </article-item>
        </div>
    </div>
</template>
<style scoped>
    .articleBox{
        margin-top:0px;
    }
    .el-button--success{
        margin-top:-62px;
    }
</style>
<script>
    import articleItem from "./articleItem.vue";
    import router from "../../../routes";
    export default{
        data(){
            this.$store.dispatch('getArticleList');
            return{
            }
        },
        computed:{
            articleList(){
                return this.$store.state.info.articleList
            }
        },
        methods:{
            addArticle(){
                router.push({name:'addArticle'});
            }
        },
        components:{
            articleItem
        }
    }
</script>
