<template>
    <div>
        <div>
            <div class="title">
                {{mail.title}}
            </div>
            <div class="info">
                <span class="srcName" v-if="mail.srcName">from：{{mail.srcName}}</span>
                <span class="destName" v-if="mail.destName">to：{{mail.destName}}</span>
                <span class="time fr">{{mail.time}}</span>
            </div>
            <div class="content">
                {{mail.content}}
            </div>
            <el-button @click="goBack" size="small">返回信箱</el-button>
            <el-button type="primary" @click="replyMail" size="small">回复</el-button>
        </div>
    </div>
</template>
<style scoped>
    .title{
        font-size:16px;
        font-weight:bold;
    }
    .info{
        margin:5px 0;
    }
    .content{
        height:320px;
        overflow-y: scroll;
        padding:10px;
        background-color: #F9FAFC;
    }
    .el-button{
        margin-top:10px;
    }
</style>
<script>
    import {mapActions} from "vuex";
    export default{
        props:{
            mail:Object
        },
        methods: {
            goBack(){
                this.$store.dispatch('showMailDetail',false);
            },
            replyMail(){
                this.$store.dispatch('replyMail',this.mail);
            }
        }
    }
</script>
