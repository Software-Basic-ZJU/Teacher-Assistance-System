import Vue from "vue";
import router from '../../../routes';
import {LS} from "../../../helpers/utils";

// 显示修改资源表单
export const showEditResrc=({commit},signal)=>{
    commit('showEditResrc',signal)
};

//获取资源列表
export const getResrcList=({state,commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutResource/getResourceList.php',
        {
            teacher_id:userInfo.teacher_id,
            type:state.resrcFilter
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateResrcList',resp.res.resource_list);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 确认添加或更新资源
export const uploadResrc=({dispatch,commit},newResrc)=>{
    commit('resrcLoading',true);
    console.log(newResrc);
    Vue.http.post('backend/aboutResource/resourceConfirm.php',
        {
            resource_id:newResrc.resrcId,
            name:newResrc.name,
            authority:newResrc.authority
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            dispatch('getResrcList');
            commit('showEditResrc',false);
            commit('isFileUpload',false);
            LS.removeItem("resource");
        }
    }).then(()=>{
        commit('resrcLoading',false);
        router.replace({name:'resource'});
    })
};

// 删除文件或资源
export const removeResrc=({dispatch,commit},file)=>{
    commit('resrcLoading',true);
    Vue.http.post('backend/aboutResource/removeResource.php',
        {
            resource_id:file.resrcId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('isFileUpload',false);
            LS.removeItem("resource");
        }
    }).then(()=>{
        commit('resrcLoading',false);
        if(file.wholeResrc){
            dispatch('getResrcList');
        }
    })
};

export const submitResrc=({commit})=>{
    commit('submitResrc');
};

export const resrcFilter=({dispatch,commit},index)=>{
    commit('resrcFilter',index);
    dispatch('getResrcList');
};