<template>
    <div>
        <div class="post">
            <div class="header">
                <span class="author">{{author}}</span>
                <span class="time">发表于：{{time}}</span>
            </div>
            <div class="main">
                <div class="content">{{content}}</div>
            </div>
            <div class="footer">
                <div><i class="iconfont icon-pinglun"></i> ({{replyNum}})</div>
                <div><i class="iconfont icon-dianzan1"></i> ({{starNum}})</div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .post{
        padding:10px 15px;
        border-bottom:1px solid #E5E9F2;
    }
    .post>.header{
        padding:10px 0px;
        font-size:14px;
    }
    .post>.header>.author{
        color:#1D8CE0;
    }
    .post>.header>.time{
        margin-left: 50px;
        font-size:12px;
        color:#8492A6;
    }
    .post>.main{
        padding:10px 0px;
        font-size:14px;
    }
    .post>.footer{
        padding-top:5px;
        font-size:14px;
        text-align: right;
    }
    .post>.footer>div{
        display: inline-block;
        margin-right:10px;
        font-size:12px;
    }
    .post>.footer i{
        cursor:pointer;
    }
</style>
<script>
    export default{
        data(){
            return{
            }
        },
        props:{
            rpid:[String,Number],
            author:String,
            content:String,
            time:String,                         //发表时间
            replyNum:[String,Number],            //评论数量
            starNum:[String,Number]              //点赞数量
        }
    }
</script>
