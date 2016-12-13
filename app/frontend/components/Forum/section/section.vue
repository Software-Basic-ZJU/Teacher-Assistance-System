<template>
    <div>
        <div>
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'forum'}">讨论区</el-breadcrumb-item>
                    <el-breadcrumb-item>{{secName}}</el-breadcrumb-item>
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
            </div>

        </div>
    </div>
</template>
<style scoped>
    .header{
        padding:10px 0px;
    }
    .el-button--success{
        margin-top:-45px;
    }
</style>
<script>
    import postItem from "../post/postItem.vue";
    import router from "../../../routes";
    export default{
        data(){
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
                if(!!1) {    //TODO 如果不是学生且没有选择要看的小组 需要从localStorage中取出
                    this.$message('请在小组名单中选择一个小组进入其讨论区。');
                    router.push({name:'member'});
                }
                section="小组讨论区";
                break;
            default:
                router.push({name:'forum'});
                return;
            }
            this.$store.dispatch('getPostList',secType);
            return{
                secName:section
            }
        },
        computed:{
            postList(){
                return this.$store.state.forum.postList;
            }
        },
        methods:{
            goAddPost(){
                let section=this.$route.params.section;
                router.push({name:'addPost',params:{section:section}});
            }
        },
        components:{
            postItem
        }
    }
</script>
