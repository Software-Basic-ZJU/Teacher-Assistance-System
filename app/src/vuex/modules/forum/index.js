import Vue from 'vue';
import * as actions from "./actions";

const state={
    listLoaded:false,
    postList:[],
    hostPost:{},
    posts:[]
};

const mutations={
    getPostList(state,info){
        console.log(info);
    },
    publishPost(state,info){
        console.log(info)
    }
};

export default {
    state,
    actions,
    mutations
}