export const toggleAddNotice=({commit})=>{
    commit('toggleAddNotice');
}

export const toggleEditNotice=({commit})=>{
    commit('toggleEditNotice');
}

export const getReplyList=({commit})=>{
    commit('updateReplyList');
}

export const deleteComment=({commit},commentId)=>{
    commit('deleteComment',commentId);
};

export const editContact=({commit},contact)=>{
    console.log(contact)
}