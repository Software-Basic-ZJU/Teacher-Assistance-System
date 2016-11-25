import Vue from 'vue';
import router from '../../../routes';
import * as actions from './actions';

const state={
    loading:false,
    newResrc:{
        title:'',
        filePath:''
    },
    editResrc:{
        resrcId:"",
        title:"",
        filePath:''
    },
    teachResrcList:[
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
    stuResrcList:[
        {
            resrcId:3,
            title:'LOL作弊器',
            time:'2016-12-04',
            uploader:'LowesYang',
            filePath:'http://www.baidu.com',
            size:1024
        },
        {
            resrcId:4,
            title:'守望先锋外挂',
            time:'2016-12-04',
            uploader:'LowesYang',
            filePath:'http://www.baidu.com',
            size:1024
        }
    ],
    resrcFilter:'1',          //1 显示教师资源  2 显示学生资源
    showEdit:false
}

const mutations={
    showEditResrc(state,payload){
        state.showEdit=true;
        let row=payload.row;
        state.editResrc.resrcId=row.resrcId;
        state.editResrc.title=row.title;
    },
    closeEditResrc(state){
        state.showEdit=false;
        state.editResrc.resrcId="";
        state.editResrc.title="";
    },
    uploadResrc(state){
        //TODO
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