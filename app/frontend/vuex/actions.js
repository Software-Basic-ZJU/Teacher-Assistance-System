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
    console.log(loginForm);
    commit('isLoading',true);

    Vue.http.post("backend/login/login.php",
        {
            id:loginForm.id,
            password:loginForm.password,
            type:loginForm.idenType
        }
    ).then((response)=>{
        let resp=response.body;

        console.log(resp);
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
            type:'error',
            message:"请检查网络配置!"
        });
    }).then(()=>{
        commit('isLoading',false);
    });
    // console.log(loginForm);
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