<template>
    <div>
        <div>
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'forum'}">讨论区</el-breadcrumb-item>
                    <el-breadcrumb-item>{{secName}}{{secType==2?' - '+groupName:""}}</el-breadcrumb-item>
                </el-breadcrumb>
                <el-button type="success" class="fr" @click="goAddPost">发布主题</el-button>
            </div>
            <div class="noRes" v-if="postList.length==0">还没有帖子~</div>
            <div class="postList">
                <post-item
                        v-for="item in postList"
                        :pid="item.post_id"
                        :author-id="item.author_id"
                        :author-name="item.author_name"
                        :title="item.title"
                        :publish-time="item.publish_time"
                        :update-time="item.update_time"
                        :reply-num="item.reply_num"
                ></post-item>
                <el-pagination
                        small
                        @current-change="changePage"
                        page-size="8"
                        :current-page="currPage"
                        layout="prev,pager,next"
                        :total="postNum"
                ></el-pagination>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .header{
        padding-top:10px;
    }
    .el-button--success{
        margin-top:-45px;
    }
    .el-pagination{
        margin-top:10px;
    }
</style>
<script>
    import postItem from "../post/postItem.vue";
    import router from "../../../routes";
    import {LS} from "../../../helpers/utils";
    import {mapState} from "vuex";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            let section=this.$route.params.section;
            let secType=0;
            switch(section){
                case "teacherQA":
                    secType=0;
                    section="教师答疑区";
                    break;
                case "public":
                    secType=1;
                    section="公共讨论区";
                    break;
                case "group":
                    secType=2;
                    if(userInfo.type!=1) {    //若不是学生且没有选择要看的小组 需要从localStorage中取出
                        if(!userInfo.group_id){
                            let classId=userInfo.type==2?userInfo.class_id[0].class_id:userInfo.class_id;
                            this.$message('请在小组名单中选择一个小组进入其讨论区');
                            router.push({name:'member',params:{cid:classId}});
                            return {};
                        }
                    }
                    else if(userInfo.group_id==-1 || !userInfo.group_id){
                        this.$message('您还没有加入小组,请先创建或加入一个小组');
                        router.push({name:'member',params:{cid:userInfo.class_id}});
                        return {};
                    }
                    section="小组讨论区";
                    break;
                default:
                    router.push({name:'forum'});
                    return {};
            }
            this.$store.dispatch('getPostList',secType);
            return{
                secName:section,
                secType:secType
            }
        },
        computed:{
            postList(){
                return this.$store.getters.postList;
            },
            ...mapState({
                currPage:state=>state.forum.currPage,
                postNum:state=>state.forum.postList.length,
                groupName:state=>state.forum.groupName
            })
        },
        methods:{
            goAddPost(){
                let section=this.$route.params.section;
                router.push({name:'addPost',params:{section:section}});
            },
            changePage(val){
                this.$store.dispatch('changePostPage',val);
            }
        },
        components:{
            postItem
        }
    }
</script>
