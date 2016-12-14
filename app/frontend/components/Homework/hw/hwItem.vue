<template>
    <div>
        <div>
            <el-card
                    class="box-card"
                    :body-style="bodyStyle"
            >
                <div slot="header" class="clearfix">
                    <el-tag :class="{'group':hwType==1}">{{hwType==1?'小组作业':'个人作业'}}</el-tag>
                    <span style="line-height: 36px;">{{title}}</span>
                    <el-button class="fr" type="primary" @click="goHwDetail(hwId)">前往查看</el-button>
                    <el-button class="fr" v-if="idenType!=1" icon="edit" :plain="true" type="warning" @click.native="showEditHw(hwId)"></el-button>
                    <el-button class="fr" v-if="idenType!=1" type="danger" :plain="true" icon="delete" @click="removeHw(hwId)"></el-button>
                </div>
                <div class="text item fl">
                    发布时间: &nbsp;&nbsp;{{publishTime}}
                </div>
                <div class="text item fr">
                    截止时间: &nbsp;&nbsp;{{deadline}}
                </div>
                <div class="cl"></div>
            </el-card>
        </div>
    </div>
</template>
<style scoped>
    .box-card{
        margin-top:20px;
    }
    .el-button--primary{
        margin-left:10px;
    }
    .el-tag{
        margin-right:20px;
    }
    .el-tag.group{
        background-color: #6ECADC;
        border-color:#6ECADC;

    }
    .text.item{
        font-size:14px;
        color:#475669;
    }
</style>
<script>
    import router from "../../../routes";
    import {LS} from "../../../helpers/utils";
    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            return{
                bodyStyle:{
                    backgroundColor:"#F0F0F0"
                },
                idenType:userInfo.type
            }
        },
        props:{
            hwId:[String,Number],
            title:String,
            publishTime:String,
            deadline:String,
            hwType:[String,Number]
        },
        methods:{
            goHwDetail(hwId){
                let classId=this.$route.params.classId;
                router.push({name:'hwDetail',params:{classId:classId,hwId:hwId}});
            },
            showEditHw(hwId){
                this.$store.dispatch('showEditHw',hwId);
            },
            removeHw(hwId){
                this.$confirm('确认删除该作业吗？','提示',{
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(()=>{
                    this.$store.dispatch('deleteHw',hwId);
                }).catch(()=>{});
            }
        }
    }
</script>
