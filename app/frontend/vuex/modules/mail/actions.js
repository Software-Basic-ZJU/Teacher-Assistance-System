import Vue from "vue";
import {LS} from "../../../helpers/utils";

// 切换收件箱与发件箱
export const updateMailType=({commit},type)=>{
    commit('showToSend',false);
    commit('updateMailType',type);
};

// 是否显示信件详情页
export const showMailDetail=({commit},signal)=>{
    commit('showMailDetail',signal);
};

// 是否显示发送私信页
export const showToSend=({commit},signal)=>{
    commit('showToSend',signal);
};

// 获取收件箱邮件
export const getRecMail=({commit})=>{
    let userInfo=LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('mailLoading',true);
    Vue.http.post('backend/aboutMail/getRecMail.php',
        {
            dest_id:userInfo.id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateRecList',resp.res.mails);
        }
    }).then(()=>{
        commit('mailLoading',false);
    })
};

// 获取发件箱邮件
export const getSendMail=({commit})=>{
    let userInfo=LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('mailLoading',true);
    Vue.http.post('backend/aboutMail/getSendMail.php',
        {
            src_id:userInfo.id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateSendedList',resp.res.mails);
        }
    }).then(()=>{
        commit('mailLoading',false);
    })
};

// 阅读邮件
export const getCurrMail=({commit,state},mailId)=>{
    let isRead=false;       //是否已读
    let isSended=true;     //是否是阅读发件箱
    state.receivedList.forEach((item)=>{
        if(item.mail_id==mailId){
            isSended=false;
            isRead=item.is_read==1;
            return;
        }
    });
    if(!isRead && !isSended) {
        commit('mailLoading', true);
        Vue.http.post('backend/aboutMail/readMail.php',
            {
                mail_id: mailId
            }
        ).then((response)=> {
            let resp = response.body;
            if (!resp.code) {
                commit('showMailDetail', true);
                commit('getCurrMail', mailId);
            }
        }).then(()=> {
            commit('mailLoading', false);

        });
    }
    else{
        commit('showMailDetail', true);
        commit('getCurrMail', mailId);
    }
};

// 删除邮件
export const removeMail=({dispatch,commit},mailId)=>{
    commit('mailLoading', true);
    Vue.http.post('backend/aboutMail/deleteMail.php',
        {
            mail_id: mailId
        }
    ).then((response)=> {
        let resp = response.body;
        if (!resp.code) {
            commit('removeMail',mailId);
            dispatch('showMailDetail',false);
        }
    }).then(()=> {
        commit('mailLoading', false);
    });
};

//回复信件时对待发送的信件表单进行更新
export const replyMail=({commit},mail)=>{
    commit('showMailDetail',false);
    commit('showToSend',true);
    commit('updateMailForm',mail);
};

// 发送私信
export const sendMail=({commit},mail)=>{
    let userInfo=LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('mailLoading', true);
    Vue.http.post('backend/aboutMail/sendMail.php',
        {
            src_id:userInfo.id,
            dest_id:mail.destId,
            title:mail.title,
            content:mail.content
        }
    ).then((response)=> {
        let resp = response.body;
        if (!resp.code) {
            Vue.prototype.$message({
                type:'success',
                message:resp.msg
            });
            commit('showToSend',false);
            commit('addSendedList',resp.res);
            commit('clearMailForm');
        }
    }).then(()=> {
        commit('mailLoading', false);
    });
};


// 翻页
export const changeMailPage=({commit},val)=>{
    commit('changeMailPage',val);
};