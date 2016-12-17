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
            delete resp.res.token;      //移除token项
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
            other_contact:contact.other_contact
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            delete resp.res.token;
            userInfo.email=resp.res.email;
            commit('updateUserInfo',userInfo);
            LS.setItem('userInfo',userInfo);
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
            commit('updateNoticeList',resp.res.notices);
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
    if(newNotice.title==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'标题不能为空'
        })
    }
    if(newNotice.content==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'内容不能为空'
        })
    }
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
    if(newNotice.title==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'标题不能为空'
        })
    }
    if(newNotice.content==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'内容不能为空'
        })
    }
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
            commit('updateArticleList',resp.res.articles);
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

// 发表文章
export const addArticle=({commit},payload)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    let newArticle=payload.data;
    if(newArticle.title==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'标题不能为空'
        })
    }
    if(newArticle.content==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'内容不能为空'
        })
    }
    if(newArticle.author==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'作者不能为空'
        })
    }
    commit('isLoading',true);
    Vue.http.post('backend/aboutArticle/addArticle.php',
        {
            title:newArticle.title,
            content:newArticle.content,
            author:newArticle.author,
            authority:newArticle.authority?1:0,
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            router.push({name:'articleDetail',params:{artId:resp.res.article_id}})
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 修改文章
export const editArticle=({commit},payload)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    let newArticle=payload.data;
    if(newArticle.title==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'标题不能为空'
        })
    }
    if(newArticle.content==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'内容不能为空'
        })
    }
    if(newArticle.author==''){
        return Vue.prototype.$message({
            type:'warning',
            message:'作者不能为空'
        })
    }
    commit('isLoading',true);
    Vue.http.post('backend/aboutArticle/editArticle.php',
        {
            article_id:payload.routeParams.artId,
            title:newArticle.title,
            content:newArticle.content,
            author:newArticle.author,
            authority:newArticle.authority?1:0,
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            router.replace({name:'articleDetail',params:{artId:payload.routeParams.artId}});
        }
    }).then(()=>{
        commit('isLoading',false);
    })
}

// 删除文章
export const removeArticle=({commit},artId)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutArticle/deleteArticle.php',
        {
            article_id:artId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            router.replace({name:'articles'})
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 回复文章
export const replyArticle=({commit},payload)=>{
    return new Promise((resolve,reject)=>{
        Vue.http.post('backend/aboutComment/addComment.php',
            {
                target_id:payload.artId,
                content:payload.content,
                author_id:payload.authorId,
                type:0
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code){
                Vue.prototype.$message({
                    type:'success',
                    message:resp.msg
                });
                commit('isReplyShow',false);
                commit('addComment',resp.res);
                resolve();
            }
        },()=>{
            reject();
        })
    })
};

// 删除回复
export const removeComment=({commit},comId)=>{
    return new Promise((resolve,reject)=>{
        Vue.http.post('backend/aboutComment/deleteComment.php',
            {
                com_id:comId
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code){
                Vue.prototype.$message({
                    type:'success',
                    message:resp.msg
                });
                commit('removeComment',comId);
            }
        }).then(()=>{
            resolve();
        })
    })
}

// 是否显示回复框
export const isReplyShow=({commit},signal)=>{
    commit('isReplyShow',signal);
};

// 通知列表跳转至某一页
export const changeNotePage=({commit},val)=>{
    commit('changeNotePage',val);
};

// 文章列表跳转至某一页
export const changeArtPage=({commit},val)=>{
    commit('changeArtPage',val);
};


export const getReplyList=({commit})=>{
    commit('updateReplyList');
}
