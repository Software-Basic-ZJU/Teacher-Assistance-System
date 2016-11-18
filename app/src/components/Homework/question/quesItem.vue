<template>
    <div>
        <div>
            <el-card
                    class="box-card"
                    :body-style="bodyStyle"
            >
                <div class="text item">
                    <span style="line-height: 36px;" class="fl">{{title}}</span>
                    <div class="statistics fl">
                        <div class="shouldNum">应交人数：{{shouldNum}}</div>
                        <div class="haveNum">实交人数：{{haveNum}}</div>
                    </div>
                    <el-button class="fr" type="primary" @click="goQuesDetail(quesId)">前往查看</el-button>
                </div>
            </el-card>
        </div>
    </div>
</template>
<style scoped>
    .statistics{
        background-color: #E5E9F2;
        margin-top:-10px;
        margin-bottom:10px;
        margin-left:80px;
        padding:10px 30px;
        font-size:14px;
        border-radius:10px;
        color:#475669;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            return{
            }
        },
        props:{
            quesId:[String,Number],         //问题id
            title:String,                   //问题标题
            shouldNum:[String,Number],      //问题应交人数
            haveNum:[String,Number]         //问题已交人数
        },
        methods:{
            goQuesDetail(quesId){
                let hwId=this.$route.params.hwId;
                router.push({name:'quesDetail',params:{hwId:hwId,quesId:quesId}});
            }
        }
    }
</script>
