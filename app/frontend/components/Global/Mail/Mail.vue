<template>
    <div>
        <div class="mainBox" v-loading.body="loading">
            <div class="leftBox fl">
                <el-menu
                        :default-active="currIndex"
                        class="el-menu-vertical-demo"
                        @select="selectPage">
                    <el-menu-item index="1">收件箱</el-menu-item>
                    <el-menu-item index="2">已发送</el-menu-item>
                    <el-menu-item index="3">发送信件</el-menu-item>
                </el-menu>
            </div>
            <div class="rightBox">
                <div class="main">
                    <div v-if="!toSend">
                        <div class="mailList">
                            <mail-item
                                    v-for="item in mailList"
                                    :mail-id="item.mid"
                                    :is-read="item.isRead"
                                    :sender="item.sender"
                                    :title="item.title"
                                    :datetime="item.datetime"
                            ></mail-item>
                        </div>
                        <el-pagination
                                small
                                layout="prev,pager,next"
                                :total="100"
                                class="fr"
                        ></el-pagination>
                    </div>
                    <div v-else>
                        <el-form :model="mailForm" ref="mailForm" :rules="rules">
                            <el-form-item label="收件人" prop="destId">
                                <el-input v-model="mailForm.destId" placeholder="教工号/学号"></el-input>
                            </el-form-item>
                            <el-form-item label="标题 (最多50个字符)" prop="title">
                                <el-input v-model="mailForm.title" placeholder="信件标题"></el-input>
                            </el-form-item>
                            <el-form-item label="内容 (最多500个字符)" prop="content">
                                <el-input type="textarea" placeholder="写点话吧..." v-model="mailForm.content"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="sendMail">发送</el-button>
                                <el-button @click="reset">清空</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </div>
            <div class="cl"></div>
        </div>
    </div>
</template>
<style scoped>
    .mainBox .leftBox{
        width:140px;
    }
    .mainBox .rightBox{
        padding-left:160px;

    }
    .mainBox .rightBox .main{
        width:100%;
        height:410px;
    }
    .mainBox .mailList{
        height:380px;
    }
</style>
<script>
    import mailItem from "./mailItem/mailItem.vue";
    import {mapState} from "vuex";
    export default{
        data(){
            return{
                currIndex:'1',
                toSend:false,
                mailForm:{
                    destId:'',
                    title:'',
                    content:''
                },
                rules:{
                    destId:[
                        {
                            required:true,
                            message:'请输入收件人id!',
                            trigger:'blur'
                        },
                        {
                            max:40,
                            message:'收件人id太长了...',
                            trigger:'blur'
                        }
                    ],
                    title:[
                        {
                            required:true,
                            message:'请输入信件标题!',
                            trigger:'blur'
                        },
                        {
                            max:50,
                            message:'字数请限制在50个字符内',
                            trigger:'blur'
                        }
                    ],
                    content:[
                        {
                            required:true,
                            message:'请输入信件内容!',
                            trigger:'blur'
                        },
                        {
                            max:500,
                            message:'字数请限制在1000个字符内',
                            trigger:'blur'
                        }
                    ]
                }
            }
        },
        computed:{
            ...mapState({
                loading:state=>state.mail.loading
            }),
            mailList(){
                return this.$store.getters.mailList
            }
        },
        methods:{
            selectPage(index){
                switch(index){
                    case '1':
                        this.toSend=false;
                        this.$store.dispatch('updateMailType',0);
                        break;
                    case '2':
                        this.toSend=false;
                        this.$store.dispatch('updateMailType',1);
                        break;
                    case '3':
                        this.toSend=true;
                        break;
                    default:break;
                }
            },
            sendMail(){
                this.$refs.mailForm.validate((valid)=>{
                    if(valid){
                        console.log(this.mailForm);
                    }
                })
            },
            reset(){
                this.mailForm={
                    destId:'',
                    title:'',
                    content:''
                }
            }
        },
        components:{
            mailItem
        }
    }
</script>
