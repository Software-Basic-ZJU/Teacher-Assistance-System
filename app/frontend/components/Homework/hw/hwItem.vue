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
            <el-dialog title="修改作业" v-model="showEdit" size="tiny" @close="closeEditHw(hwId)">
                <el-form :model="newHw">
                    <el-form-item label="作业标题" :label-width="formLabelWidth">
                        <el-input v-model="newHw.title" auto-complete="off" class="title"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-date-picker
                                v-model="newHw.deadline"
                                type="datetime"
                                placeholder="选择截止日期"
                        ></el-date-picker>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click.native="closeEditHw(hwId)">取消</el-button>
                    <el-button type="primary" @click.native="editHw(hwId)">确认修改</el-button>
                </div>
            </el-dialog>
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
                },
                newHw:{
                    title:this.title,
                    deadline:this.deadline
                }
            }
        },
        computed:{
            showEdit(){
                let hwId=this.hwId;
                return !!this.$store.state.homework.showEdit[hwId];
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
                let self=this;
                router.push({name:'hwDetail',params:{hwId:hwId}})
            },
            showEditHw(hwId){
                this.$store.dispatch('showEditHw',hwId);
            },
            closeEditHw(hwId){
                this.$store.dispatch('closeEditHw',hwId);
            },
            editHw(hwId){
                this.$store.dispatch('editHw',{
                    hwId:hwId,
                    title:this.newHw.title,
                    deadline:this.newHw.deadline
                })
            }
        }
    }
</script>
