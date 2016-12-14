<template>
    <div>
        <div class="hwDetail">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'homework'}">{{className}}作业列表</el-breadcrumb-item>
                    <el-breadcrumb-item>{{hwDetail.hwTitle}}</el-breadcrumb-item>
                </el-breadcrumb>
                <el-button v-if="idenType!=1" type="success" class="fr" @click="addQues">添加问题</el-button>
            </div>
            <div class="infoBox">
                <span class="type">作业类型：{{hwDetail.hwType?'小组作业':'个人作业'}}</span>
                <span class="publish">发布时间：{{hwDetail.hwPublishTime}}</span>
                <span class="ddl">截止时间：{{hwDetail.hwDeadline}}</span>
            </div>
            <div class="quesList">
                <div class="noRes" v-if="hwDetail.quesList.length==0">还没有添加问题~</div>
                <ques-item
                        class="item"
                        v-for="item in hwDetail.quesList"
                        :key="item.ques_id"
                        :ques-id="item.ques_id"
                        :title="item.title"
                        :should-num="item.should_num"
                        :submit-num="item.submit_num"
                        :is-finish="item.ques_finish"
                ></ques-item>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .header{
        padding:10px 0px;
    }
    .infoBox{
        padding:5px 0px;
        font-size:14px;
    }
    .infoBox>span{
        margin-right:30px;

    }
    .infoBox>.publish{
        color:#8492A6;
    }
    .infoBox>.ddl{
        color:#FF4949;
    }
    .quesList{
        padding-bottom:10px;
    }
    .el-button--success{
        margin-top:-45px;
    }
</style>
<script>
    import quesItem from "../question/quesItem.vue";
    import router from "../../../routes";
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            this.$store.dispatch('getQuesList',this.$route.params.hwId);
            return{
                idenType:userInfo.type
            }
        },
        computed:{
            hwDetail(){
                return this.$store.state.homework.hwDetail;
            },
            className(){        //班级名称
                let className="";
                let userInfo=LS.getItem("userInfo");
                for(let i=0;userInfo.type!=1 && i<userInfo.class_id.length;i++){
                    if(userInfo.class_id[i].class_id==this.$route.params.classId){
                        className=userInfo.class_id[i].class_name+" - ";
                        break;
                    }
                }
                return className;
            }
        },
        methods:{
            addQues(){
                let hwId=this.$route.params.hwId;
                router.push({name:'addQues',params:{hwId:hwId}});
            }
        },
        components:{
            quesItem
        }
    }
</script>
