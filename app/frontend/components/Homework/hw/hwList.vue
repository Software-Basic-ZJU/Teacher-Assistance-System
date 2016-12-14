<template>
    <div>
        <div class="homework">
            <div class="header">
                <h2>{{className}}作业列表</h2>
                <el-button type="success" class="fr" v-if="idenType!=1" @click.navtive="showHwAction">添加作业</el-button>
            </div>
            <div class="noRes" v-if="hwList.length==0">还没有布置作业呢</div>
            <hw-item
                    v-for="item in hwList"
                    :key="item.hw_id"
                    :hw-id="item.hw_id"
                    :title="item.title"
                    :publish-time="item.publish_time"
                    :deadline="item.deadline"
                    :hw-type="item.type"
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
                                :picker-options="dateFilter"
                                :onClick="pickTime"
                        ></el-date-picker>
                    </el-form-item>
                    <el-form-item label="作业类型" >
                        <el-radio-group v-model="hwType">
                            <el-radio :label="1">个人作业</el-radio>
                            <el-radio :label="2">小组作业</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="逾期惩罚" >
                        <el-radio-group v-model="punishType" @change="punishChange">
                            <el-radio :label="1">禁止提交</el-radio>
                            <el-radio :label="2">扣分</el-radio>
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
                    <el-button type="primary" @click.native="addHw" :loading="hwLoading">提交</el-button>
                </div>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .noRes{
        margin:20px 0px 10px 0px;
    }
    .header{
        border-bottom:1px solid #D3DCE6;
    }
    .header>h2{
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
    import moment from "moment";

    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            return{
                idenType:userInfo.type,
                hwType:0,
                punishType:0,
                deadline:'',
                punishRate:'',
                dateFilter:{
                    disabledDate(time){         //截止日期必须为今天之后
                        return time.getTime()<Date.now()
                    }
                }
            }
        },
        computed:{
            ...mapState({
                showAction:state=>state.homework.showAction,
                hwList:state=>state.homework.hwList,
                actionType:state=>state.homework.actionType,
                dialogTitle:state=>state.homework.actionType?'编辑作业':'添加作业',
                editHwId:state=>state.homework.editHwId,
                hwLoading:state=>state.homework.loading
            }),
            tempHw(){
                let hwList=this.$store.state.homework.hwList;
                let editHwId=this.$store.state.homework.editHwId;
                for(let i=0;i<hwList.length;i++){
                    if(hwList[i].hw_id==editHwId){
                        this.deadline=hwList[i].deadline;
                        this.hwType=hwList[i].type==0?1:2;
                        this.punishType=hwList[i].punish_type==0?1:2;
                        this.punishRate=(hwList[i].punish_rate*100).toFixed(0);
                        return Object.assign({},hwList[i]);
                    }
                }
                return {
                    title:'',
                    deadline:'',
                    punishType:1,
                    punishRate:''
                }
            },
            showRate(){
                return this.punishType==1?false:true;
            },
            className(){        //班级名称
                let className="";
                let userInfo=LS.getItem("userInfo");
                for(let i=0;userInfo.type!=1 && i<userInfo.class_id.length;i++){
                    if(userInfo.class_id[i].class_id==this.$route.params.classId){
                        className=userInfo.class_id[i].class_name+" - ";
                        break;
                    }
                }
                return className;
            }
        },
        methods:{
            showHwAction(){
                // 仅添加作业时调用
                this.hwType='';
                this.tempHw.title='';
                this.deadline='';
                this.punishType=1;
                this.hwType=1;
                this.punishRate='';
                this.$store.dispatch('showHwAction',true);
            },
            closeHwAction(){
                this.$store.dispatch('showHwAction',false);
            },
            addHw(){
                this.tempHw.classId=this.$route.params.classId; //注入班级id
                this.tempHw.hwType=this.hwType==1?0:1;
                this.tempHw.punishType=this.punishType==1?0:1;
                this.tempHw.deadline=moment(this.deadline).format('YYYY-MM-DD HH:mm:ss');
                if(isNaN(this.punishRate)){
                    return this.$message({
                        type:'error',
                        message:'减分比例请输入数字'
                    });
                }
                this.tempHw.punishRate=(this.punishRate/100).toFixed(2);
                this.$store.dispatch('addHw',this.tempHw);
            },
            punishChange(label){
                this.punishType=label;
            }
        },
        components:{
            hwItem
        }
    }
</script>
