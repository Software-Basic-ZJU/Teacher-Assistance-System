import * as actions from "./actions";

const state={
    showAddTA:false,        //助教操作表单显示状态
    TAlist:[]
};

const mutations={
    showAddTA(state,signal){
        state.showAddTA=signal;
    },
    updateTAlist(state,newList){
        state.TAlist=newList;
    },
    addTA(state,TAInfo){
        state.TAlist.push(TAInfo);
    },
    removeTA(state,assistId){
        state.TAlist.forEach((item,index)=>{
            if(item.assist_id==assistId){
                state.TAlist.splice(index,1);
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