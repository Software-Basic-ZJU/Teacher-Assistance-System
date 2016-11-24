import router from '../../../routes';

export const showEditResrc=({commit},payload)=>{
    commit('showEditResrc',payload);
}

export const closeEditResrc=({commit},payload)=>{
    commit('closeEditResrc');
}

export const uploadResrc=({commit})=>{
    commit('uploadResrc');
}

export const submitResrc=({commit})=>{
    commit('submitResrc');
}

export const cancelAddResrc=({commit})=>{
    commit('cancelAddResrc');
    router.go(-1);
}

export const resrcFilter=({commit},index)=>{
    commit('resrcFilter',index);
}