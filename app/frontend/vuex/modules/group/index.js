import Vue from 'vue';
import * as actions from './actions';

const state={
    actionLoading:false,            //表单提交loading
    showGroup:false,                //小组操作表单显示状态
    groupList:[],
}

const mutations= {
    addGroup(state, newGroup){
        state.groupList.push(newGroup);
    },
    updateGroupList(state,groupList){
        state.groupList=groupList;
    },
    showActionGroup(state,signal){
        state.showGroup = signal;
    },
    actionLoading(state,signal){
        state.actionLoading=signal;
    }
};

export default {
    state,
    actions,
    mutations
}