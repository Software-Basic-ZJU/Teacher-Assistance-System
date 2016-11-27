export const updateMailType=({commit},type)=>{
    commit('showToSend',false);
    commit('updateMailType',type);
};

export const showMailDetail=({commit},signal)=>{
    commit('showMailDetail',signal);
};

export const showToSend=({commit},signal)=>{
    commit('showToSend',signal);
};

export const getCurrMail=({commit},mailId)=>{
    commit('showMailDetail',true);
    commit('getCurrMail',mailId);
};

//回复信件时对待发送的信件表单进行更新
export const replyMail=({commit},mail)=>{
    commit('showMailDetail',false);
    commit('showToSend',true);
    commit('updateMailForm',mail);
}