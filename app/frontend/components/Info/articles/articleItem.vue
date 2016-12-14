<template>
    <div>
        <div @click="goArticle(artId)">
            <div class="item">
                <div class="header">
                    <div class="title">{{title}}</div>
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
        border-bottom:1px solid #EFF2F7;
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
        background-color:#EFF2F7;
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
