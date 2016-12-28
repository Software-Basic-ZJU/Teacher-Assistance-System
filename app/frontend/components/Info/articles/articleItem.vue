<template>
    <div>
        <div @click="goArticle(artId)">
            <div class="item">
                <div class="header">
                    <div class="title">{{title}}<el-tag :class="{'public':authority==1}">{{authority==0?'公开文章':'私密文章'}}</el-tag></div>
                    <span class="author">{{author}}</span>
                    <span class="time">发表时间：{{publishTime}}</span>
                </div>
                <div class="main">
                    <div class="content" v-html="content"></div>
                </div>
                <div class="footer">
                    <i class="iconfont icon-pinglun"> ({{replyNum}})</i>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .item{
        cursor:pointer;
        border-bottom:1px solid #F0F0F0 ;
        padding-top:10px;
        padding-bottom:10px;
        -webkit-transition: border-color 0.3s;
        -moz-transition: border-color 0.3s;
        -ms-transition: border-color 0.3s;
        -o-transition: border-color 0.3s;
        transition: border-color 0.3s;
    }
    .item:hover{
        border-bottom-color:#6ECADC;
    }
    .header>.title{
        margin-bottom:5px;
        font-size:20px;
        color:#6ECADC;
    }
    .header>span{
        font-size:12px;
    }
    .header>.time{
        margin-left:80px;
    }
    .main{
        margin:10px 0px;
        background-color:#F0F0F0 ;
        padding:10px 15px;
    }
    .main>.content{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size:14px;
    }
    .footer{
        text-align: right;
    }
    .footer>.iconfont{
        font-size:14px;
    }
    .el-tag{
        margin-left:40px;
    }
    .el-tag.public{
        background-color:#6ECADC ;
        border-color:#6ECADC ;
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
            replyNum:String,
            authority:[String,Number,Boolean]
        },
        methods:{
            goArticle(artId){
                router.push({name:'articleDetail',params:{artId:artId}});
            }
        },
    }
</script>
