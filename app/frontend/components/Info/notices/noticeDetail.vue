<template>
    <div>
        <div class="notice">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'notices'}">通知</el-breadcrumb-item>
                    <el-breadcrumb-item>{{notice.title}}</el-breadcrumb-item>
                </el-breadcrumb>
                <div class="btnGroup fr">
                    <el-button
                            type="danger"
                            icon="delete"
                            :plain="true"
                            @click="remove"
                    ></el-button>
                    <el-button
                        type="success"
                        icon="edit"
                        @click="toggleEditNotice(true)"
                    ></el-button>
                </div>
            </div>
            <div class="main">
                <div class="header">
                    <div class="title">{{notice.title}}</div>
                    <div class="time">{{notice.time}}</div>
                </div>
                <div class="content" v-html="notice.content"></div>
            </div>
            <el-dialog title="编辑通知" v-model="showEditNotice" @close="toggleEditNotice(false)">
                <Editor method="editNotice" btn-name="确认更改" :has-level="true" :data="Object.assign({},notice)"></Editor>
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
    .btnGroup{
        margin-top:-45px;
    }
    .main{
        padding:20px;
    }
    .main>.header{
        text-align: center;
    }
    .main>.header .title{
        font-size:20px;
    }
    .main>.header .time{
        margin-top:10px;
        font-size:14px;
    }
    .main .content{
        margin-top:10px;
    }
</style>
<script>
    import Editor from "../../Editor/Editor.vue";
    import {mapState} from "vuex";
    export default{
        data(){
            this.$store.dispatch('getNotice',this.$route.params.nid);
            return{
            }
        },
        computed:{
            ...mapState({
                showEditNotice:state=>state.info.showEditNotice,
                notice:state=>state.info.notice
            })
        },
        methods:{
            toggleEditNotice(signal){
                this.$store.dispatch('toggleEditNotice',signal);
            },
            remove(){
                this.$store.dispatch('removeNotice',this.$route.params.nid);
            }
        },
        components:{
            Editor
        }
    }
</script>
