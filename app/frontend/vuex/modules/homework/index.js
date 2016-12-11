import Vue from 'vue';
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
    editHwId:'',
    markForm:{              //教师点评表单state
        score:'',
        review:''
    }
}

const mutations={
    showHwAction(state,signal){
        state.showAction=signal;
    },
    showEditHw(state,hwId){
        state.actionType=true;
        state.editHwId=hwId;
    },
    updateHwList(state,newHwList){
        state.hwList=newHwList;
    }
}

export default {
    state,
    actions,
    mutations
}