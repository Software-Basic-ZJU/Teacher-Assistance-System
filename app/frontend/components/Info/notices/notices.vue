<template>
    <div>
        <div class="noticeBox">
            <el-button type="success" class="fr" icon="plus" @click="toggleAdd"></el-button>
            <div class="noteItem" v-for="item in noticeList" :key="item.nid" @click.stop="goDetail(item.nid)">
                <i class="iconfont fl" :class="{'icon-tongzhi1':item.level==0,'icon-icon15 serious':item.level==1}"></i>
                <div class="title fl">{{item.title}}</div>
                <div class="time fr">{{item.publishTime}}</div>
                <div class="cl"></div>
            </div>
            <el-dialog title="添加通知" v-model="showAddNotice" @close="toggleAdd">
                <Editor method="addNotice" btn-name="确认添加" :has-level="true"></Editor>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .noteItem{
        width:100%;
        height:30px;
        border-bottom:1px solid #E5E9F2;
        margin-bottom: 20px;
        cursor:pointer;
        -webkit-transition: border-color 0.3s;
        -moz-transition: border-color 0.3s;
        -ms-transition: border-color 0.3s;
        -o-transition: border-color 0.3s;
        transition: border-color 0.3s;
    }
    .noteItem:hover{
        border-color:#58B7FF;
    }
    .noteItem .iconfont{
        font-size:20px;
        margin-top:-2px;
    }
    .noteItem .serious{
        color:#FF4949;
    }
    .noteItem .title{
        margin-left: 10px;
    }
    .noteItem .time{
        margin-right:10px;
    }
    .el-button--success{
        margin-top:-62px;
    }
</style>
<script>
    import router from "../../../routes";
    import Editor from "../../Editor/Editor.vue"
    import {mapState} from "vuex";
    export default{
        data(){
            return{
            }
        },
        computed:mapState({
            noticeList:state=>state.info.noticeList,
            showAddNotice:state=>state.info.showAddNotice
        }),
        methods:{
            goDetail(nid){
                router.push({name:'notice',params:{nid:nid}});
            },
            toggleAdd(){
                this.$store.dispatch('toggleAddNotice');
            }
        },
        components:{
            Editor
        }
    }
</script>
