<template>
    <div>
        <el-button type="success" class="fr" icon="plus" @click="addArticle" v-if="idenType!=1"></el-button>
        <div class="articleBox">
            <div class="noRes" v-if="articleList.length==0">还没有发表文章~</div>
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
    .articleBox .noRes{
        padding:20px 0px 10px 0px;
        text-align: center;
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
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            this.$store.dispatch('getArticleList');
            return{
                idenType:userInfo.type
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
