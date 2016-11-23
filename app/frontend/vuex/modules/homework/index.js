import Vue from 'vue';
import * as actions from './actions';

const state={
    loading:false,
    hwList:[                //作业列表
        {
            hwId:1,
            title:'第一章作业',
            publishTime:"2016-11-03",
            deadline:"2016-12-03",
            punishType:0,
            punishRate:1
        },
        {
            hwId:2,
            title:'第二章作业',
            publishTime:"2016-11-03",
            deadline:"2016-12-03",
            punishType:1,
            punishRate:0.52
        }
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
    showHwAction(state){
        state.showAction=true;
    },
    closeHwAction(state){
        state.showAction=false;
        state.editHwId='';
    },
    showEditHw(state,hwId){
        state.actionType=true;
        state.editHwId=hwId;
    },
}

export default {
    state,
    actions,
    mutations
}