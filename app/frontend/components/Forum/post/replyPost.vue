<template>
    <div>
        <div class="post">
            <div class="header">
                <span class="author">{{authorName}}</span>
                <span class="time">发表于：{{time}}</span>
            </div>
            <div class="main">
                <div class="content">{{content}}</div>
            </div>
            <div class="footer">
                <div @click="showCom" class="replyShowBtn"><i class="iconfont icon-pinglun"></i> ({{replyNum}})</div>
                <div class="commentList" v-if="isComListShow">
                    <div class="commentItem" v-for="item in commentList">
                        <div class="info">
                            <div class="author">{{item.author_name}}</div>
                            <div class="content">{{item.content}}</div>
                        </div>
                        <div class="footer">
                            <div class="time fl">{{item.time}}</div>
                            <div class="btnGroup fr">
                                <el-button type="text" @click="removeComment" v-if="item.author_id==id">删除</el-button>
                                <el-button type="text" @click="replyComment">回复</el-button>
                            </div>
                        </div>
                    </div>
                    <div class="addComment" v-if="!isAddComShow" @click="showAddCom(true)">添加评论</div>
                    <div class="addCommentBox" v-if="isAddComShow">
                        <el-input type="textarea" v-model="comment"></el-input>
                        <el-button type="text" @click="showAddCom(false)" size="small">取消</el-button>
                        <el-button type="primary" @click="submitCom" size="small">评论</el-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .post{
        padding:10px 15px;
        border-bottom:1px solid #E5E9F2;
    }
    .post>.header{
        padding:10px 0px;
        font-size:14px;
    }
    .post>.header>.author{
        color:#6ECADC;
    }
    .post>.header>.time{
        margin-left: 50px;
        font-size:12px;
        color:#8492A6;
    }
    .post>.main{
        padding:10px 0px;
        font-size:14px;
    }
    .post>.footer{
        padding-top:5px;
        font-size:14px;
        text-align: right;
    }
    .post>.footer>.replyShowBtn{
        display: inline-block;
        margin-right:10px;
        font-size:12px;
    }
    .post>.footer i{
        cursor:pointer;
    }
    .post>.footer .commentList{
        width:95%;
        margin-top:10px;
        margin-left:20px;
        border:1px solid #e2e2e2;
    }
    .post>.footer .commentList .addCommentBox{
        padding:10px;
        background-color: #f6f6f6;
    }
    .post>.footer .commentList .addCommentBox .el-button{
        margin-top:5px;
    }
    .post .commentList{

    }
</style>
<script>
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            return{
                id:userInfo.id,
                comment:'',
                isComListShow:false,            //是否显示评论列表
                isAddComShow:false              //是否显示添加评论表单
            }
        },
        props:{
            rpid:[String,Number],
            authorId:[String,Number],
            authorName:[String],
            content:String,
            time:String,                         //发表时间
            replyNum:[String,Number],            //评论数量
            commentList:Array
        },
        methods:{
            showCom(){
                this.isComListShow=!this.isComListShow;
            },
            showAddCom(signal){
                this.isAddComShow=signal;
            },
            removeComment(){
            },
            replyComment(){

            }
        }
    }
</script>
