import Vue from "vue";
import router from '../../../routes';
import {LS} from "../../../helpers/utils";

// 显示修改资源表单
export const showEditResrc=({commit},signal)=>{
    commit('showEditResrc',signal)
};

//获取资源列表
export const getResrcList=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutResource/getResourceList.php',
        {
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateResrcList',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 上传文件
export const uploadFile=({commit})=>{
    commit('uploadFile ');
};

// 添加资源
export const addResrc=({commit})=>{

}

export const submitResrc=({commit})=>{
    commit('submitResrc');
};

export const cancelAddResrc=({commit})=>{
    commit('cancelAddResrc');
    router.go(-1);
};

export const resrcFilter=({commit},index)=>{
    commit('resrcFilter',index);
};