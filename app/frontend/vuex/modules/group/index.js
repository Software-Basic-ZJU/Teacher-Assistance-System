import Vue from 'vue';
import * as actions from './actions';

const state={
    loading:false,
    groupList:[
        {
            id:123,
            name:'软需不要虚',
            memberList:['吴志强','杨奕辉','李牧','梁鸿业']
        }
    ],
    showGroup:false
}

const mutations= {
    addGroup(state, payload){
        state.groupList.push(payload);
    },
    joinGroup(state,payload){
        let groups=state.groupList;
        for(let i=0;i<groups.length;i++){
            if(groups[i].id==payload.id){
                groups[i].memberList.push(payload.name);
                Vue.set(state.groupList,i,groups[i]);
                break;
            }
        }
        state.showGroup=false;
    },
    showActionGroup(state){
        state.showGroup = true;
    },
    closeActionGroup(state){
        state.showGroup = false;
    }
}

export default {
    state,
    actions,
    mutations
}