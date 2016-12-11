import * as actions from './actions';

const state={
    loading:false,
    hwList:[                //作业列表
    ],
    quesList:[
        {
            quesId:1,
            title:'Java计算器编写',
            content:'hEE',
            shouldNum:20,
            haveNum:15
        }
    ],
    stuList:[
        {
            sid:'111',
            name:'LowesYang',
            content:'啦啦啦啦我我哦我',
            attach:'http://www.baidu.com',
            status:'已交'
        },
        {
            sid:'123',
            name:'lalala',
            content:'啦啦啦啦showhsow',
            attach:'http://www.baidu.com',
            status:'未交'
        }
    ],
    showAction:false,       //对话框弹出和消失state
    actionType:false,       //false为添加作业，true为编辑作业
    editHwId:'',            //正在编辑的作业ID
    markForm:{              //教师点评表单state
        score:'',
        review:''
    }
}

const mutations={
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
    }
}

export default {
    state,
    actions,
    mutations
}