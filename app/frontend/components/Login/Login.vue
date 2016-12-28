<template>
    <div>
        <div>
            <div class="loginBox">
                <h2>教学辅助系统</h2>
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
    .loginBox{
        width:400px;
        margin:20px auto;
    }
    .loginBox>h2{
        text-align: center;
    }
    .el-radio-group{
        margin-top:5px;
    }
    .el-button--primary{
        margin-top:20px;
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
