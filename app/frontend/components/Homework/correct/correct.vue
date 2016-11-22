<!-- 批改作业 -->

<template>
    <div>
        <div class="correct">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                <el-breadcrumb-item :to="{name:'hwDetail',params:{hwId:$route.params.hwId}}">{{hwName}}</el-breadcrumb-item>
                <el-breadcrumb-item
                        :to="{name:'quesDetail',params:{hwId:$route.params.hwId,quesId:$route.params.quesId}}"
                >
                    {{question.title}}
                </el-breadcrumb-item>
                <el-breadcrumb-item>{{student.name}}的作业</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="stuWork">
                
            </div>
            <div class="stuAttach">

            </div>
        </div>
    </div>
</template>
<style scoped>
    .correct{
        padding:10px 20px;
    }
</style>
<script>
    import {mapState} from 'vuex';
    export default{
        data(){
            return{
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
            student(state){
                let sid=this.$route.params.sid;
                let stuList=state.homework.stuList;
                for(let i=0;i<stuList.length;i++){
                    if(stuList[i].sid==sid){
                        return stuList[i];
                    }
                }
            }
        }),
        components:{

        }
    }
</script>
