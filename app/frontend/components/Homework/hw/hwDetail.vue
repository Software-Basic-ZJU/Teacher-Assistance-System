<template>
    <div>
        <div class="hwDetail">
            <div class="header">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                    <el-breadcrumb-item>{{homework.title}}</el-breadcrumb-item>
                </el-breadcrumb>
                <el-button type="success" class="fr" @click="addQues">添加问题</el-button>
            </div>
            <div class="infoBox">
                <span class="publish">发布时间：{{homework.updateTime}}</span>
                <span class="ddl">截止时间：{{homework.deadline}}</span>
            </div>
            <div class="quesList">
                <ques-item
                        v-for="item in quesList"
                        :key="item.quesId"
                        :quesId="item.quesId"
                        :title="item.title"
                        :shouldNum="item.shouldNum"
                        :haveNum="item.haveNum"
                ></ques-item>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .hwDetail{
        padding:0px 20px;
    }
    .header{
        padding:10px 0px;
    }
    .infoBox{
        padding:5px 0px;
        font-size:14px;
    }
    .infoBox>.publish{
        color:#8492A6;
    }
    .infoBox>.ddl{
        color:#FF4949;
        margin-left:30px;
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
                homework:{
                    title:'啦啦啦',
                    updateTime:'本地存储获取',
                    deadline:'本地存储'
                },
                quesList:[
                    {
                        quesId:1,
                        title:'Java计算器编写',
                        shouldNum:20,
                        haveNum:15
                    }
                ]
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
