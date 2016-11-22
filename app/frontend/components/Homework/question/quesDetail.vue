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
                    <div class="submitBox" v-if="!identify">
                        <h3>提交作业</h3>
                        <Editor
                                method="submitHw"
                                btn-name="提交"
                                :has-title="false"
                                :has-upload="true"
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
                                    prop="sid"
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
                                <el-button @click="checkHw($index,row)" type="text" size="small">查看作业</el-button>
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
        padding:10px 20px;
    }
    .main>.leftBox{
        width:54%;
        padding:10px;
        border-right:1px solid #E5E9F2;
    }
    .main .title{
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
    export default{
        data(){
            return{
                identify:1
            }
        },
        computed:mapState({
            hwName(state){
                let hwId=this.$route.params.hwId;
                let list=state.homework.hwList;
                for(let i=0;i<list.length;i++){
                    if(list[i].hwId==hwId){
                        return list[i].title;
                    }
                }
            },
            question(state){
                let quesId=this.$route.params.quesId;
                let list=state.homework.quesList;
                for(let i=0;i<list.length;i++){
                    if(list[i].quesId==quesId){
                        return list[i];
                    }
                }
            },
            stuList(state){
                return state.homework.stuList;
            }
        }),
        methods:{
            checkHw(index,row){
//                console.log(index,row.sid);
                let hwId=this.$route.params.hwId;
                let quesId=this.$route.params.quesId;
                router.push({name:'correct',params:{hwId:hwId,quesId:quesId,sid:row.sid}});
            }
        },
        components:{
            Editor
        }
    }
</script>
