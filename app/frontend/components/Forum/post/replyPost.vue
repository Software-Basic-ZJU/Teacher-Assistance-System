<template>
    <div>
        <div class="post">
            <div class="header">
                <span class="author">{{authorName}}</span>
            </div>
            <div class="main">
                <div class="content">{{content}}</div>
            </div>
            <div class="footer">
                <span class="time fl">{{time}}</span>
                <i class="iconfont icon-delete fr" @click="removeRepost(rpid)" v-if="authorId==id || idenType==2"></i>
                <comment-list
                        add-method="addPostComment"
                        remove-method="removePostComment"
                        :rpid="rpid"
                        :comment-list="commentList"
                        :reply-num="replyNum"
                >
                </comment-list>
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
    .post>.main{
        padding:10px 0px;
        font-size:14px;
    }
    .post>.footer{
        padding-top:5px;
        font-size:14px;
        text-align: right;
    }
    .post>.footer>.time{
        font-size:12px;
        color:#8492A6;
    }
    .post>.footer>.iconfont{
        font-size:18px;
        cursor:pointer;
        margin-top:-2px;
    }
</style>
<script>
    import commentList from "./comment/commentList.vue";
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            return{
                isComListShow:false,
                id:userInfo.id,
                idenType:userInfo.type
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
            removeRepost(rpid){
                this.$confirm('确认删除该回帖吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('removeRepost',rpid);
                }).catch(() => {});
            }
        },
        components:{
            commentList
        }
    }
</script>
