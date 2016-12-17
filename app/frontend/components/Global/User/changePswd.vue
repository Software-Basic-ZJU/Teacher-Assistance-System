<template>
    <div>
        <div>
            <Header></Header>
            <div class="main">
                <h3>修改密码</h3>
                <el-form ref="editForm" :model="editForm" :rules="editRules" label-width="90px">
                    <el-form-item label="旧密码" prop="oldPassword">
                        <el-input type="password" v-model="editForm.oldPassword"></el-input>
                    </el-form-item>
                    <el-form-item label="新密码" prop="newPassword">
                        <el-input type="password" v-model="editForm.newPassword"></el-input>
                    </el-form-item>
                    <el-form-item label="确认密码" prop="confirmPassword">
                        <el-input type="password" v-model="editForm.confirmPassword"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="submitChange">确认修改</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .main{
        width:400px;
        margin:20px auto;
        padding:10px 25px;
        background-color: white;
        -webkit-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);

    }
</style>
<script>
    import Header from "../../Header/Header.vue";
    export default {
        data(){
            return{
                editLoading:false,          //表单提交loading
                editForm:{
                    oldPassword:'',
                    newPassword:'',
                    confirmPassword:''
                },
                editRules:{
                    oldPassword:[
                        {
                            required:true,
                            message:'请填写旧的密码',
                            trigger:'change'
                        }
                    ],
                    newPassword:[
                        {
                            required:true,
                            message:'请输入新密码',
                            trigger:'change'
                        },
                        {
                            validator:(rule,value,cb)=>{
                                if(!value){
                                    cb(new Error('请输入密码'));
                                }
                                else if(value.length<6){
                                    cb(new Error('密码长度不得少于6个字符'));
                                }
                                else cb();
                            },
                            trigger:'change'
                        }
                    ],
                    confirmPassword:[
                        {
                            required:true,
                            message:'请重复输入密码',
                            trigger:'change'
                        },
                        {
                            validator:(rule,value,cb)=>{
                                if(!value){
                                    cb(new Error('请重复输入密码'));
                                }
                                else if(value && value!=this.editForm.newPassword){
                                    cb(new Error('两次输入密码不一致'));
                                }
                                else cb();
                            },
                            trigger:'change'
                        }
                    ]
                }
            }
        },
        methods:{
            submitChange(){
                this.$refs.editForm.validate((valid)=>{
                    console.log(this.editForm);
                    if(valid){
                        this.editLoading=true;
                        this.$store.dispatch('changePswd',this.editForm).then(()=>{
                            this.editLoading=false;
                        })
                    }
                })
            }
        },
        components:{
            Header
        }
    }
</script>