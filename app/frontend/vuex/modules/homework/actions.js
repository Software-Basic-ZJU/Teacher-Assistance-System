import Vue from "vue";
import {LS} from "../../../helpers/utils";
import router from "../../../routes";

export const showHwAction=({commit},signal)=>{
    commit('clearEditHwId');
    commit('showHwAction',signal);
};

export const showEditHw=({commit},hwId)=>{
    commit('showHwAction',true);
    commit('showEditHw',hwId);
};

// 获取作业列表
export const getHwList=({commit},classId)=>{
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
};

// 添加或编辑作业
export const submitHw=({dispatch,commit,state},newHw)=>{
    console.log(newHw);
    commit('isHwLoading',true);
    if(!state.actionType) {
        Vue.http.post('backend/aboutHW/addHw.php',
            {
                class_id: newHw.classId,
                title: newHw.title,
                deadline: newHw.deadline,
                type: newHw.hwType,
                punish_type: newHw.punishType,
                punish_rate: newHw.punishRate
            }
        ).then((response) => {
            let resp = response.body;
            if (!resp.code) {
                dispatch('showHwAction', false);
                dispatch('getHwList', newHw.classId);
                Vue.prototype.$message({
                    type: 'success',
                    message: '添加作业成功'
                })
            }
        }).then(() => {
            commit('isHwLoading', false);
        })
    }
    else{
        Vue.http.post('backend/aboutHW/editHw.php',
            {
                hw_id:newHw.hw_id,
                class_id: newHw.classId,
                title: newHw.title,
                deadline:newHw.deadline,
                type:newHw.hwType,
                punish_type:newHw.punishType,
                punish_rate:newHw.punishRate
            }
        ).then((response)=> {
            let resp = response.body;
            if (!resp.code) {
                dispatch('showHwAction',false);
                dispatch('getHwList',newHw.classId);
                Vue.prototype.$message({
                    type:'success',
                    message:'修改作业成功'
                })
            }
        }).then(()=> {
            commit('isHwLoading', false);
        })
    }
};

// 删除作业
export const deleteHw=({commit},hwId)=>{
    commit('isHwLoading',true);
    Vue.http.post('backend/aboutHW/deleteHw.php',
        {
            hw_id:hwId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('deleteHwItem',hwId);
            Vue.prototype.$message({
                type:'success',
                message:'删除成功'
            })
        }
    }).then(()=>{
        commit('isHwLoading',false);
    })
};

// 获取问题列表
export const getQuesList=({commit},hwId)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutQues/getQuesList.php',
        {
            hw_id:hwId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateHwDetail',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 添加问题
export const addQues=({dispatch,commit},payload)=>{
    commit('editorLoading',true);
    Vue.http.post('backend/aboutQues/addQues.php',
        {
            hw_id:payload.routeParams.hwId,
            title:payload.data.title,
            content:payload.data.content
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            dispatch('getQuesList',payload.routeParams.hwId);
            router.replace({
                name:'hwDetail',
                params:{
                    classId:payload.routeParams.classId,
                    hwId:payload.routeParams.hwId
                }
            })
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

// 编辑问题
export const editQues=({dispatch,commit})=>{
    commit('editorLoading',true);
    Vue.http.post('backend/aboutQues/addQues.php',
        {
            hw_id:payload.routeParams.hwId,
            title:payload.data.title,
            content:payload.data.content
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            dispatch('getQuesList',payload.routeParams.hwId);
            router.replace({
                name:'hwDetail',
                params:{
                    classId:payload.routeParams.classId,
                    hwId:payload.routeParams.hwId
                }
            })
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

export const submitReview=({commit},markForm)=>{
    console.log(markForm);
};