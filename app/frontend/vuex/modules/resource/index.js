import Vue from 'vue';
import router from '../../../routes';
import * as actions from './actions';

const state={
    loading:false,
    newResrc:{
        name:'',
        filePath:''
    },
    teachResrcList:[
    ],
    stuResrcList:[
    ],
    resrcFilter:0,          //0 显示教师资源  1 显示学生资源
    showEdit:false
}

const mutations={
    resrcLoading(state,signal){
        state.loading=signal;
    },
    updateLoading(state,signal){
        state.loading=signal;
    },
    showEditResrc(state,signal){
        state.showEdit=signal;
    },
    updateResrcList(state,resrcList){
        if(state.resrcFilter==0) state.teachResrcList = resrcList;
        else state.stuResrcList = resrcList;
    },
    resrcFilter(state,index){
        state.resrcFilter=index;
    }
}

export default {
    state,
    actions,
    mutations
}