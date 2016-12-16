<template>
    <div>
        <div @click="showCom" class="replyShowBtn"><i class="iconfont icon-pinglun"></i> ({{replyNum}})</div>
        <div class="commentList" v-show="listShow" v-loading.body="comLoading">
            <div class="commentItem" v-for="item in commentList">
                <div class="content"><span class="authorName">{{item.author_name}}</span>：{{item.content}}</div>
                <div class="footer">
                    <div class="time fl">{{item.time}}</div>
                    <div class="btnGroup fr">
                        <el-button type="text" @click="removeComment(item.com_id,rpid)" v-if="item.author_id==id">删除</el-button>
                        <el-button type="text" @click="replyComment(item.author_name)">回复</el-button>
                    </div>
                </div>
            </div>
            <div class="addComment" v-show="!isAddComShow" @click.stop="showAddCom(true)">+ 添加评论</div>
            <div class="addCommentBox" v-show="isAddComShow">
                <el-input type="textarea" v-model="comment"></el-input>
                <el-button type="text" @click.stop="showAddCom(false)" size="small">取消</el-button>
                <el-button type="primary" @click="submitComment(rpid)" size="small" :loading="addLoading">评论</el-button>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .replyShowBtn{
        display: inline-block;
        margin-right:10px;
        font-size:12px;
        cursor: pointer;
    }
     .commentList{
        width:98%;
        margin-top:10px;
        margin-left:20px;
        border:1px solid #e2e2e2;
        text-align: left;
    }
     .commentItem{
        padding:15px;
        padding-bottom:25px;
        border-bottom:1px solid #f0f0f0;
    }
     .commentItem>.footer{
        margin-top:10px;
        font-size:12px;
    }
     .commentItem>.footer>.btnGroup{
        margin-top:-7px;
    }
     .commentItem .authorName{
        color:#6ECADC;
    }
     .commentList .addCommentBox{
        padding:10px;
        background-color: #f6f6f6;
    }
     .commentList .addComment{
        margin:10px;
        margin-left:20px;
        color:#6ECADC;
        cursor:pointer;
    }
     .commentList .addCommentBox .el-button{
        margin-top:5px;
    }
</style>
<script>
    import {LS} from "../../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            return{
                id:userInfo.id,
                comment:'',
                listShow:false,                 //是否显示评论列表
                isAddComShow:false,              //是否显示添加评论表单
                comLoading:false
            }
        },
        props:{
            addMethod:String,                    //添加评论的action名
            removeMethod:String,                 //删除评论的action名
            rpid:[String,Number],
            commentList:Array,
            replyNum:[String,Number]             //评论数量
        },
        methods:{
            showCom(){
                this.listShow=!this.listShow;
                if(!this.listShow) this.isAddComShow=false;
            },
            showAddCom(signal){
                this.isAddComShow=signal;
                this.comment='';
            },
            removeComment(comId,rpid){
                this.$confirm('确认删除该评论吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.comLoading=true;
                    this.$store.dispatch(this.removeMethod,{
                        comId:comId,
                        repostId:rpid
                    }).then(()=>{
                    this.comLoading=false;
                });
                }).catch(() => {});
            },
            replyComment(authorName){
                this.isAddComShow=true;
                this.comment='回复'+authorName+'：';
            },
            submitComment(repostId){
                if(!this.comment){
                    return this.$message({
                        type:'warning',
                        message:'请输入评论内容'
                    })
                }
                this.comLoading=true;
                this.$store.dispatch(this.addMethod,{
                    repostId:repostId,
                    content:this.comment,
                    type:1
                }).then(()=>{
                    this.comLoading=false;
                    this.isAddComShow=false;
                });
            }
        }
    }
</script>