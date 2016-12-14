<template>
    <div>
        <div class="comment">
            <div class="header">
                <span class="author">{{authorName}}</span>
                <span class="time">{{time}}</span>
                <i class="el-icon-delete fr" @click="delete(commentId)"></i>
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
    export default{
        props:{
            commentId:[String,Number],
            authorId:[String,Number],
            authorName:String,
            content:String,
            time:String
        },
        methods:{
            delete(commentId){
                this.$store.dispatch('deleteComment',commentId);
            }
        }
    }
</script>
