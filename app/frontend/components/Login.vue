<template>
    <div>
        <div>
            <div class="loginBox">
                <h2>久违了,老司机</h2>
                <el-form ref="loginForm" :model="loginForm" :rules="rules">
                    <el-form-item label="教工号/学号" prop="id">
                        <el-input v-model="loginForm.id" placeholder="教工号/学号"></el-input>
                    </el-form-item>
                    <el-form-item label="密码" prop="password">
                        <el-input v-model="loginForm.password" type="password" placeholder="密码"></el-input>
                    </el-form-item>
                    <el-radio-group v-model="loginForm.idenType">
                        <el-radio :label="0">学生</el-radio>
                        <el-radio :label="1">老师</el-radio>
                        <el-radio :label="2">助教</el-radio>
                    </el-radio-group>
                    <el-form-item>
                        <el-button type="primary" @click="login" @key.enter="login">登录</el-button>
                        <el-button>返回首页</el-button>
                    </el-form-item>
                </el-form>
            </div>
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
</style>
<script>
    export default{
        data(){
            return{
                loginForm:{
                    id:'',
                    password:'',
                    idenType:0
                },
                rules:{
                    id:[
                        {
                            required:true,
                            message:'请输入教工号或学号',
                            trigger:'blur'
                        }
                    ],
                    password:[
                        {
                            required:true,
                            message:'请输入密码',
                            trigger:'blur'
                        }
                    ]
                }
            }
        },
        methods:{
            login(){
                this.$refs.loginForm.validate((valid)=>{
                    if(valid){
                        this.$store.dispatch('login',this.loginForm);
                    }
                    else return false;
                })
            }
        }
    }
</script>
