<template>
    <div>
        <div class="quesDetail">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                <el-breadcrumb-item :to="{name:'hwDetail',params:{hwId:$route.params.hwId}}">{{hwName}}</el-breadcrumb-item>
                <el-breadcrumb-item>{{question.title}}</el-breadcrumb-item>
            </el-breadcrumb>
        </div>
    </div>
</template>
<style scoped>
    .quesDetail{
        padding:0px 20px;
    }
</style>
<script>
    export default{
        data(){
            return{
                hwName:'第一张作业',
                question:{
                    title:"xxxx"
                }
            }
        }
    }
</script>
