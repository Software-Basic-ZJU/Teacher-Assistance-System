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

//获取单个帖子
export const getPostDetail=({commit},postId)=>{
    commit('isLoading', true);
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
            router.replace({
                name:'section',
                params:{
                    section:payload.routeParams.section
                }
            });
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

// 编辑帖子
export const editPost=({commit},payload)=>{
    commit('editorLoading',true);
    Vue.http.post("backend/aboutPost/editPost.php",
        {
            post_id:payload.routeParams.pid,
            title:payload.data.title,
            content:payload.data.content
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('isFileUpload',false);
            router.replace({
                name:'section',
                params:{
                    section:payload.routeParams.section,
                    pid:payload.routeParams.pid
                }
            });
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

// 删除帖子  参数成员有postId与section(用于跳转)
export const removePost=({commit},payload)=>{
    commit('isLoading',true);
    Vue.http.post("backend/aboutPost/removePost.php",
        {
            post_id:payload.postId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            router.replace({
                name:'section',
                params:{
                    section:payload.section
                }
            });
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

//获取回帖
export const getReplyPost=({commit},postId)=>{
    commit('replyPostLoading',true);
    Vue.http.post("backend/aboutPost/removePost.php",
        {
            post_id:postId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateRepostList',resp.res.reposts);
        }
    }).then(()=>{
        commit('replyPostLoading',false);
    })
};

//增加回帖
export const addReplyPost=({commit},)=>{

}

export const publish=({commit},info)=>{
    commit('publish',info);

}
