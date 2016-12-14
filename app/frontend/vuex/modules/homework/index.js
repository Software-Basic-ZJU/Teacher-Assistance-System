import * as actions from './actions';

const state={
    loading:false,
    isSubmitFile:false,     //是否上传附件，用于判断是否应该在离开页面时删除附件
    hwList:[                //作业列表
    ],
    hwDetail:{              //作业详情,包含作业标题和问题列表
        quesList:[]
    },
    quesDetail:{
        shouldList:[]
    },
    stuWork:{},              //某个学生的作业
    showAction:false,       //对话框弹出和消失state
    actionType:false,       //false为添加作业，true为编辑作业
    editHwId:'',            //正在编辑的作业ID
    markForm:{              //教师点评表单state
        score:'',
        review:''
    }
}

const mutations={
    isSubmitFile(state,signal){
        state.isSubmitFile=signal;
    },
    isHwLoading(state,signal){
        state.loading=signal;
    },
    showHwAction(state,signal){
        state.showAction=signal;
    },
    showEditHw(state,hwId){
        state.actionType=true;
        state.editHwId=hwId;
    },
    clearEditHwId(state){       //清楚正在编辑的状态，以让下一次编辑时，vue能够检测到editHwId变化
        state.editHwId=0;
    },
    setActionType(state,signal){
        state.actionType=signal;
    },
    updateHwList(state,newHwList){
        state.hwList=newHwList;
    },
    deleteHwItem(state,hwId){       //删除作业某项
        let hwList=state.hwList.slice();
        let i;
        for(i=0;hwList.length;i++){
            if(hwList[i].hw_id==hwId) break;
        }
        hwList.splice(i,1);
        state.hwList=hwList;
    },
    updateHwDetail(state,hwDetail){
        state.hwDetail=hwDetail;
    },
    updateQuesDetail(state,question){
        state.quesDetail=question;
        state.quesDetail.shouldList.forEach((item)=>{
            if(item.isSubmit) item.status='已提交';
            else item.status='未提交'
        })
    },
    removeQues(state,quesId){
        let target=0;
        state.hwDetail.quesList.forEach((item,index)=>{
            if(item.ques_id==quesId){
                target=index;
                return;
            }
        })
        state.hwDetail.quesList.splice(target,1);
    },
    updateStuWork(state,stuWork){
        stuWork.resrcId=stuWork.resrc_id;
        state.stuWork=stuWork;
    }
};

export default {
    state,
    actions,
    mutations
}