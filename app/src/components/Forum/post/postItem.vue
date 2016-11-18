<!-- 帖子列表的item -->

<template>
    <div>
        <div class="box-card postItem" @click="goPath('post')">
            <div class="header">
                <span class="author">{{author}}</span>
                <span class="time">最后更新：{{updateTime}}</span>
            </div>
            <div class="main">
                <div class="brief">{{title}}</div>
            </div>
            <div class="footer">
                <div><i class="iconfont icon-pinglun"></i> ({{replyNum}})</div>
                <div><i class="iconfont icon-dianzan1"></i> ({{starNum}})</div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .postItem{
        margin:10px auto;
        margin-top:0px;
        padding:10px 15px;
        cursor:pointer;
        border-bottom:1px solid #E5E9F2;
        -webkit-transition: background-color 0.3s;
        -moz-transition: background-color 0.3s;
        -ms-transition: background-color 0.3s;
        -o-transition: background-color 0.3s;
        transition: background-color 0.3s;
    }
    .postItem:hover{
        background-color: #E5E9F2;
    }
    .postItem>.header{
        padding:10px 0px;
        font-size:14px;
    }
    .postItem>.header>.author{
        color:#1D8CE0;
    }
    .postItem>.header>.time{
        margin-left: 50px;
        font-size:12px;
        color:#8492A6;
    }
    .postItem>.main{
        padding:10px 0px;
    }
    .postItem>.main>.brief{
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .postItem>.footer{
        padding-top:5px;
        font-size:14px;
        text-align: right;
    }
    .postItem>.footer>div{
        display: inline-block;
        margin-right:10px;
        font-size:12px;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            return{
            }
        },
        props:{
            pid:[String,Number],                 //帖子id
            author:String,              //帖子作者
            title:String,               //帖子标题
            updateTime:String,          //最后更新时间
            to:String,                  //帖子跳转路径
            replyNum:[String,Number],            //帖子回复数量
            starNum:[String,Number]              //帖子点赞数量
        },
        methods:{
            goPath(name){
                let section=this.$route.path.split('/')[2];
                let pid=this.pid;
                router.push({
                    name:name,
                    params:{
                        section:section,
                        pid:pid
                    }
                });
            }
        }
    }
</script>
