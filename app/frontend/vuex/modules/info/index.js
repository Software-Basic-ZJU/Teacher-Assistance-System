import Vue from 'vue';
import * as actions from './actions';
import {LS} from "../../../helpers/utils";

const state={
    contact:{},
    noticeList:[],
    notice:{},
    articleList:[],
    article:{},
    noticeCurrPage:1,
    articleCurrPage:1,
    showAddNotice:false,                 //添加通知模态框显示变量
    showEditNotice:false,
    keywords:''                         //搜索关键词
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
    addComment(state,newCom){
        state.article.comment.push(newCom);
    },
    removeComment(state,comId){
        let target=state.article.comment.find((item)=>(
            item.com_id==comId
        ))
        state.article.comment.splice(target,1);
    },
    changeArtPage(state,val){
        state.articleCurrPage=val;
    },
    changeNotePage(state,val){
        state.noticeCurrPage=val;
    },
    addNotice(state,newNotice){
        state.noticeList.push(newNotice);
    },
    updateKeywords(state,keywords){
        state.keywords=keywords;
    }
}

export default{
    state,
    actions,
    mutations
}
