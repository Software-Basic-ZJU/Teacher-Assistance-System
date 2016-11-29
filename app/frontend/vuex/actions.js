import router from "../routes";

export const editorSubmit=({commit},payload)=>{
    console.log(payload)
    switch(payload.method){
        case 'addPost':break;
        case 'editPost':break;
        case 'addNotice':break;
        case 'editNotice':break;
        case 'addArticle':break;
        case 'editArticle':break;
        case 'editCourse':break;
        case 'editTeacher':break;
        case 'addQues':break;
        case 'editQues':break;
        default:break;
    }
};

export const login=({commit},loginForm)=>{
    //TODO 如果是首次登陆，则跳转至完成信息界面
    commit('showCompleteInfo',true);
    console.log(loginForm);
};

export const editUserInfo=({commit},newInfo)=>{
    console.log(newInfo)
};

export const showCompleteInfo=({commit},signal)=>{
    commit('showCompleteInfo',signal);
};

export const submitMoreInfo=({commit},moreInfo)=>{
    console.log(moreInfo);
}