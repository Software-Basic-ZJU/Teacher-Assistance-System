<template>
    <div>
        <div>
            <el-form :model="mailForm" ref="mailForm" :rules="rules">
                <el-form-item label="收件人" prop="destId">
                    <el-input v-model="mailForm.destId" placeholder="教工号/学号"></el-input>
                </el-form-item>
                <el-form-item label="标题 (最多50个字符)" prop="title">
                    <el-input v-model="mailForm.title" placeholder="信件标题"></el-input>
                </el-form-item>
                <el-form-item label="内容 (最多500个字符)" prop="content">
                    <el-input type="textarea" placeholder="写点话吧..." v-model="mailForm.content"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="sendMail">发送</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>
<style scoped>
    
</style>
<script>
    export default{
        data(){
            return{
                rules:{
                    destId:[
                        {
                            required:true,
                            message:'请输入收件人id!',
                            trigger:'blur'
                        },
                        {
                            max:40,
                            message:'收件人id太长了...',
                            trigger:'blur'
                        }
                    ],
                    title:[
                        {
                            required:true,
                            message:'请输入信件标题!',
                            trigger:'blur'
                        },
                        {
                            max:50,
                            message:'字数请限制在50个字符内',
                            trigger:'blur'
                        }
                    ],
                    content:[
                        {
                            required:true,
                            message:'请输入信件内容!',
                            trigger:'blur'
                        },
                        {
                            max:500,
                            message:'字数请限制在1000个字符内',
                            trigger:'blur'
                        }
                    ]
                }
            }
        },
        props:{
            mailForm:{
                type:Object,
                default:{
                    destId:'',
                    title:'',
                    content:''
                },
            }
        },
        methods:{
            sendMail(){
                this.$refs.mailForm.validate((valid)=>{
                    if(valid){
                        console.log(this.mailForm);
                    }
                })
            }
        }
    }
</script>
