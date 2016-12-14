<!-- 批改作业 -->

<template>
    <div>
        <div class="correct">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                <el-breadcrumb-item :to="{name:'hwDetail',params:{hwId:$route.params.hwId}}">{{stuWork.hw_title}}</el-breadcrumb-item>
                <el-breadcrumb-item
                        :to="{name:'quesDetail',params:{hwId:$route.params.hwId,quesId:$route.params.quesId}}"
                >
                    {{stuWork.ques_title}}
                </el-breadcrumb-item>
                <el-breadcrumb-item>{{student.name}}的作业</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="stuWork">
                <h3>作业内容</h3>
                <div class="stuContent" v-html="student.content"></div>
                <div class="stuAttach">
                    <a
                            :href="student.attach"
                            :title="student.sid+'-'+student.name+'-'+hwName"
                            :download="student.sid+'-'+student.name+'-'+hwName"><i class="iconfont icon-xiazai"></i>附件</a>
                </div>
            </div>
            <div class="markBox">
                <h3>教师评分</h3>
                <el-form label-position="top" ref="markForm" :model="markForm" :rules="rules">
                    <el-form-item label="评分" prop="score">
                        <el-input placeholder="评分" v-model="markForm.score"></el-input>
                    </el-form-item>
                    <el-form-item label="点评">
                        <el-input placeholder="评价一下作业吧!" type="textarea" v-model="markForm.review"></el-input>
                    </el-form-item>
                    <el-button type="primary" @click="submitReview">提交</el-button>
                </el-form>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .correct{
        padding:10px 20px;
    }
    .stuWork,
    .markBox{
        padding:10px 20px;
    }
    .stuWork>.stuAttach{
        margin-top:30px;
        padding-top:15px;
        border-top:1px solid #E5E9F2;
    }
    .stuWork>.stuAttach i{
        font-size:18px;
        margin-right:10px;
    }
    .el-input{
        width:100px;
    }
    .el-textarea{
        width:500px;
    }
</style>
<script>
    import {mapState} from 'vuex';
    import Editor from '../../Editor/Editor.vue';
    export default{
        data(){
            this.$store.dispatch('getStuWork',{
                quesId:this.$route.params.quesId,
                sid:this.$route.params.sid
            });
            return{
                rules:{
                    score:[
                        {required:true,message:'请输入分数',trigger:'blur'}
                    ]
                }
            }
        },
        computed:mapState({
            stuWork:state=>state.homework.stuWork,
            student:state=>state,
            markForm:state=>state.homework.markForm
        }),
        methods:{
            submitReview(){
                this.$refs.markForm.validate((valid)=>{
                    if(valid){
                        this.$store.dispatch('submitReview',this.markForm);
                    }
                })
            }
        },
        components:{
            Editor
        }
    }
</script>
