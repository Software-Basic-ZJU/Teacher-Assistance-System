<template>
    <div>
        <div class="homework">
            <div class="header">
                <h2>作业列表</h2>
                <el-button type="success" class="fr" v-if="idenType!=1" @click.navtive="showHwAction">添加作业</el-button>
            </div>
            <hw-item
                    v-for="item in hwList"
                    :key="item.hwId"
                    :hw-id="item.hwId"
                    :title="item.title"
                    :publish-time="item.publish_time"
                    :deadline="item.deadline"
                    :identify="identify"
                    :hw-type="item.hwType"
            ></hw-item>
            <el-dialog :title="dialogTitle" v-model="showAction" size="tiny" @close="closeHwAction">
                <el-form :model="tempHw">
                    <el-form-item label="作业标题">
                        <el-input v-model="tempHw.title" auto-complete="off" class="title"></el-input>
                    </el-form-item>
                    <el-form-item label="截止日期">
                        <el-date-picker
                                v-model="deadline"
                                type="datetime"
                                placeholder="选择截止日期"
                                format="yyyy-MM-dd HH-mm-ss"
                                :onClick="pickTime"
                        ></el-date-picker>
                    </el-form-item>
                    <el-form-item label="作业类型" >
                        <el-radio-group v-model="hwType">
                            <el-radio :label="0">个人作业</el-radio>
                            <el-radio :label="1">小组作业</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="逾期惩罚" >
                        <el-radio-group v-model="punishType" @change="punishChange">
                            <el-radio :label="0">禁止提交</el-radio>
                            <el-radio :label="1">扣分</el-radio>
                        </el-radio-group>
                        <div v-show="showRate" class="rate">
                            <span class=" fl">最终得分 * </span>
                            <el-input
                                    class="fl"
                                    placeholder="请输入百分比"
                                    v-model="punishRate"
                                    size="small"
                                    maxlength="3"
                            ></el-input>
                            <span class="symbol fl">%</span>
                            <div class="cl"></div>
                        </div>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click.native="closeHwAction">取消</el-button>
                    <el-button type="primary" @click.native="submitHwAction">确认添加</el-button>
                </div>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .header>h3{
        color:#475669;
        height:25px;
        margin-top:0px;
    }
    .el-button--success{
        margin-top:-45px;
    }
    .rate .el-input{
        width:100px;
        margin-top:2px;
        margin-left:5px;
    }
    .symbol{
        margin-left:5px;
        font-size:18px;
    }
</style>
<script>
    import hwItem from "./hwItem.vue";
    import {mapState} from "vuex";
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            return{
                idenType:userInfo.type,
                hwType:0,
                punishType:0,
                deadline:'',
                punishRate:''
            }
        },
        computed:mapState({
            showAction:state=>state.homework.showAction,
            hwList:state=>state.homework.hwList,
            actionType:state=>state.homework.actionType,
            dialogTitle:state=>state.homework.actionType?'编辑作业':'添加作业',
            editHwId:state=>state.homework.editHwId,
            tempHw(state){
                let hwList=state.homework.hwList;
                for(let i=0;i<hwList.length;i++){
                    if(hwList[i].hwId==state.homework.editHwId){
                        this.deadline=hwList[i].deadline;
                        this.hwType=hwList[i].hwType;
                        this.punishRate=(hwList[i].punishRate*100).toFixed(0);
                        return hwList[i];
                    }
                }
                return {
                    title:'',
                    deadline:'',
                    punishType:0,
                    punishRate:''
                }
            },
            showRate(){
                return this.punishType;
            }
        }),
        methods:{
            showHwAction(){
                this.$store.dispatch('showHwAction',true);
            },
            closeHwAction(){
                this.deadline='';
                this.punishRate='';
                this.$store.dispatch('showHwAction',false);
            },
            submitHwAction(){
                this.tempHw.hwType=this.hwType;
                this.tempHw.deadline=this.deadline;
                this.tempHw.punishRate=(this.punishRate/100).toFixed(2);
                this.$store.dispatch('submitHw',this.tempHw);
            },
            punishChange(label){
                this.tempHw.punishType=label;
                console.log(this.tempHw);
            }
        },
        components:{
            hwItem
        }
    }
</script>
