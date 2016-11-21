export const getPostList=({commit},info)=>{
    commit('updatePostList',info);
};

export const publish=({commit},info)=>{
    commit('publish',info);
}
