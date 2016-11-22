import Vue from 'vuex';

export const createGroup=({commit},group)=>{
    group.memberList=['test','test'];
    commit('addGroup',group);
}

export const joinGroup=({commit},group)=>{
    group.name="Lowes";
    commit('joinGroup',{
        id:group.id,
        name:group.name
    })
}

export const showActionGroup=({commit})=>{
    commit('showCreateGroup');
}

export const closeActionGroup=({commit})=>{

}