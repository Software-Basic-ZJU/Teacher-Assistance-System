import Vue from "vue";
import {LS} from "../../../helpers/utils";
import router from "../../../routes";

export const toggleAddNotice=({commit},signal)=>{
    commit('toggleAddNotice',signal);
};

export const toggleEditNotice=({commit},signal)=>{
    commit('toggleEditNotice',signal);
};

//获取教师联系方式
export const getContact=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutInfo/getContact.php',
        {
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateContact',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 修改教师联系方式
export const editContact=({commit},contact)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutInfo/editContact.php',
        {
            teacher_id:userInfo.teacher_id,
            email:contact.email,
            phone:contact.phone,
            qq:contact.qq,
            wechat:contact.wechat,
            other_contact:contact.otherContact
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateContact',resp.res);
            router.replace({name:'contact'});
        }
    }).then(()=>{
        commit('isLoading',false);
    })
}

// 获取通知列表
export const getNoticeList=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutNotice/getNotices.php',
        {
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateNoticeList',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 获取单个通知
export const getNotice=({commit},nid)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutNotice/getNoticeDetail.php',
        {
            notice_id:nid
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateNotice',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 发布新通知
export const addNotice=({commit},payload)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    let newNotice=payload.data;
    commit('editorLoading',true);
    Vue.http.post('backend/aboutNotice/addNotice.php',
        {
            title:newNotice.title,
            content:newNotice.content,
            level:newNotice.level?1:0,
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('addNotice',resp.res);
            commit('toggleAddNotice',false);
            Vue.prototype.$message({
                type:'success',
                message:resp.msg
            })
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

// 修改通知
export const editNotice=({commit},payload)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    let newNotice=payload.data;
    commit('editorLoading',true);
    Vue.http.post('backend/aboutNotice/editNotice.php',
        {
            notice_id:payload.routeParams.nid,
            title:newNotice.title,
            content:newNotice.content,
            level:newNotice.level?1:0,
            teacher_id:newNotice.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateNotice',resp.res);
            commit('toggleEditNotice',false);
            Vue.prototype.$message({
                type:'success',
                message:resp.msg
            })
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

// 删除通知
export const removeNotice=({commit},nid)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutNotice/deleteNotice.php',
        {
            notice_id:nid
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            Vue.prototype.$message({
                type:'success',
                message:resp.msg
            });
            router.replace({name:'notices'});
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 获取文章列表
export const getArticleList=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutArticle/getArticles.php',
        {
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateArticleList',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 获取单个文章
export const getArticle=({commit},artId)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutArticle/getArticleDetail.php',
        {
            article_id:artId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateArticle',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

export const getReplyList=({commit})=>{
    commit('updateReplyList');
}

export const deleteComment=({commit},commentId)=>{
    commit('deleteComment',commentId);
};
