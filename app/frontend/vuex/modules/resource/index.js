import Vue from 'vue';
import router from '../../../routes';
import * as actions from './actions';

const state={
    loading:false,
    newResrc:{
        name:'',
        filePath:''
    },
    editResrc:{
    },
    teachResrcList:[
    ],
    stuResrcList:[

    ],
    resrcFilter:'1',          //1 显示教师资源  2 显示学生资源
    showEdit:false
}

const mutations={
    updateLoading(state,signal){
        state.loading=signal;
    },
    showEditResrc(state,signal){
        state.showEdit=signal;
    },
    uploadFile(state){
        //TODO
    },
    updateResrcList(state,resrcList){
        state.teachResrcList=resrcList;
    },
    cancelAddResrc(state){
        //TODO clear data.remove file.
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