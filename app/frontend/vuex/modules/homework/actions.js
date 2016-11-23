export const showHwAction=({commit})=>{
    commit('showHwAction');
};

export const closeHwAction=({commit})=>{
    commit('closeHwAction');
};

export const showEditHw=({commit},hwId)=>{
    commit('showHwAction');
    commit('showEditHw',hwId);
};

export const submitHw=({commit},payload)=>{
    console.log(payload);
};

export const submitReview=({commit},markForm)=>{
    console.log(markForm);
}