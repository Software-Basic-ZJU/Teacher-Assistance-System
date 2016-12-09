import Vue from 'vue';
import * as actions from './actions';
import {LS} from "../../../helpers/utils";

const state={
    loading:false,
    contact:{},
    noticeList:[],
    notice:{},
    articleList:[],
    article:{},
    showAddNotice:false,                 //添加通知模态框显示变量
    showEditNotice:false
}

const mutations={
    toggleAddNotice(state,signal){
        state.showAddNotice=signal;
    },
    toggleEditNotice(state,signal){
        state.showEditNotice=signal;
    },
    updateContact(state,contact){
        state.contact=Object.assign({},state.contact,contact);     //合并
    },
    updateNoticeList(state,newList){
        state.noticeList=newList;
    },
    updateNotice(state,notice){
        state.notice=notice;
    },
    updateArticleList(state,newList){
        state.articleList=newList;
    },
    updateArticle(state,article){
        state.article=article;
    },
    updateReplyList(state,payload){

    },
    addNotice(state,newNotice){
        let userInfo=LS.getItem("userInfo");
        for(let i=0;i<userInfo.class_id.length;i++){
            if(userInfo.class_id[i].class_id==newNotice.class_id){
                newNotice.class_name=userInfo.class_id[i].class_name;
                break;
            }
        }
        state.noticeList.push(newNotice);
    }
}

export default{
    state,
    actions,
    mutations
}
