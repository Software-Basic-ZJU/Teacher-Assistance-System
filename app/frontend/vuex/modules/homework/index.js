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
            quesList:[              //问题列表
                {
                    quesId:1,
                    title:'Java计算器编写',
                    content:'hEE',
                    shouldNum:20,
                    haveNum:15
                }
            ]
        },
        {
            hwId:2,
            title:'第二章作业',
            publishTime:"2016-11-03",
            deadline:"2016-12-03",
            quesList:[
                {
                    quesId:1,
                    title:'Java算器编写',
                    content:'fff',
                    shouldNum:20,
                    haveNum:15
                }
            ]
        }
    ],
    showAdd:false,
    showEdit:[],          //bool 数组
}

const mutations={
    showAddHw(state){
        state.showAdd=true;
    },
    closeAddHw(state){
        state.showAdd=false;
    },
    showEditHw(state,hwId){
        Vue.set(state.showEdit,hwId,true);
    },
    closeEditHw(state,hwId){
        Vue.set(state.showEdit,hwId,false);
    },
    addHw(state,payload){
        console.log(payload)
    },
    editHw(state,payload){
        console.log(payload)
    }
}

export default {
    state,
    actions,
    mutations
}