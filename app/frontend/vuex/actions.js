import router from "../routes";
import Vue from "vue";

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
    commit('isLoading',true);
    //TODO 如果是首次登陆，则跳转至完成信息界面

    Vue.http("/backend/login.php",
        {
            id:loginForm.id,
            password:loginForm.password,
            type:loginForm.idenType
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){

        }
        else if(resp.code==1){

        }
        else if(resp.code==2){

        }
        else if(resp.code==3){

        }
    },(response)=>{
        Vue.prototype.$message({
            type:'danger',
            message:"请检查网络配置!"
        });
    }).then(()=>{
        commit('isLoading',false);
    });
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