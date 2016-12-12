<template>
    <div>
        <div class="hwDetail">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                    <el-breadcrumb-item>{{hwDetail.hwTitle}}</el-breadcrumb-item>
                </el-breadcrumb>
                <el-button type="success" class="fr" @click="addQues">添加问题</el-button>
            </div>
            <div class="infoBox">
                <span class="type">作业类型：{{hwDetail.hwType?'小组作业':'个人作业'}}</span>
                <span class="publish">发布时间：{{hwDetail.hwPublishTime}}</span>
                <span class="ddl">截止时间：{{hwDetail.hwDeadline}}</span>
            </div>
            <div class="quesList">
                <div class="noRes" v-id="hwDetail.quesList.length==0">还没有添加问题~</div>
                <ques-item
                        v-for="item in quesList"
                        :key="item.quesId"
                        :ques-id="item.quesId"
                        :title="item.title"
                        :shouldNum="item.shouldNum"
                        :haveNum="item.haveNum"
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
        padding:10px 0px;
    }
    .quesList .noRes{
        text-align: center;
        font-size:20px;
        color:#c9c9c9;
    }
    .el-button--success{
        margin-top:-45px;
    }
</style>
<script>
    import quesItem from "../question/quesItem.vue";
    import router from "../../../routes";
    import {mapState} from "vuex";

    export default{
        data(){
            this.$store.dispatch('getQuesList',this.$route.params.hwId);
            return{
            }
        },
        computed:{
            ...mapState({
                hwDetail:state=>state.homework.hwDetail,        //作业详情
            })
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
