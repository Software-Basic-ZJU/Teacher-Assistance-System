<template>
    <div>
        <div>
            <Header></Header>
            <div class="editPswd">
                <el-steps class="fl" :space="100" :active="active" finish-status="success" direction="vertical">
                    <el-step v-for="step in steps" :title="step"></el-step>
                </el-steps>
                <div class="actionBox fr" >
                    <div class="firstStep" v-show="active==0">
                        <el-form>
                            <el-form-item label="学号/教工号">
                                <el-input v-model="userId" place-holder="学号/教工号"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="firstSubmit" :loading="formLoading">下一步</el-button>
                            </el-form-item>
                        </el-form>
                    </div>

                    <!-- 回答问题或使用邮箱获取验证码-->
                    <div class="secondStep" v-show="active==1">
                        <el-form label-width="80px" ref="idenForm" :model="idenForm" :rules="idenRules">
                            <div @click="activateForm(false)">
                                <el-form-item label="问题">
                                    <el-select v-model="idenForm.question" placeholder="请选择问题" :disabled="actionType || userInfo.type!=1">
                                        <el-option selected :label="userInfo.question1" :value="userInfo.question1"></el-option>
                                        <el-option :label="userInfo.question2" :value="userInfo.question2"></el-option>
                                    </el-select>
                                </el-form-item>
                                <el-form-item label="答案" prop="answer">
                                    <el-input v-model="idenForm.answer" placeholder="您的答案" :disabled="actionType || userInfo.type!=1"></el-input>
                                </el-form-item>
                            </div>
                            <div class="notice">您也可以使用邮箱获取验证码</div>
                            <div @click="activateForm(true)">
                                <el-form-item label="邮箱" prop="email">
                                    <el-input class="emailInput fl" v-model="idenForm.email" placeholder="邮箱" :disabled="!actionType || userInfo.type==2"></el-input>
                                    <el-button class="fr" :disabled="!actionType" @click="getEmail">获取</el-button>
                                    <div class="cl"></div>
                                </el-form-item>
                                <el-form-item label="验证码" prop="idenCode">
                                    <el-input v-model="idenForm.idenCode" placeholder="验证码" :disabled="!actionType || userInfo.type==2"></el-input>
                                </el-form-item>
                            </div>
                            <el-form-item>
                                <el-button @click="secondSubmit" :loading="formLoading">下一步</el-button>
                            </el-form-item>
                        </el-form>
                    </div>

                    <!-- 修改密码 -->
                    <div class="thirdStep" v-show="active==2">
                        <el-form label-width="80px" :model="editForm" ref="editForm" :rules="editRules">
                            <el-form-item label="新密码" prop="newPswd">
                                <el-input v-model="editForm.newPswd" type="password"></el-input>
                            </el-form-item>
                            <el-form-item label="确认密码" prop="confirmPswd">
                                <el-input v-model="editForm.confirmPswd" type="password"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button @click="finalSubmit" :loading="formLoading">下一步</el-button>
                                <el-button @click="backStep">上一步</el-button>
                            </el-form-item>
                        </el-form>
                    </div>

                    <!-- 成功与否 -->
                    <div class="result" v-show="active==3">
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
    import Header from "../Header/Header.vue";
    import router from "../../routes";

    export default{
        data(){
            return{
                countdown:5,
                steps:['验证信息','修改密码','修改结果'],
                userId:'',                      //需要密保问题的id
                idenForm:{
                    question:'',
                    answer:'',
                    email:'',
                    idenCode:''
                },
                actionType:false,              //false 为 密保问题, true 为邮箱找回
                formLoading:false,             //表单提交loading
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
            },
            active(){
                return this.$store.state.checkStep
            }
        },
        methods:{
            activateForm(signal){
                if(this.actionType!=signal) this.$refs.idenForm.resetFields();
                this.actionType=signal;
            },
            firstSubmit(){
                this.formLoading=true;
                this.$store.dispatch('getIdenQues',this.userId).then(()=>{
                    this.formLoading=false;
                })
            },
            secondSubmit(){
                this.$refs.idenForm.validate((valid)=>{
                    if(valid){
                        this.formLoading=true;
                        if(!this.actionType && this.userInfo.type==1){
                            this.$store.dispatch('checkQA',this.idenForm).then(()=>{
                                this.formLoading=false;
                            })
                        }
                        if(this.actionType || this.userInfo.type!=1){
                            this.$store.dispatch('checkWithEmail',this.idenForm).then(()=>{
                                this.formLoading=false;
                            })
                        }
                    }
                })
            },
            getEmail(){
                this.$store.dispatch('getEmail',this.idenForm);
            },
            backStep(){
                this.active--;
            },
            finalSubmit(){
                this.$refs.editForm.validate((valid)=>{
                    if(valid){

                    }
                })
            }
        },
        components:{
            Header
        }
    }
</script>
