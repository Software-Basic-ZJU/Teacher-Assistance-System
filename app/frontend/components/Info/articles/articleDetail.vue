<template>
    <div>
        <div class="article">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'articles'}">教学文章</el-breadcrumb-item>
                    <el-breadcrumb-item>{{article.title}}</el-breadcrumb-item>
                </el-breadcrumb>
                <div class="btnGroup fr">
                    <el-button type="danger" icon="delete" @click="remove"></el-button>
                    <el-button type="success" icon="edit" @click="editArticle($route.params.artId)"></el-button>
                </div>
            </div>
            <div class="main">
                <div class="top">
                    <div class="title">{{article.title}}</div>
                    <div class="info">
                        <div class="author">作者：{{article.author}}</div>
                        <div class="time">发表于：{{article.publishTime}}</div>
                    </div>
                </div>
                <div class="content" v-html="article.content"></div>
                <el-button type="primary" @click="reply(article.artId)">回复</el-button>
            </div>
            <div class="commentBox">
                <comment
                        v-for="item in article.replyList"
                        :key="item.commentId"
                        :comment-id="item.commentId"
                        :content="item.content"
                        :author-id="item.authorId"
                        :author-name="item.authorName"
                        :time="item.time"
                ></comment>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .article{
        padding:0 10px;
    }
    .header{
        padding-top:10px;
    }
    .btnGroup{
        margin-top:-45px;
    }
    .main{
        padding:20px;
        width:95%;
        margin:0px auto;
        border-bottom:1px solid #E5E9F2;
    }
    .main>.top{
        padding-bottom:20px;
        text-align: center;
    }
    .main .title{
        font-size:32px;
    }
    .main .info{
        margin-top:10px;
        font-size:14px;
        color:#475669;
    }
    .main .info>.time{
        margin-top:5px;
    }
    .main>.content{
        line-height:24px;
    }
    .main .el-button{
        margin-top:30px;
    }
</style>
<script>
    import router from "../../../routes";
    import comment from "./comment/comment.vue";
    export default{
        data(){
            return{
            }
        },
        computed:{
            article(){
                let articles=this.$store.state.info.articleList;
                for(let i=0;i<articles.length;i++){
                    if(articles[i].artId==this.$route.params.artId){
                        return articles[i];
                    }
                }
            }
        },
        methods:{
            editArticle(artId){
                router.push({name:'editArticle',params:{artId:artId}});
            },
            remove(){

            }
        },
        components:{
            comment
        }
    }
</script>
