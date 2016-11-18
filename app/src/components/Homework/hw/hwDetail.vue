<template>
    <div>
        <div class="hwDetail">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                <el-breadcrumb-item>{{homework.title}}</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="timeInfo">
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
        border-bottom:1px solid #D3DCE6;
    }
    .header>h2{
        color:#475669;
        height:25px;
        margin-top:0px;
    }
    .timeInfo{
        padding:10px 0px;
        font-size:14px;
    }
    .timeInfo>.publish{
        color:#8492A6;
    }
    .timeInfo>.ddl{
        color:#FF4949;
        margin-left:30px;
    }
</style>
<script>
    import quesItem from "../question/quesItem.vue";
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
        components:{
            quesItem
        }
    }
</script>
