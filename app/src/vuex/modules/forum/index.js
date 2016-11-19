import Vue from 'vue';
import * as actions from "./actions";

let state={
    listLoaded:false,
    postList:[],
    hostPost:{},
    posts:[]
};

let mutations={
    getPostList(state,info){
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