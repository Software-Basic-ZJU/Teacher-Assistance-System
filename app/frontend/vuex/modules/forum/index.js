import Vue from 'vue';
import * as actions from "./actions";

const state={
    loading:false,              //按钮上显示的loading
    replyPostLoading:false,      //获取回帖的Loading
    isReplyShow:false,            //回帖表单显示状态
    sectionList:[       //论坛首页信息
        {
            secId:0,
            to:'teacherQA',
            name:'教师答疑区',
            postNum:0,
            todayNum:0,
        },
        {
            secId:1,
            to:'public',
            name:'公共讨论区',
            postNum:0,
            todayNum:0,
        },
        {
            secId:2,
            to:'group',
            name:'小组讨论区',
            postNum:0,
            todayNum:0,
        }
    ],
    postList:[],
    repostList:[],      //回帖列表
    currPost:{
        title:'',
        content:'',
        resrcId:'',
        resource:{},
        defaultFile:[],
        repostList:[]
    }
};

const mutations={
    postLoading(state,signal){
        state.loading=signal;
    },
    updateForumInfo(state,sectionList){
        sectionList.forEach((item,index)=>{
            state.sectionList[item.section].postNum=item.total_num;
            state.sectionList[item.section].todayNum=item.today_num;
        })
    },
    updatePostList(state,postList){
        state.postList=postList;
    },
    updateCurrPost(state,currPost){
        state.currPost=currPost;
        state.currPost.resrcId=currPost.resource.resrc_id;
    },
    publish(state,info){
        console.log(info)
    },
    replyPostLoading(state,signal){
        state.replyPostLoading=signal;
    },
    updateRepostList(state,repostList){
        state.repostList=repostList;
    },
    isReplyShow(state,signal){
        state.isReplyShow=signal;
    },
    addRepost(state,newRepost){
        state.repostList.push(newRepost);
    },
    removeRepost(state,rpid){
        state.repostList.forEach((item,index)=>{
            if(item.repost_id==rpid){
                state.repostList.splice(index,1);
                return;
            }
        })
    },
    addPostComment(state,payload){        //添加某回帖中的评论列表
        state.repostList.forEach((item)=>{
            if(item.repost_id==payload.repostId){
                item.commentList.push(payload.newComm);
                return;
            }
        });
    },
    removePostComment(state,payload){
        state.repostList.forEach((item)=>{
            if(item.repost_id==payload.repostId){
                item.commentList.forEach((comm,index)=>{
                    if(comm.com_id==payload.comId){
                        item.commentList.splice(index,1);
                        return;
                    }
                })
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