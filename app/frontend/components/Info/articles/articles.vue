<template>
    <div>
        <div class="articleBox">
            <el-button type="success" class="fr" icon="plus" @click="addArticle"></el-button>
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
        margin-top:-10px;
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
