export const showAddHw=({commit})=>{
    commit('showAddHw');
};

export const closeAddHw=({commit})=>{
    commit('closeAddHw');
};

export const showEditHw=({commit},hwId)=>{
    commit('showEditHw',hwId);
}

export const closeEditHw=({commit},hwId)=>{
    commit('closeEditHw',hwId);
}

export const addHw=({commit},payload)=>{
    commit('addHw',payload);
}

export const editHw=({commit},payload)=>{
    commit('editHw',payload);
}