<template>
    <div>
        <div class="hwDetail">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                    <el-breadcrumb-item>{{hwDetail.title}}</el-breadcrumb-item>
                </el-breadcrumb>
                <el-button type="success" class="fr" @click="addQues">添加问题</el-button>
            </div>
            <div class="infoBox">
                <span class="type">作业类型：{{hwDetail.hwType?'小组作业':'个人作业'}}</span>
                <span class="publish">发布时间：{{hwDetail.publishTime}}</span>
                <span class="ddl">截止时间：{{hwDetail.deadline}}</span>
            </div>
            <div class="quesList">
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
        padding-top:10px;
    }
    .el-button--success{
        margin-top:-45px;
    }
</style>
<script>
    import quesItem from "../question/quesItem.vue";
    import router from "../../../routes";
    export default{
        data(){
            return{
            }
        },
        computed:{
            hwDetail(){                             //作业详情
                let hwId=this.$route.params.hwId;
                let list=this.$store.state.homework.hwList;
                for(let i=0;i<list.length;i++){
                    if(list[i].hwId==hwId){
                        return list[i];
                    }
                }
            },
            quesList(){
                return this.$store.state.homework.quesList
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
