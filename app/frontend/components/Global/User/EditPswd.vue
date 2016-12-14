<template>
    <div>
        <div>
            <Header></Header>
            <div class="editPswd">
                <el-steps class="fl" :space="100" :active="active" finish-status="success" direction="vertical">
                    <el-step v-for="step in steps" :title="step"></el-step>
                </el-steps>
                <div class="actionBox fr" >

                    <!-- 回答问题或使用邮箱获取验证码-->
                    <div class="firstStep" v-show="active==0">
                        <el-form label-width="80px" ref="idenForm" :model="idenForm" :rules="idenRules">
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

                    <!-- 修改密码 -->
                    <div class="secondStep" v-show="active==1">
                        <el-form label-width="80px" :model="editForm" ref="editForm" :rules="editRules">
                            <el-form-item label="新密码" prop="newPswd">
                                <el-input v-model="editForm.newPswd" type="password"></el-input>
                            </el-form-item>
                            <el-form-item label="确认密码" prop="confirmPswd">
                                <el-input v-model="editForm.confirmPswd" type="password"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button @click="secondSubmit">下一步</el-button>
                                <el-button @click="backStep">上一步</el-button>
                            </el-form-item>
                        </el-form>
                    </div>

                    <!-- 成功与否 -->
                    <div class="result" v-show="active==2">
                        <i class="el-icon-circle-check"> 修改成功</i>
                        <div class="hrefBox">{{countdown}} 秒后自动跳转至登录页面</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .editPswd{
        margin:30px auto;
        width:600px;
        height:300px;
        padding:30px 20px 20px 30px;
        background-color: white;
        -webkit-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
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
    .actionBox .result{
        text-align:center;
        padding-top:40px;
    }
    .actionBox .result>i{
        color:#13CE66;
        font-size:32px;
    }
    .actionBox .result .hrefBox{
        margin-top:15px;
    }
</style>
<script>
    import Header from "../../Header/Header.vue";
    import router from "../../../routes";

    export default{
        data(){
            return{
                countdown:5,
                active:0,
                steps:['验证信息','修改密码','修改结果'],
                idenForm:{
                    question:'',
                    answer:'',
                    email:'',
                    idenCode:''
                },
                idenRules:{
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
                actionType:false,
                editForm:{
                    newPswd:'',
                    confirmPswd:''
                },
                editRules:{
                    newPswd:[
                        {
                            validator:(rule,value,cb)=>{
                                if(!value){
                                    cb(new Error('请输入密码'));
                                }
                                else if(value.length<6 || value.length>20){
                                    cb(new Error('密码长度须在6到20个字符'));
                                }
                                else cb();
                            }
                        }
                    ],
                    confirmPswd:[
                        {
                            validator:(rule,value,cb)=>{
                                if(!value){
                                    cb(new Error('请输入确认密码'));
                                }
                                else if(value && value!=this.editForm.newPswd){
                                    cb(new Error('两次输入密码不一致'));
                                }
                                else cb();
                            }
                        }
                    ]
                }
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
            },
            backStep(){
                this.active--;
            },
            secondSubmit(){
                this.$refs.editForm.validate((valid)=>{
                    if(valid){
                        this.active=2;
                        let stv=setInterval(()=>{
                                    this.countdown--;
                        console.log(this.countdown)
                        if(!this.countdown){
                            clearInterval(stv);
                            //TODO logout
                            router.replace({name:'login'});
                        }
                    },1000);
                    }
                })
            }
        },
        components:{
            Header
        }
    }
</script>
