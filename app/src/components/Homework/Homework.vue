<template>
    <div>
        <div class="homework">
            <div class="header">
                <h2>作业列表</h2>
            </div>
            <el-card
                    class="box-card"
                    v-for="item in hwList"
                    :key="item.hwId"
                    :body-style="bodyStyle"
            >
                <div slot="header" class="clearfix">
                    <span style="line-height: 36px;">{{item.title}}</span>
                    <el-button class="fr" type="primary">前往查看</el-button>
                    <el-button class="fr" v-if="isTeacher">编辑</el-button>
                    <el-button class="fr" v-if="isTeacher" type="danger">删除</el-button>
                </div>
                <div class="text item fl">
                    发布时间: &nbsp;&nbsp;{{item.updateTime}}
                </div>
                <div class="text item fr">
                    截止时间: &nbsp;&nbsp;{{item.deadline}}
                </div>
                <div class="cl"></div>
            </el-card>
        </div>
    </div>
</template>
<style scoped>
    .homework{
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
    .box-card{
        margin-top:20px;
    }
    .el-button--primary{
        margin-left:10px;
    }
</style>
<script>
    export default{
        data(){
            return{
                hwList:[
                    {
                        hwId:1,
                        title:'第一章作业',
                        updateTime:"2016-11-03",
                        deadline:"2016-12-03"
                    },
                    {
                        hwId:2,
                        title:'第一章作业',
                        updateTime:"2016-11-03",
                        deadline:"2016-12-03"
                    }
                ],
                bodyStyle:{
                    backgroundColor:"#EFF2F7"
                },
                isTeacher:true
            }
        }
    }
</script>
