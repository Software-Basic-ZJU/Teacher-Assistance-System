<template>
    <div>
        <div @click="goArticle(artId)">
            <el-card class="box-card">
                <div class="header">
                    <div class="title">{{title}}</div>
                    <span class="author">{{author}}</span>
                    <span class="time">发表时间：{{publishTime}}</span>
                </div>
                <div class="main">
                    <div class="content">{{content}}</div>
                </div>
                <div class="footer">
                    <i class="iconfont icon-pinglun"> ({{replyNum}})</i>
                </div>
            </el-card>
        </div>
    </div>
</template>
<style scoped>
    .el-card{
        cursor:pointer;
        margin-top:10px;
    }
    .header>.title{
        margin-bottom:5px;
        font-size:20px;
        color:#1D8CE0;
    }
    .header>span{
        font-size:14px;
    }
    .header>.time{
        margin-left:80px;
    }
    .main{
        margin:15px 0px;
        background-color:#EFF2F7;
        padding:10px 15px;
    }
    .main>.content{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .footer{
        text-align: right;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        props:{
            artId:[String,Number],
            title:String,
            author:String,
            publishTime:String,
            content:String,
            replyNum:String
        },
        methods:{
            goArticle(artId){
                router.push({name:'articleDetail',params:{artId:artId}});
            }
        }
    }
</script>
