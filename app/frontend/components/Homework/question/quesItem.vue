<template>
    <div>
        <div class="quesItem">
            <el-card
                    class="box-card"
                    :body-style="bodyStyle"
            >
                <div class="text item">
                    <i class="quesStatus iconfont icon-yijieshujiaobiao" v-if="isFinish==1"></i>
                    <span class="title fl">{{title}}</span>
                    <div class="statistics fl">
                        <div class="shouldNum">应交人数：{{shouldNum}}</div>
                        <div class="haveNum">实交人数：{{submitNum}}</div>
                    </div>
                    <el-button class="fr" type="primary" @click="goQuesByName(quesId,'quesDetail')">前往查看</el-button>
                    <el-button class="fr" v-if="idenType==2" type="warning" :plain="true" @click="goQuesByName(quesId,'editQues')" icon="edit"></el-button>
                    <el-button class="fr" v-if="idenType==2" type="danger" :plain="true" icon="delete" @click="removeQues(quesId)"></el-button>
                </div>
            </el-card>
        </div>
    </div>
</template>
<style scoped>
    .quesItem{
        position: relative;
        margin-top:15px;
    }
    .quesStatus{
        top:-2px;
        left:0px;
        position: absolute;
        display: block;
        font-size:50px;
        color:#6ECADC;
    }
    .title{
        line-height: 36px;
        margin-left:20px;
    }
    .statistics{
        background-color: #F0F0F0;
        margin-top:-10px;
        margin-bottom:10px;
        margin-left:60px;
        padding:10px 30px;
        font-size:14px;
        border-radius:10px;
        color:#475669;
    }
    .el-button--primary{
        margin-left:10px;
    }
</style>
<script>
    import router from "../../../routes";
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            return{
                idenType:userInfo.type
            }
        },
        props:{
            quesId:[String,Number],         //问题id
            title:String,                   //问题标题
            shouldNum:[String,Number],      //问题应交人数
            submitNum:[String,Number],      //问题已交人数
            isFinish:[String,Number]        //是否结束
        },
        methods:{
            goQuesByName(quesId,name){
                let hwId=this.$route.params.hwId;
                router.push({name:name,params:{hwId:hwId,quesId:quesId}});
            },
            removeQues(quesId){
                this.$store.dispatch("removeQues",quesId);
            }
        }
    }
</script>
