export const toggleAddNotice=({commit})=>{
    commit('toggleAddNotice');
}

export const toggleEditNotice=({commit})=>{
    commit('toggleEditNotice');
}

export const deleteComment=({commit},commentId)=>{
    commit('deleteComment',commentId);
}