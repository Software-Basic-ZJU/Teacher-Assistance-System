import Vue from 'vue';
import * as actions from "./actions";

const state={
    loading:false,
    postList:[
        {
            pid:1,
            title:'Test postTest postTest post',
            content:'ddfd',
            author:'LowesYang',
            publishTime:'2016-11-03',
            updateTime:'2016-11-03',
            replyNum:10
        },
        {
            pid:2,
            title:'Test postTest postTest post',
            content:'aaaa',
            author:'LowesYang',
            publishTime:'2016-11-03',
            updateTime:'2016-11-03',
            replyNum:10
        }
    ],
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
    ]
};

const mutations={
    updatePostList(state,info){
        console.log(info);
    },
    publish(state,info){
        console.log(info)
    }
};

export default {
    state,
    actions,
    mutations
}