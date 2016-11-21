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
            <div class="postList">
                <post-item
                        v-for="item in postList"
                        :pid="item.pid"
                        :author="item.author"
                        :title="item.title"
                        :publish-time="item.publishTime"
                        :update-time="item.updateTime"
                        :reply-num="item.replyNum"
                ></post-item>
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
</style>
<script>
    import postItem from "../post/postItem.vue";
    import router from "../../../routes";
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
