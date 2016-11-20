<template>
    <div>
        <div class="notice">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'notices'}">通知</el-breadcrumb-item>
                    <el-breadcrumb-item>{{notice.title}}</el-breadcrumb-item>
                </el-breadcrumb>
                <el-button type="success" class="fr" @click="toggleEdit">编辑</el-button>
            </div>
            <div class="main">
                <div class="header">
                    <div class="title">{{notice.title}}</div>
                    <span class="author">{{notice.author}}</span>
                    <span class="time">{{notice.publishTime}}</span>
                </div>
                <div class="content">{{notice.content}}</div>
            </div>
            <el-dialog title="编辑通知" v-model="showEditNotice" @close="toggleEdit">
                <Editor method="editNotice" btn-name="确认更改" :data="notice"></Editor>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .notice{
        padding:0 10px;
    }
    .header{
        padding-top:10px;
    }
    .el-button--success{
        margin-top:-45px;
    }
    .main{
        padding:20px;
    }
</style>
<script>
    import Editor from "../../Editor/Editor.vue";
    export default{
        data(){
            return{
            }
        },
        computed:{
            notice(){
                let list=this.$store.state.info.noticeList;
                for(let i=0;i<list.length;i++){
                    if(list[i].nid==this.$route.params.nid){
                        return list[i];
                    }
                }
            },
            showEditNotice(){
                return this.$store.state.info.showEditNotice
            }
        },
        methods:{
            toggleEdit(){
                this.$store.dispatch('toggleEditNotice');
            }
        },
        components:{
            Editor
        }
    }
</script>
