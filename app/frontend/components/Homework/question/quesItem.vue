<template>
    <div>
        <div class="quesItem">
            <el-card
                    class="box-card"
                    :body-style="bodyStyle"
            >
                <div class="text item">
                    <span style="line-height: 36px;" class="fl">{{title}}</span>
                    <div class="statistics fl">
                        <div class="shouldNum">应交人数：{{shouldNum}}</div>
                        <div class="haveNum">实交人数：{{submitNum}}</div>
                    </div>
                    <el-button class="fr" type="primary" @click="goQuesByName(quesId,'quesDetail')">前往查看</el-button>
                    <el-button class="fr" v-if="idenType!=1" type="warning" :plain="true" @click="goQuesByName(quesId,'editQues')" icon="edit"></el-button>
                    <el-button class="fr" v-if="idenType!=1" type="danger" :plain="true" icon="delete" @click="removeQues(quesId)"></el-button>
                </div>
            </el-card>
        </div>
    </div>
</template>
<style scoped>
    .quesItem{
        margin-top:15px;
    }
    .statistics{
        background-color: #F0F0F0;
        margin-top:-10px;
        margin-bottom:10px;
        margin-left:80px;
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
            submitNum:[String,Number]         //问题已交人数
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
