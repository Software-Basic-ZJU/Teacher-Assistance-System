import Vue from "vue";
import {LS} from "../../../helpers/utils";
import router from "../../../routes";

// 获得论坛首页信息
export const getForumInfo=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post("backend/aboutPost/getForumInfo.php",
        {
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateForumInfo',resp.res.sectionList);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 获取帖子列表
export const getPostList=({commit},type)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading', true);
    if(type==2) {       //小组讨论区，需要传group_id
        Vue.http.post("backend/aboutPost/getPostList.php",
            {
                section:type,
                teacher_id: userInfo.teacher_id,
                group_id:userInfo.group_id
            }
        ).then((response)=> {
            let resp = response.body;
            if (!resp.code) {
                commit('updatePostList', resp.res.postList);
            }
        }).then(()=> {
            commit('isLoading', false);
        })
    }
    else{
        Vue.http.post("backend/aboutPost/getPostList.php",
            {
                section:type,
                teacher_id: userInfo.teacher_id
            }
        ).then((response)=> {
            let resp = response.body;
            if (!resp.code) {
                commit('updatePostList', resp.res.postList);
            }
        }).then(()=> {
            commit('isLoading', false);
        })
    }
};

// 添加帖子
export const addPost=({commit},payload)=>{
    let userInfo=LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    let secType=0;
    switch(payload.routeParams.section){
        case 'teacherQA':
            secType=0;
            break;
        case 'public':
            secType=1;
            break;
        case 'group':
            secType=2;
            break;
        default:break;
    }
    commit('editorLoading',true);
    Vue.http.post("backend/aboutPost/addPost.php",
        {
            teacher_id:userInfo.teacher_id,
            title:payload.data.title,
            content:payload.data.content,
            section:secType,
            resrc_id:payload.data.resrcId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('isFileUpload',false);
            router.replace({name:'section',params:{section:payload.routeParams.section}});
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
}

export const publish=({commit},info)=>{
    commit('publish',info);

}
