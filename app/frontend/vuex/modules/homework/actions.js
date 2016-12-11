import Vue from "vue";
import {LS} from "../../../helpers/utils";

export const showHwAction=({commit},signal)=>{
    commit('showHwAction',signal);
};

export const showEditHw=({commit},hwId)=>{
    commit('showHwAction',true);
    commit('showEditHw',hwId);
};

// 获取作业列表
export const getHwList=({commit},classId)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutHW/getHwList.php',
        {
            class_id:classId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateHwList',resp.res.hwList);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
}

export const submitHw=({commit},payload)=>{
    console.log(payload);
};

export const submitReview=({commit},markForm)=>{
    console.log(markForm);
}