<template>
    <div>
        <div class="comment">
            <div class="header">
                <span class="author">{{authorName}}</span>
                <span class="time">{{time}}</span>
                <i class="el-icon-delete fr" @click="deleteCom(commentId)" v-if="authorId==id"></i>
            </div>
            <div class="content">{{content}}</div>
        </div>
    </div>
</template>
<style scoped>
    .comment{
        width:97%;
        margin:0px auto;
        padding:10px 10px;
        border-bottom:1px solid #E5E9F2;
        font-size:14px;
        -webkit-transition: background-color 0.3s;
        -moz-transition: background-color 0.3s;
        -ms-transition: background-color 0.3s;
        -o-transition: background-color 0.3s;
        transition: background-color 0.3s;
    }
    .comment:hover{
        background-color: #F0F0F0;
    }
    .header{
        margin-bottom:10px;
    }
    .header .author{
        color:#6ECADC;
    }
    .header>.time{
        margin-left:50px;
        color:#8492A6;
    }
    .header>i{
        cursor:pointer;
        margin-top:3px;
        margin-right:10px;
    }
</style>
<script>
    import {LS} from "../../../../helpers/utils";
    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            return {
                id:userInfo.id
            }
        },
        props:{
            commentId:[String,Number],
            authorId:[String,Number],
            authorName:String,
            content:String,
            time:String
        },
        methods:{
            deleteCom(commentId){
                this.$confirm('确认删除该评论吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('removeComment',commentId);
                }).catch(() => {});
            }
        }
    }
</script>
