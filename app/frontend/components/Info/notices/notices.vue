<template>
    <div>
        <div class="noticeBox">
            <el-button type="success" class="fr" icon="plus" @click="toggleAddNotice(true)" v-if="idenType==2"></el-button>
            <div class="noteItem" v-for="item in noticeList" :key="item.notice_id" @click.stop="goDetail(item.notice_id)">
                <i class="iconfont fl" :class="{'icon-tongzhi1':item.level==0,'icon-icon15 serious':item.level==1}"></i>
                <div class="title fl">{{item.title}}</div>
                <div class="time fr">{{item.time}}</div>
                <div class="cl"></div>
            </div>
            <el-pagination
                    small
                    @current-change="changePage"
                    page-size="15"
                    :current-page="currPage"
                    layout="prev,pager,next"
                    :total="noticeNum"
            ></el-pagination>
            <el-dialog title="添加通知" v-model="showAddNotice" @close="toggleAddNotice(false)">
                <Editor method="addNotice" btn-name="确认添加" :has-level="true" :class-choice="true"></Editor>
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
        border-color:#6ECADC;
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
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            this.$store.dispatch('getNoticeList');
            return{
            }
        },
        computed:{
            ...mapState({
                showAddNotice:state =>state.info.showAddNotice,
                idenType:state =>state.userInfo.type,
                noticeNum:state=>state.info.noticeList.length,
                currPage:state=>state.info.noticeCurrPage
            }),
            noticeList(){
                return this.$store.getters.noticeList
            }
        },
        methods:{
            goDetail(nid){
                router.push({name:'notice',params:{nid:nid}});
            },
            toggleAddNotice(signal){
                this.$store.dispatch('toggleAddNotice',signal);
            },
            changePage(val){
                this.$store.dispatch('changeNotePage',val);
            }
        },
        components:{
            Editor
        }
    }
</script>
