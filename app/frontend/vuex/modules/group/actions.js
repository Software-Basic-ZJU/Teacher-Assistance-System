import Vue from 'vue';
import {LS} from '../../../helpers/utils';

// 获取小组列表
export const getGroupList=({commit},classId)=>{
    commit('isLoading',true);
    Vue.http.post("aboutGroup/getGroupList.php",
        {
            class_id:classId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code) {
            //更新用户信息(小组相关)
            let userInfo=LS.getItem('userInfo');
            userInfo.group_id=resp.res.group_id;
            commit('updateUserInfo',userInfo);
            LS.setItem('userInfo',userInfo);

            // 更新小组列表
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
    Vue.http.post("aboutGroup/createGroup.php",
        {
            leader_id:userInfo.id,
            group_name:group.name,
            group_password:group.password,
            class_id:userInfo.class_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code) {
            Vue.prototype.$message({
                type: 'success',
                message: resp.msg
            });
            let members=[];
            members.push({
                name:userInfo.name
            });
            userInfo.group_id=resp.res.group_id;
            resp.res.group_member=members;
            resp.res.group_leader=userInfo.id;
            commit('updateUserInfo',userInfo);
            LS.setItem('userInfo',userInfo);
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
    Vue.http.post("aboutGroup/joinGroup.php",
        {
            group_id:group.id,
            student_id:userInfo.id,
            password:group.password
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code) {
            userInfo.group_id=group.id;
            commit('updateUserInfo',userInfo);
            Vue.prototype.$message({
                type: 'success',
                message: resp.msg
            });
            LS.setItem('userInfo',userInfo);
            dispatch('getGroupList',userInfo.class_id);
            commit('showActionGroup',false);
        }
    }).then(()=>{
        commit('actionLoading',false);
    });
};

// 解散小组
export const deleteGroup=({commit},groupId)=>{
    let userInfo = LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',false);
    Vue.http.post("aboutGroup/deleteGroup.php",
        {
            group_id:groupId,
            leader_id:userInfo.id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code) {
            userInfo.group_id=-1;
            commit('updateUserInfo',userInfo);
            LS.setItem('userInfo',userInfo);
            Vue.prototype.$message({
                type: 'success',
                message: resp.msg
            });
            commit('deleteGroup',groupId);

            // 循环发送删文件异步请求
            resp.res.resrcList.forEach((item)=>{
                Vue.http.post("aboutResource/removeResource.php",
                    {
                        resource_id:item.resrcId
                    }
                )
            })
        }
    }).then(()=>{
        commit('isLoading',false);
    });
};

// 退出小组
export const quitGroup=({dispatch,commit})=>{
    let userInfo = LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',false);
    Vue.http.post("aboutGroup/quitGroup.php",
        {
            student_id:userInfo.id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code) {
            userInfo.group_id=-1;
            commit('updateUserInfo',userInfo);
            LS.setItem('userInfo',userInfo);
            Vue.prototype.$message({
                type: 'success',
                message: resp.msg
            });
            dispatch('getGroupList',userInfo.class_id);
        }
    }).then(()=>{
        commit('isLoading',false);
    });
};

export const showActionGroup=({commit},signal)=>{
    commit('showActionGroup',signal);
}
