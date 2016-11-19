<!-- 单个帖子组件 -->

<template>
    <div>
        <div>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'forum'}">讨论区</el-breadcrumb-item>
                <el-breadcrumb-item :to="{path:'/forum/'+$route.params.section}">{{secName}}</el-breadcrumb-item>
                <el-breadcrumb-item>主题详情</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="hostPost">
            <div class="header">
                <div class="title">主题：{{hostPost.title}}</div>
                <span class="author">{{hostPost.author}}</span>
            </div>
            <div class="main">
                <div class="content">{{hostPost.content}}</div>
            </div>
            <div class="footer">
                <el-button type="primary" size="small">回复</el-button>
                <el-button size="small" @click="goEditPost($route.params.pid)">编辑</el-button>
                <span class="time fr">发表于：{{hostPost.updateTime}}</span>
                <span class="time fr">最后更新：{{hostPost.updateTime}}</span>
            </div>
        </div>
        <div class="replyPost">
            <h3>所有回复</h3>
            <reply-post
                    v-for="item in posts"
                    :key="item.rpid"
                    :rpid="item.rpid"
                    :author="item.author"
                    :time="item.time"
                    :content="item.content"
                    :replyNum="item.replyNum"
            ></reply-post>
        </div>
    </div>
</template>
<style scoped>
    .hostPost{
        padding:10px 15px;
        border-bottom:1px solid #E5E9F2;
    }
    .hostPost>.header{
        padding:10px 0px;
        font-size:14px;
    }
    .hostPost>.header>.title{
        font-size:14px;
        color:#475669;
        margin-bottom:5px;
    }
    .hostPost>.header>.author{
        color:#1D8CE0;
    }
    .hostPost>.main{
        padding:10px 0px;
    }
    .hostPost>.footer{
        padding-top:5px;
        font-size:14px;
    }
    .hostPost>.footer>.el-button{
        margin-top:10px;
    }
    .hostPost>.footer>div{
        margin-right:10px;
        margin-top:20px;
        font-size:12px;
    }
    .hostPost>.footer i{
        cursor:pointer;
    }
    .hostPost>.footer>.time{
        margin-top: 20px;
        margin-left:50px;
        font-size:12px;
        color:#8492A6;
    }
    .replyPost{
        margin-top:0px;
    }
    .replyPost>h3{
        color:#475669;
    }
</style>
<script>
    import router from "../../../../routes";
    import replyPost from "./replyPost.vue";
    export default{
        data(){
            let section=this.$route.params.section;
            switch(section){
                case "teacherQA":
                    section="教师答疑区";
                    break;
                case "public":
                    section="公共讨论区";
                    break;
                case "group":
                    section="小组讨论区";
                    break;
                default:
                    router.push({name:'forum'});
                    break;
            }
            return{
                secName:section,
                hostPost:{
                    pid:1,
                    author:'LowesYang',
                    title:'为什么我这么有钱?',
                    content:'I love you.',
                    publishTime:'2016-10-02',
                    updateTime:'2016-11-02'
                },
                posts:[
                    {
                        rpid:1,
                        content:'Test postTest postTest hostPost',
                        author:'LowesYang',
                        time:'2016-11-03',
                        replyNum:10
                    },
                    {
                        rpid:2,
                        content:'Test postTest postTest hostPost',
                        author:'LowesYang',
                        time:'2016-11-03',
                        replyNum:10
                    },
                ]
            }
        },
        methods:{
            goEditPost(pid){
                let section=this.$route.params.section;
                router.push({name:'editPost',params:{section:section,pid:pid}})
            }
        },
        components:{
            replyPost
        }
    }
</script>
