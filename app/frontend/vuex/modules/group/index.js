import Vue from 'vue';
import * as actions from './actions';

const state={
    actionLoading:false,            //表单提交loading
    showGroup:false,                //小组操作表单显示状态
    groupList:[],
}

const mutations= {
    updateGroupList(state,groupList){
        state.groupList=groupList;
    },
    showActionGroup(state,signal){
        state.showGroup = signal;
    },
    actionLoading(state,signal){
        state.actionLoading=signal;
    },
    addGroup(state, newGroup){
        state.groupList.push(newGroup);
    },
    deleteGroup(state,groupId){
        state.groupList.forEach((item,index)=>{
            if(item.group_id==groupId){
                state.groupList.splice(index,1);
                return;
            }
        })
    }
};

export default {
    state,
    actions,
    mutations
}