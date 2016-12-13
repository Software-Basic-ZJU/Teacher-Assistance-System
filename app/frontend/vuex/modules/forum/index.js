import Vue from 'vue';
import * as actions from "./actions";

const state={
    loading:false,
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
    repostList:[
        {
            rpid:1,
            content:'Test postTest postTest hostPost',
            author:'LowesYang',
            time:'2016-11-03',
            replyNum:10
        },
        {
            rpid:2,
            content:'Test postTest postTest hostPost',
            author:'LowesYang',
            time:'2016-11-03',
            replyNum:10
        }
    ],
    currPost:{
        title:'',
        content:'',
        resrcId:'',
        defaultFile:[]
    },
    replyPostLoading:false      //获取回帖的Loading
};

const mutations={
    updateForumInfo(state,sectionList){
        sectionList.forEach((item,index)=>{
            if(item.secId==state.sectionList[index].section){
                state.sectionList[index].postNum=item.total_num;
                state.sectionList[index].todayNum=item.today_num;
            }
        })
    },
    updatePostList(state,postList){
        state.postList=postList;
    },
    publish(state,info){
        console.log(info)
    },
    replyPostLoading(state,signal){
        state.replyPostLoading=signal;
    },
    updateRepostList(state,repostList){
        state.repostList=repostList;
    }
};

export default {
    state,
    actions,
    mutations
}