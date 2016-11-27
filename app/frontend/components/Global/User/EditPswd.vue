<template>
    <div>
        <div class="editPswd">
            <el-steps class="fl" :space="100" :active="active" finish-status="success" direction="vertical">
                <el-step v-for="step in steps" :title="step"></el-step>
            </el-steps>
            <div class="actionBox fr" >

                <!-- 回答问题或使用邮箱修改-->
                <div class="actionType" v-if="active==0">
                    <el-form label-width="80px">
                        <el-form-item label="问题">
                            <el-select v-model="editForm.ques" placeholder="请选择问题">
                                <el-option selected :label="userInfo.question1" :value="userInfo.question1"></el-option>
                                <el-option :label="userInfo.question2" :value="userInfo.question2"></el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="答案">
                            <el-input v-model="editForm.answer"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
                <div class="newPswd" v-if="active==1"></div>
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
</style>
<script>
    export default{
        data(){
            return{
                active:0,
                steps:['回答问题','修改密码','最后一步'],
                editForm:{
                    answer:''
                }
            }
        },
        computed:{
            userInfo(){
                return this.$store.state.userInfo
            }
        }
    }
</script>
