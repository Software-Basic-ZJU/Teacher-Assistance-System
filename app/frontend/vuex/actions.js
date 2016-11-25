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
}

export const login=({commit},loginForm)=>{
    console.log(loginForm);
}