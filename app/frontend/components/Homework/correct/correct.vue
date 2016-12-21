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
                <el-breadcrumb-item>[{{stuWork.uploader_id}}]的作业</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="stuWork">
                <h3>作业内容</h3>
                <div class="stuContent" v-html="stuWork.content"></div>
                <div class="stuAttach">
                    <a
                            :href="stuWork.path"
                            :download="stuWork.resrc_name"><i class="iconfont icon-xiazai"></i>附件</a>
                </div>
            </div>
            <div class="markBox">
                <h3>教师评分</h3>
                <el-form label-position="top" ref="markForm" :model="markForm" :rules="rules">
                    <el-form-item label="评分" prop="score">
                        <el-input placeholder="评分" v-model="markForm.score" :disabled="stuWork.finish==1"></el-input>
                    </el-form-item>
                    <el-form-item label="点评">
                        <el-input
                                placeholder="评价一下作业吧!"
                                type="textarea"
                                v-model="markForm.reply"
                                :disabled="stuWork.finish==1"
                                rows="4"
                        ></el-input>
                    </el-form-item>
                    <p class="notice">只保留最后一次提交的评分</p>
                    <el-button type="primary" @click="submitReview" :loading="markLoading" :disabled="stuWork.finish==1">提交</el-button>
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
    .markBox .notice{
        font-size:14px;
        color:#aaaaaa ;
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
    import {LS }from "../../../helpers/utils";
    import router from "../../../routes";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            if(userInfo.type==1) router.replace({name:'info'});

            this.$store.dispatch('getStuWork',{
                quesId:this.$route.params.quesId,
                sid:this.$route.params.sid
            });
            return{
                rules:{
                    score:[
                        {
                            required:true,
                            message:'请输入分数',
                            trigger:'blur'
                        },
                        {
                            validator:(rule,value,callback)=>{
                                if(Number.isNaN(parseInt(value))){
                                    callback(new Error('请输入数字'));
                                }
                                else callback();
                            },
                            trigger:'blur'
                        }
                    ]
                }
            }
        },
        computed:mapState({
            stuWork:state=>state.homework.stuWork,
            markForm:state=>state.homework.markForm,
            markLoading:state=>state.homework.loading
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
