<template>
    <div>
        <div>
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'forum'}">讨论区</el-breadcrumb-item>
                <el-breadcrumb-item>{{secName}}</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="postList">
                <post-item
                        v-for="item in postList"
                        :pid="item.pid"
                        :author="item.author"
                        :title="item.title"
                        :publish-time="item.publishTime"
                        :update-time="item.updateTime"
                        :reply-num="item.replyNum"
                        :star-num="item.starNum"
                ></post-item>
            </div>
            <el-button type="success" @click="goAddPost">发布主题</el-button>

        </div>
    </div>
</template>
<style scoped>
    .el-button--success{
        margin-top:10px;
    }
</style>
<script>
    import postItem from "./post/postItem.vue";
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
                postList:[
                    {
                        pid:1,
                        title:'Test postTest postTest post',
                        author:'LowesYang',
                        publishTime:'2016-11-03',
                        updateTime:'2016-11-03',
                        replyNum:10,
                        starNum:5
                    },
                    {
                        pid:2,
                        title:'Test postTest postTest post',
                        author:'LowesYang',
                        publishTime:'2016-11-03',
                        updateTime:'2016-11-03',
                        replyNum:10,
                        starNum:5
                    }
                ]
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
