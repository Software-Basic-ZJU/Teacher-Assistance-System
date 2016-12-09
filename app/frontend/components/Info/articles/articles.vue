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
            <el-pagination
                    small
                    @current-change="changePage"
                    page-size="8"
                    :current-page="currPage"
                    layout="prev,pager,next"
                    :total="articlesNum"
            ></el-pagination>
        </div>
    </div>
</template>
<style scoped>
    .articleBox{
    }
    .el-button--success{
        margin-top:-62px;
    }
    .el-pagination{
        margin-top:10px;
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
            articlesNum(){
                return this.$store.state.info.articleList.length;
            },
            articleList(){
                return this.$store.getters.articleList;
            },
            currPage(){
                return this.$store.state.info.articleCurrPage
            }
        },
        methods:{
            addArticle(){
                router.push({name:'addArticle'});
            },
            changePage(val){
                this.$store.dispatch('changeArtPage',val);
            }
        },
        components:{
            articleItem
        }
    }
</script>
