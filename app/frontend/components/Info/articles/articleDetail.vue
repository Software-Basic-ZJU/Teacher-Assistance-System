<template>
    <div>
        <div class="article">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'articles'}">教学文章</el-breadcrumb-item>
                    <el-breadcrumb-item>{{article.title}}</el-breadcrumb-item>
                </el-breadcrumb>
                <el-button type="success" class="fr" @click="editArticle">编辑</el-button>
            </div>
            <div class="main">
                <div class="top">
                    <div class="title">{{article.title}}</div>
                    <div class="info">
                        <span class="author">{{article.author}}</span>
                        <span class="time">{{article.publishTime}}</span>
                    </div>
                </div>
                <div class="content">
                    {{article.content}}
                </div>
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
    .el-button--success{
        margin-top:-45px;
    }
    .main{
        padding:20px;
    }
</style>
<script>
    export default{
        data(){
            return{
            }
        },
        computed:{
            article(){
                let articles=this.$store.getters.articleList;
                for(let i=0;i<articles.length;i++){
                    if(articles[i].artId==this.$route.params.artId){
                        return articles[i];
                    }
                }
            }
        }
    }
</script>
