<template>
    <div>
        <div>
            <el-card
                    class="box-card"
                    :body-style="bodyStyle"
            >
                <div slot="header" class="clearfix">
                    <span style="line-height: 36px;">{{title}}</span>
                    <el-button class="fr" type="primary" @click="goHwDetail(hwId)">前往查看</el-button>
                    <el-button class="fr" v-if="identify==1" icon="edit" @click.native="showEditHw(hwId)"></el-button>
                    <el-button class="fr" v-if="identify==1" type="danger" icon="delete"></el-button>
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
    .text.item{
        font-size:14px;
        color:#475669;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            return{
                bodyStyle:{
                    backgroundColor:"#EFF2F7"
                }
            }
        },
        props:{
            hwId:[String,Number],
            title:String,
            publishTime:String,
            deadline:String,
            identify:[String,Number]
        },
        methods:{
            goHwDetail(hwId){
                router.push({name:'hwDetail',params:{hwId:hwId}})
            },
            showEditHw(hwId){
                this.$store.dispatch('showEditHw',hwId);
            }
        }
    }
</script>
