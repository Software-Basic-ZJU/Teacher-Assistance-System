<template>
    <div>
        <div class="editPswd">
            <el-steps class="fl" :space="100" :active="active" finish-status="success" direction="vertical">
                <el-step v-for="step in steps" :title="step"></el-step>
            </el-steps>
            <div class="actionBox fr" >

                <!-- 回答问题或使用邮箱修改-->
                <div class="firstStep" v-if="active==0">
                    <el-form label-width="80px" ref="idenForm" :model="idenForm" :rules="rules">
                        <div @click="activateForm(false)">
                            <el-form-item label="问题">
                                <el-select v-model="idenForm.question" placeholder="请选择问题" :disabled="actionType">
                                    <el-option selected :label="userInfo.question1" :value="userInfo.question1"></el-option>
                                    <el-option :label="userInfo.question2" :value="userInfo.question2"></el-option>
                                </el-select>
                            </el-form-item>
                            <el-form-item label="答案" prop="answer">
                                <el-input v-model="idenForm.answer" placeholder="您的答案" :disabled="actionType"></el-input>
                            </el-form-item>
                        </div>
                        <div class="notice">您也可以使用邮箱获取验证码</div>
                        <div @click="activateForm(true)">
                            <el-form-item label="邮箱" prop="email">
                                <el-input class="emailInput fl" v-model="idenForm.email" placeholder="邮箱" :disabled="!actionType"></el-input>
                                <el-button class="fr" :disabled="!actionType" @click="getEmail">获取</el-button>
                            </el-form-item>
                            <el-form-item label="验证码" prop="idenCode">
                                <el-input v-model="idenForm.idenCode" placeholder="验证码" :disabled="!actionType"></el-input>
                            </el-form-item>
                        </div>
                        <el-form-item>
                            <el-button @click="firstSubmit">下一步</el-button>
                        </el-form-item>
                    </el-form>
                </div>
                <div class="secondStep" v-if="active==1">
                    <el-form label-width="80px">
                        <el-form-item>
                            <el-button @click="">下一步</el-button>
                            <el-button @click="">上一步</el-button>
                        </el-form-item>
                    </el-form>
                </div>
                <div class="finalStep" v-if="active==2">

                </div>
            </div>
        </div>

    </div>
</template>
<style scoped>
    .editPswd{
        position: absolute;
        margin:auto;
        left:0;
        right:0;
        top:0;
        bottom:0;
        width:600px;
        height:300px;
        padding:10px;
    }
    .actionBox{
        width:450px;
    }
    .actionBox .el-form{
        width:400px;
    }
    .actionBox .notice{
        font-size:12px;
        color:#99A9BF;
        margin-left:40px;
        margin-bottom:10px;
    }
    .actionBox .emailInput{
        width:250px;
    }
</style>
<script>
    export default{
        data(){
            return{
                active:0,
                steps:['验证','修改密码','最后一步'],
                idenForm:{
                    question:'',
                    answer:'',
                    email:'',
                    idenCode:''
                },
                rules:{
                    answer:[
                        {
                            validator:(rule,value,cb)=>{
                                if(!this.actionType && !value){
                                    cb(new Error('请填写答案'))
                                }
                                else cb();
                            },
                            trigger:'blur'
                        }
                    ],
                    email:[
                        {
                            validator:(rule,value,cb)=>{
                                if(this.actionType && !value){
                                    cb(new Error('请填写电子邮箱'))
                                }
                                else cb();
                            },
                            trigger:'blur'
                        }
                    ],
                    idenCode:[
                        {
                            validator:(rule,value,cb)=>{
                                if(this.actionType && !this.idenForm.idenCode){
                                    cb(new Error('请根据邮件填写验证码'))
                                }
                                else cb();
                            },
                            trigger:'blur'
                        }
                    ]
                },
                actionType:false
            }
        },
        computed:{
            userInfo(){
                return this.$store.state.userInfo
            }
        },
        methods:{
            activateForm(signal){
                if(this.actionType!=signal) this.$refs.idenForm.resetFields();
                this.actionType=signal;
            },
            firstSubmit(){
                this.$refs.idenForm.validate((valid)=>{
                    if(valid){
                        this.active=1;
                    }
                })
            },
            getEmail(){
                if(this.actionType && !this.idenForm.email){
                    return this.$message.error('请填写电子邮箱地址!');
                }
            }
        }
    }
</script>
