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
                    <el-button type="primary" @click="login" @key.enter="login">登录</el-button>
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
</style>
<script>
    export default{
        data(){
            return{
                loginForm:{
                    id:'',
                    password:''
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
