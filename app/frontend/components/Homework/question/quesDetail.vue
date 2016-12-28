<template>
    <div>
        <div class="quesDetail">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                <el-breadcrumb-item :to="{name:'hwDetail',params:{hwId:$route.params.hwId}}">{{hwName}}</el-breadcrumb-item>
                <el-breadcrumb-item>{{question.title}}
                    <el-tag :class="{'group':question.type==1}">{{question.type==1?'小组作业':'个人作业'}}</el-tag>
                    <span class="quesStatus" v-if="question.ques_finish==1">已结束</span>
                </el-breadcrumb-item>
            </el-breadcrumb>
            <div class="main" v-loading="loaded">
                <div :class="{'leftBox fl':idenType!=1,'detailBox':idenType==1}">
                    <el-button type="primary" @click="finishQues" :loading="submitLoading" v-if="idenType==2 && question.ques_finish!=1">提交成绩</el-button>
                    <div class="title">
                        {{question.title}}
                    </div>
                    <div class="content" v-html="question.content"></div>
                    <div class="submitBox" v-if="idenType==1 && question.ques_finish!=1">
                        <h3>提交作业</h3>
                        <Editor
                                method="submitHw"
                                btn-name="提交"
                                :data="stuWork"
                                :has-title="false"
                                :has-upload="true"
                                :upload-info="uploadInfo"
                                :default-file-list="defaultFile"
                        ></Editor>
                    </div>
                    <div class="resultBox" v-if="idenType==1 && question.ques_finish==1">
                        <h4>成绩单</h4>
                        <div class="score">
                            <span>得分：</span>{{stuWork.score}}
                        </div>
                        <div class="reply">
                            <div class="fl">评价：</div>
                            <div class="fl review">{{stuWork.reply}}</div>
                        </div>
                    </div>
                </div>
                <div class="rightBox fl" v-if="idenType!=1">
                    <div class="stuList">
                        <el-table
                                :data="stuList"
                                border
                                height="600"
                        >
                            <el-table-column
                                    prop="id"
                                    label="学号"
                                    min-width="100"
                                    show-overflow-tooltip="true"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="name"
                                    label="姓名"
                                    min-width="80"
                                    show-overflow-tooltip="true"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="status"
                                    label="得分"
                                    min-width="100"
                                    show-overflow-tooltip="true"
                            >
                            </el-table-column>
                            <el-table-column
                                    inline-template
                                    :context="_self"
                                    fixed="right"
                                    label="操作"
                                    min-width="80">
                              <span>
                                <el-button @click="checkHw($index,row)" type="text" :disabled="!row.isSubmit" size="small">查看作业</el-button>
                              </span>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .quesDetail{
        padding:10px 0px;
    }
    .main>.leftBox{
        width:46%;
        padding:10px;
    }
    .main .title{
        margin-top:15px;
        text-align: center;
        font-size:22px;
    }
    .main>.detailBox{
        padding:10px 20px;
    }
    .quesStatus{
        font-size:16px;
        text-align: center;
        color:#6ECADC;
        margin-left:10px;
    }
    .main .content{
        margin-top:20px;
        font-size:16px;
    }
    .resultBox>div{
        margin-top:10px;
    }
    .resultBox .score>span{
        color:#6ECADC;
    }
    .resultBox .reply .review{
        width:70%;
    }
    .resultBox .reply>div:first-child{
        color:#6ECADC;
    }
    .main>.rightBox{
        width:50%;
        border-left:1px solid #E5E9F2;
    }
    .main>.rightBox>.stuList{
        padding:10px;
    }
    .main .submitBox{
        margin-top:80px;
    }
    .el-tag{
        margin-left:10px;
    }
    .el-tag.group{
        background-color: #6ECADC;
        border-color:#6ECADC;
    }
</style>
<script>
    import Editor from "../../Editor/Editor.vue";
    import router from "../../../routes";
    import {mapState} from "vuex";
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            this.$store.dispatch('getQuesDetail',this.$route.params.quesId);
            return{
                idenType:userInfo.type,
                hwName:''
            }
        },
        beforeRouteLeave(to,from,next){
            if(this.isSubmitFile){
                this.$store.dispatch('removeResrc',this.stuWork);
            }
            next();
        },
        computed:{
            ...mapState({
                question(state){
                    let question=state.homework.quesDetail;
                    this.hwName=question.hw_title;
                    return question;
                },
                stuList:state=>state.homework.quesDetail.shouldList,
                stuWork(state){
                    let stuWork=state.homework.stuWork;
                    stuWork.workType=this.question.type;
                    return stuWork;
                },
                isSubmitFile:state=>state.homework.isSubmitFile,
                submitLoading:state=>state.homework.loading
            }),
            defaultFile(){
                let resource=LS.getItem('stuWorkFile');
                if(resource){
                    this.stuWork.resrcId=resource.resource_id;
                    return [{
                        name:resource.name,
                        path:resource.path
                    }]
                }
                if(this.stuWork.resrc_id) {
                    return [{
                        name: this.stuWork.resrc_name,
                        path: this.stuWork.path
                    }];
                }
                else return [];
            },
            uploadInfo(){    //上传附件的额外参数
                let userInfo=LS.getItem('userInfo');
                let uploadInfo = {
                    uploader_id: this.question.type==0?userInfo.id:userInfo.group_id,
                    type: 2
                };
                return uploadInfo;
            }
        },
        methods:{
            checkHw(index,row){
//                console.log(index,row.sid);
                let hwId=this.$route.params.hwId;
                let quesId=this.$route.params.quesId;
                router.push({name:'correct',params:{hwId:hwId,quesId:quesId,sid:row.id}});
            },
            finishQues(){
                this.$confirm('提交成绩后将不能再修改个人评分,是否确认提交?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('finishQues',this.$route.params.quesId);
                 }).catch(()=>{});
            }
        },
        components:{
            Editor
        },
        head:{
            title(){
                return {
                    inner:this.question.title
                }
            }
        }
    }
</script>
