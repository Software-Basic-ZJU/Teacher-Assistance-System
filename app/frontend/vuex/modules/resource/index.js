import Vue from 'vue';
import router from '../../../routes';
import * as actions from './actions';

const state={
    newResrc:{
        title:'',
        filePath:''
    },
    editResrc:{
        resrcId:"",
        title:"",
        filePath:''
    },
    resrcList:[
        {
            resrcId:1,
            title:'软工第三章PPT',
            time:'2016-12-04',
            uploader:'LowesYang',
            filePath:'http://www.baidu.com',
            size:1024
        },
        {
            resrcId:2,
            title:'软工第四章PPT',
            time:'2016-12-04',
            uploader:'LowesYang',
            filePath:'http://www.baidu.com',
            size:1024
        }
    ],
    showEditResrc:false
}

const mutations={
    showEdit(state,payload){
        state.showEditResrc=true;
        let row=payload.row;
        state.editResrc.resrcId=row.resrcId;
        state.editResrc.title=row.title;
    },
    closeEdit(state){
        state.showEditResrc=false;
        state.editResrc.resrcId="";
        state.editResrc.title="";
    },
    uploadResrc(state){
        //TODO
    },
    cancelAdd(state){
        //TODO clear data.remove file.
        router.go(-1);
    }
}

export default {
    state,
    actions,
    mutations
}