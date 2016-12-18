<template>
    <div>
        <div class="notice">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'notices'}">通知</el-breadcrumb-item>
                    <el-breadcrumb-item>{{notice.title}} <el-tag :class="{'important':notice.level==1}">{{notice.level==1?'重要通知':'普通通知'}}</el-tag>
                    </el-breadcrumb-item>
                </el-breadcrumb>
                <div class="btnGroup fr"  v-if="idenType==2">
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
                <Editor method="editNotice" btn-name="确认更改" :has-level="true" :data="notice"></Editor>
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
    .el-tag{
        margin-left:10px;
    }
    .el-tag.important{
        background-color:#FF4949;
        border-color:#FF4949;
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
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            this.$store.dispatch('getNotice',this.$route.params.nid);
            return{
                idenType:userInfo.type
            }
        },
        computed:{
            ...mapState({
                showEditNotice:state=>state.info.showEditNotice,
                notice(state){
                    let notice=state.info.notice;
                    notice.level=notice.level==0?false:true;
                    return notice;
                }
            })
        },
        methods:{
            toggleEditNotice(signal){
                this.$store.dispatch('toggleEditNotice',signal);
            },
            remove(){
                this.$confirm('确认要删除该文章吗？','提示',{
                        confirmButtonText:'确认删除',
                        cancelButtonText:'取消',
                        type:'warning'
                    }).then(()=>{
                        this.$store.dispatch('removeNotice',this.$route.params.nid);
                }).catch(()=>{});
            }
        },
        components:{
            Editor
        }
    }
</script>
