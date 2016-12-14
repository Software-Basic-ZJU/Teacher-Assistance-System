<!-- 单个帖子组件 -->

<template>
    <div>
        <div>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'forum'}">讨论区</el-breadcrumb-item>
                <el-breadcrumb-item :to="{path:'/forum/'+$route.params.section}">{{secName}}</el-breadcrumb-item>
                <el-breadcrumb-item>帖子详情</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
        <div class="hostPost">
            <div class="header">
                <div class="title">主题：{{hostPost.title}}</div>
                <span class="author">{{hostPost.author_name}}</span>
            </div>
            <div class="main">
                <div class="content">{{hostPost.content}}</div>
                <div class="resource" v-if="hostPost.resrcId">
                    <a :href="hostPost.resource.path" download="hostPost.resource.name">
                        {{hostPost.resource.name}}
                    </a>
                </div>
            </div>
            <div class="footer">
                <el-button size="small" @click="showReply">{{replyBtn}}</el-button>
                <el-button v-if="isAuthor" type="warning" icon="edit" :plain="true" size="small" @click="goEditPost($route.params.pid)"></el-button>
                <el-button v-if="isAuthor" type="danger" icon="delete" :plain="true" size="small" @click="removePost($route.params.pid)"></el-button>
                <span class="time fr">发表于：{{hostPost.update_time}}</span>
                <span class="time fr">最后更新：{{hostPost.update_time}}</span>
            </div>
            <div class="replyForm" v-show="isReplyShow">
                <el-form :model="newReply">
                    <el-form-item label="回帖内容">
                        <el-input type="textarea" v-model="newReply.content"></el-input>
                    </el-form-item>
                    <el-button type="primary" :loading="postLoading" @click="addRepost($route.params.pid)">回复</el-button>
                </el-form>
            </div>
        </div>
        <div class="replyPost" v-loading.body="replyLoading">
            <h3>所有回复</h3>
            <div class="noRes" v-if="hostPost.repostList && !hostPost.repostList.length">还没有回贴~</div>
            <reply-post
                    v-for="item in hostPost.repostList"
                    :key="item.repost_id"
                    :rpid="item.repost_id"
                    :author-id="item.author_id"
                    :author-name="item.author_name"
                    :time="item.time"
                    :content="item.content"
                    :replyNum="item.commentList.length"
                    :comment-list="item.commentList"
            ></reply-post>
        </div>
    </div>
</template>
<style scoped>
    .el-breadcrumb{
        margin-top:10px;
    }
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
        color:#6ECADC;
    }
    .hostPost>.main{
        padding:10px 0px;
    }
    .hostPost>.main .resource{
        margin-top:10px;
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

    .replyForm{
        margin-top:10px;
    }
    .replyForm .el-button{
        margin-top:-10px;
    }
    .replyPost>h3{
        color:#475669;
    }

</style>
<script>
    import router from "../../../routes";
    import replyPost from "./replyPost.vue";
    import {mapState} from "vuex";
    import {LS} from "../../../helpers/utils";

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
            this.$store.dispatch('getPostDetail',this.$route.params.pid);
            this.$store.dispatch('getReplyPost',this.$route.params.pid);
            return{
                secName:section,
                newReply:{
                    content:''
                },
                replyBtn:'回复'
            }
        },
        computed:{
            ...mapState({
                hostPost:state=>state.forum.currPost,
                isReplyShow:state=>state.forum.isReplyShow,
                replyLoading:state=>state.forum.replyPostLoading,
                postLoading:state=>state.forum.loading,
            }),
            isAuthor(){
                let userInfo=LS.getItem('userInfo');
                return userInfo.id==this.hostPost.author_id;
            },
            replyBtn(){
                return this.isReplyShow?'取消':'回复'
            }
        },
        methods:{
            goEditPost(pid){
                let section=this.$route.params.section;
                router.push({name:'editPost',params:{section:section,pid:pid}})
            },
            removePost(pid){
                this.$confirm('确认删除该帖子吗?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('removePost',{
                        postId:pid,
                        section:this.$route.params.section
                    })
                }).catch(() => {});
            },
            addRepost(pid){
                this.newReply.postId=pid;
                this.$store.dispatch('addReplyPost',this.newReply);
            },
            showReply(){
                this.$store.dispatch('isReplyShow',!this.isReplyShow);
            }
        },
        components:{
            replyPost
        }
    }
</script>
