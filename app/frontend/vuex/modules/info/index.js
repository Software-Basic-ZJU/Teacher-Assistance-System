import Vue from 'vue';
import * as actions from './actions';

const state={
    loading:false,
    home:{

    },
    noticeList:[
        {
            nid:"111",
            title:'hello',
            content:'llalala',
            time:'2016-11-02',
            level:1
        },
        {
            nid:"1112",
            title:'lowesyang',
            content:'lalalla',
            time:'2016-11-13',
            level:0
        }
    ],
    articleList:[
        {
            artId:123,
            title:'hello world',
            content:'I love youI love youI love youI love youI love you',
            author:'LowesYang',
            publishTime:'2016-11-02',
            replyNum:100
        },
        {
            artId:123,
            title:'hello world',
            content:'I love youI love youI love youI love youI love you',
            author:'LowesYang',
            publishTime:'2016-11-02',
            replyNum:100
        }
    ],
    nwNotice:{
        title:'',
        content:''
    },
    showAddNotice:false,                 //添加通知模态框显示变量
    showEditNotice:false
}

const mutations={
    toggleAddNotice(state){
        state.showAddNotice=!state.showAddNotice;
    },
    toggleEditNotice(state){
        state.showEditNotice=!state.showEditNotice;
    }
}

export default{
    state,
    actions,
    mutations
}
