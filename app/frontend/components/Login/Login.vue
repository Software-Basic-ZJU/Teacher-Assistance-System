<template>
    <div class="box">
        <div class="title">教学辅助管理系统@软件工程</div>
        <div class="container">
            <div class="loginBox fr">
                <h2>登录</h2>
                <el-form ref="loginForm" :model="loginForm" :rules="rules" @keyup.enter="login">
                    <el-form-item label="教工号/学号" prop="id">
                        <el-input v-model="loginForm.id" placeholder="教工号/学号"></el-input>
                    </el-form-item>
                    <el-form-item label="密码" prop="password">
                        <el-input v-model="loginForm.password" type="password" placeholder="密码"></el-input>
                    </el-form-item>
                    <el-radio-group v-model="loginForm.idenType">
                        <el-radio :label="1">学生</el-radio>
                        <el-radio :label="2">老师</el-radio>
                        <el-radio :label="3">助教</el-radio>
                    </el-radio-group>
                    <el-form-item>
                        <el-button type="primary" @click="login" :loading="isLoading">登录</el-button>
                        <a href="/"><el-button>返回首页</el-button></a>
                        <router-link to="/findPswd"><el-button type="text">忘记密码</el-button></router-link>
                    </el-form-item>
                </el-form>
            </div>
            <el-dialog
                    title="第一次登陆，请完善个人信息"
                    v-model="showCompleteInfo"
                    @close="closeDialog"
                    :show-close="false"
                    :close-on-click-modal="false"
                    :close-on-press-escape="false"
            >
                <Complete-info></Complete-info>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .box{
        position:relative;
        min-height:600px;
        height:100vh;
    }
    .box .title{
        font-size:32px;
        padding-left:20px;
        padding-top:calc(3.1vh - 10px);
    }
    @media screen and (min-height: 1200px){
        .box .title{
            font-size:36px;
        }
    }
    .container{
        position: absolute;
        min-width:960px;
        width:100%;
        height:82%;
        margin:auto;
        top:0;
        bottom:0;
        background:url("./static/background.png") center center no-repeat;
        background-size:cover;
    }
    .loginBox{
        position:absolute;
        margin:auto;
        bottom:0;
        top:0;
        right:100px;
        background-color:white;
        padding:10px 30px;
        width:350px;
        height:400px;
        opacity:0.95;
        -webkit-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
    }
    .loginBox>h2{
        text-align: center;
    }
    .el-radio-group{
        margin-top:5px;
    }
    .el-button--primary{
        margin-top:20px;
        margin-right:10px;
    }
    .el-button--text{
        margin-left:10px;
    }
</style>
<script>
    import CompleteInfo from "./CompleteInfo.vue";
    import {mapState} from "vuex";
    import {LS} from "../../helpers/utils";
    import router from "../../routes";
    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            if(userInfo && userInfo.token){
                this.$message('欢迎回来！');
                router.push({name:'App'});
            }
            return{
                loginForm:{
                    id:'',
                    password:'',
                    idenType:1
                },
                rules:{
                    id:[
                        {
                            required:true,
                            message:'请输入教工号或学号',
                            trigger:'change'
                        }
                    ],
                    password:[
                        {
                            required:true,
                            message:'请输入密码',
                            trigger:'change'
                        }
                    ]
                }
            }
        },
        computed:{
            ...mapState({
                showCompleteInfo:state=>state.showCompleteInfo,
                isLoading:state=>state.loading
            })
        },
        methods:{
            login(){
                this.$refs.loginForm.validate((valid)=>{
                    if(valid){
                        this.$store.dispatch('login',this.loginForm);
                    }
                    else return false;
                })
            },
            closeDialog(){
                this.$store.dispatch('showCompleteInfo',false);
            }
        },
        components:{
            CompleteInfo
        },
        head:{
            title(){
                return {
                    inner:'登录'
                }
            }
        }
    }
</script>
