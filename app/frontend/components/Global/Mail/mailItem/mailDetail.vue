<template>
    <div>
        <div>
            <div class="title">
                {{mail.title}}
            </div>
            <div class="info">
                <span class="srcName" v-if="mail.src_name">from:{{mail.src_name}}</span>
                <span class="destName" v-if="mail.dest_name">to:{{mail.dest_name}}</span>
                <span class="time fr">{{mail.time}}</span>
            </div>
            <div class="content">
                {{mail.content}}
            </div>
            <el-button @click="goBack" size="small">返回信箱</el-button>
            <el-button class="fr" type="primary" @click="replyMail" size="small" v-if="mailType==0">回复</el-button>
            <el-button class="fr" type="danger" :plain="true" @click="removeMail" size="small">删除</el-button>
        </div>
    </div>
</template>
<style scoped>
    .title{
        font-size:16px;
        font-weight:bold;
    }
    .info{
        margin:10px 0;
    }
    .info .time{
        margin-left:30px;;
    }
    .info .srcName{
        margin-right:20px;
    }
    .content{
        height:300px;
        overflow-y: scroll;
        padding:10px;
        background-color: #f7f7f7;
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
        computed:{
            mailType(){
                return this.$store.state.mail.mailListType;
            }
        },
        methods: {
            goBack(){
                this.$store.dispatch('showMailDetail',false);
            },
            replyMail(){
                this.$store.dispatch('replyMail',this.mail);
            },
            removeMail(){
                this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('removeMail',this.mail.mail_id);
                }).catch(() => {});
            }
        }
    }
</script>
