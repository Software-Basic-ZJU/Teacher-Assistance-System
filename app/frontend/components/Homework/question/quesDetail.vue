<template>
    <div>
        <div class="quesDetail">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                <el-breadcrumb-item :to="{name:'hwDetail',params:{hwId:$route.params.hwId}}">{{hwName}}</el-breadcrumb-item>
                <el-breadcrumb-item>{{question.title}}</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="main" v-loading="loaded">
                <div :class="{'leftBox fl':identify==1,'detailBox':identify==0}">
                    <div class="title">
                        {{question.title}}
                    </div>
                    <div class="content" v-html="question.content"></div>
                    <div class="submitBox" v-if="idenType==1">
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
                </div>
                <div class="rightBox fl" v-if="identify==1">
                    <div class="stuList">
                        <el-table
                                :data="stuList"
                                border
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
                                    min-width="100"
                                    show-overflow-tooltip="true"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="status"
                                    label="状态"
                                    min-width="80"
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
        width:54%;
        padding:10px;
        border-right:1px solid #E5E9F2;
    }
    .main .title{
        margin-top:15px;
        text-align: center;
        font-size:24px;
    }
    .main>.detailBox{
        padding:10px 20px;
    }
    .main .content{
        margin-top:20px;
        font-size:16px;
    }
    .main>.rightBox{
        width:42%;
    }
    .main>.rightBox>.stuList{
        padding:10px;
    }
    .main .submitBox{
        margin-top:80px;
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
            if(userInfo.type==1){
                this.$store.dispatch('getStuWork',{
                    quesId:this.$route.params.quesId,
                    sid:userInfo.id
                })
            }
            return{
                idenType:userInfo.type,
                hwName:'',
                uploadInfo:{    //上传附件的额外参数
                    uploader_id:userInfo.id,
                    type:2
                }
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
                    let question=state.homework.quesDetail
                    this.hwName=question.hw_title;
                    return question;
                },
                stuList:state=>state.homework.quesDetail.shouldList,
                stuWork:state=>state.homework.stuWork,
                isSubmitFile:state=>state.homework.isSubmitFile
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
            }
        },
        methods:{
            checkHw(index,row){
//                console.log(index,row.sid);
                let hwId=this.$route.params.hwId;
                let quesId=this.$route.params.quesId;
                router.push({name:'correct',params:{hwId:hwId,quesId:quesId,sid:row.id}});
            }
        },
        components:{
            Editor
        }
    }
</script>
