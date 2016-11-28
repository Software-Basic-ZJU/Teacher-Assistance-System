<template>
    <div>
        <div>
            <el-form ref="moreInfo" :rules="rules" :model="moreInfo" label-width="65px">
                <div class="notice">基本信息</div>
                <el-form-item label="姓名" prop="name">
                    <el-input v-model="moreInfo.name" placeholder="姓名"></el-input>
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="moreInfo.email" placeholder="电子邮箱"></el-input>
                </el-form-item>
                <div class="notice">以下问题答案用于找回密码</div>
                <el-form-item label="问题1" prop="question1">
                    <el-input v-model="moreInfo.question1" placeholder="问题1"></el-input>
                </el-form-item>
                <el-form-item label="答案1" prop="answer1">
                    <el-input v-model="moreInfo.answer1" placeholder="答案1"></el-input>
                </el-form-item>
                <el-form-item label="问题2">
                    <el-input v-model="moreInfo.question2" placeholder="问题2"></el-input>
                </el-form-item>
                <el-form-item label="答案2">
                    <el-input v-model="moreInfo.answer2" placeholder="答案2"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="submitMoreInfo">提交</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>
<style scoped>
    .notice{
        margin-left:65px;
        margin-bottom:10px;
    }
</style>
<script>
    export default{
        data(){
            return{
                moreInfo:{
                    name:'',
                    email:'',
                    question1:'',
                    answer1:'',
                    question2:'',
                    answer2:''
                },
                rules:{
                    name:[
                        {
                            required:true,
                            message:'请输入姓名',
                            trigger:'blur'
                        }
                    ],
                    question1:[
                        {
                            required:true,
                            message:'请输入至少设计一个问题',
                            trigger:'blur'
                        }
                    ],
                    answer1:[
                        {
                            required:true,
                            message:'请输入答案',
                            trigger:'blur'
                        }
                    ]
                }
            }
        },
        methods:{
            submitMoreInfo(){
                this.$store.dispatch('submitMoreInfo',this.moreInfo);
            }
        }
    }
</script>
