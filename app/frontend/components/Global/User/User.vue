<template>
    <div>
        <div>
            <div class="btnGroup fl">
                <el-button :icon="editable?'edit':'check'" :type="editable?'warning':'success'" :plain="true" size="small" @click="toggleEdit"></el-button>
                <a href="/#/editPswd" target="_blank"><el-button :plain="true" size="small">修改密码</el-button></a>
            </div>
            <el-form ref="userInfo" :rules="rules" :model="userInfo" label-width="94px">
                <div class="notice">基本信息</div>
                <el-form-item label="教工号 / 学号">
                    <el-input v-model="userInfo.id" :disabled="true"></el-input>
                </el-form-item>
                <el-form-item label="姓名" prop="name">
                    <el-input v-model="userInfo.name" :disabled="editable"></el-input>
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="userInfo.email" :disabled="editable"></el-input>
                </el-form-item>
                <div class="notice">以下问题答案用于找回密码</div>
                <el-form-item label="问题1" prop="question1">
                    <el-input v-model="userInfo.question1" :disabled="editable"></el-input>
                </el-form-item>
                <el-form-item label="答案1" prop="answer1">
                    <el-input v-model="userInfo.answer1" :disabled="editable"></el-input>
                </el-form-item>
                <el-form-item label="问题2">
                    <el-input v-model="userInfo.question2" :disabled="editable"></el-input>
                </el-form-item>
                <el-form-item label="答案2">
                    <el-input v-model="userInfo.answer2" :disabled="editable"></el-input>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>
<style scoped>
    .btnGroup{
        margin-top:-52px;
        margin-left:90px;
    }
    .notice{
        margin-left:90px;
        margin-bottom:10px;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            return{
                editable:true,
                rules:{
                    name:[
                        {
                            required:true,
                            message:'请输入姓名',
                            trigger:'change'
                        }
                    ],
                    question1:[
                        {
                            required:true,
                            message:'请输入至少设计一个问题',
                            trigger:'change'
                        }
                    ],
                    answer1:[
                        {
                            required:true,
                            message:'请输入答案',
                            trigger:'change'
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
            toggleEdit(){
                if(this.editable) this.editable=!this.editable;
                else{
                    this.$refs.userInfo.validate((valid)=>{
                        if(valid){
                            this.editable=!this.editable;
                            this.$store.dispatch('editUserInfo',this.userInfo);
                        }
                    })
                }
            }
        },
        components:{

        }
    }
</script>
