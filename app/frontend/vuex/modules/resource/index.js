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
    resrcFilter:'1',          //1 显示教师资源  2 显示学生资源
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
        state.teachResrcList=resrcList;
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