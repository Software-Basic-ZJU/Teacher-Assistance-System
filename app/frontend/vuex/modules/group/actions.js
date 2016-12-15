import Vue from 'vue';
import {LS} from '../../../helpers/utils';

// 获取小组列表
export const getGroupList=({commit})=>{
    let userInfo = LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post("backend/aboutGroup/getGroupList.php",
        {
            class_id:userInfo.class_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code) {
            console.log(resp.res.groupList);
            commit('updateGroupList',resp.res.groupList);
        }
    }).then(()=>{
        commit('isLoading',false);
    });
};

// 创建小组
export const createGroup=({commit},group)=>{
    let userInfo = LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('actionLoading',true);
    Vue.http.post("backend/aboutGroup/createGroup.php",
        {
            leader_id:userInfo.id,
            group_name:group.name,
            group_password:group.password,
            class_id:userInfo.class_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code) {
            resp.res.group_leader=userInfo.name;
            Vue.prototype.$message({
                type: 'success',
                message: resp.msg
            });
            commit('addGroup',resp.res);
            commit('showActionGroup',false);
        }
    }).then(()=>{
        commit('actionLoading',false);
    });
};

// 加入小组
export const joinGroup=({dispatch,commit},group)=>{
    let userInfo = LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('actionLoading',false);
    Vue.http.post("backend/aboutGroup/joinGroup.php",
        {
            group_id:group.id,
            student_id:userInfo.id,
            password:group.password
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code) {
            Vue.prototype.$message({
                type: 'success',
                message: resp.msg
            });
            dispatch('getGroupList');
            commit('showActionGroup',false);
        }
    }).then(()=>{
        commit('actionLoading',false);
    });
};

export const showActionGroup=({commit},signal)=>{
    commit('showActionGroup',signal);
}
