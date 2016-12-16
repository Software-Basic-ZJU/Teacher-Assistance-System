import Vue from "vue";
import {LS} from "../../../helpers/utils";

// 获取助教列表
export const getTAlist=({commit})=>{
    return new Promise((resolve,reject)=>{
        let userInfo=LS.getItem('userInfo');
        if(!userInfo || !userInfo.token) return commit('logout');
        Vue.http.post('backend/aboutTA/getTAList.php',
            {
                teacher_id:userInfo.teacher_id
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code){
                resp.res.assistList.forEach((item)=>{
                    userInfo.class_id.forEach((itemm)=>{
                        if(itemm.class_id==item.class_id){
                            item.class_name=itemm.class_name;
                            return;
                        }
                    })
                })
                commit('updateTAlist',resp.res.assistList);
            }
        }).then(()=>{
            resolve();
        })
    })
};

// 添加助教
export const addTA=({commit},TAform)=>{
    return new Promise((resolve,reject)=>{
        let userInfo=LS.getItem('userInfo');
        if(!userInfo || !userInfo.token) return commit('logout');
        Vue.http.post('backend/aboutTA/addTA.php',
            {
                class_id:TAform.classId,
                teacher_id:userInfo.teacher_id,
                assist_id:TAform.taId,
                assist_password:TAform.password,
                name:TAform.taName
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code){
                userInfo.class_id.forEach((item)=>{
                    if(resp.res.class_id==item.class_id){
                        resp.res.class_name=item.class_name;
                        return;
                    }
                });
                Vue.prototype.$message({
                    type:'success',
                    message:resp.msg
                });
                commit('addTA',resp.res);
                commit('showAddTA',false);
            }
        }).then(()=>{
            resolve();
        })
    })
};

// 删除助教
export const removeTA=({commit},assistId)=>{
    let userInfo=LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    Vue.http.post('backend/aboutTA/deleteTA.php',
        {
            teacher_id:userInfo.teacher_id,
            assist_id:assistId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            Vue.prototype.$message({
                type:'success',
                message:resp.msg
            });
            commit('removeTA',assistId);
        }
    })
};

export const showAddTA=({commit},signal)=>{
    commit('showAddTA',signal);
};

export const deleteTA=({commit})=>{

};

