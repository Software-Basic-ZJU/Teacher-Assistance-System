export const showEdit=({commit},payload)=>{
    commit('showEdit',payload);
}

export const closeEdit=({commit},payload)=>{
    commit('closeEdit');
}

export const uploadResrc=({commit})=>{
    commit('uploadResrc');
}

export const submitResrc=({commit})=>{
    commit('submitResrc');
}

export const cancelAdd=({commit})=>{
    commit('cancelAdd')
}