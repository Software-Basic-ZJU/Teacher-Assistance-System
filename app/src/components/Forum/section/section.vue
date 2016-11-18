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
                        :update-time="item.updateTime"
                        :reply-num="item.replyNum"
                        :star-num="item.starNum"
                ></post-item>
            </div>
            <div class="editor">
                <editor></editor>
            </div>
        </div>
    </div>
</template>
<style>
</style>
<script>
    import postItem from "../post/postItem.vue";
    import editor from "../../Editor/Editor.vue";
    export default{
        data(){
            let section=this.$route.path.split('/')[2];
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
                        updateTime:'2016-11-03',
                        replyNum:10,
                        starNum:5
                    },
                    {
                        pid:2,
                        title:'Test postTest postTest post',
                        author:'LowesYang',
                        updateTime:'2016-11-03',
                        replyNum:10,
                        starNum:5
                    }
                ]
            }
        },
        components:{
            postItem,
            editor
        }
    }
</script>
