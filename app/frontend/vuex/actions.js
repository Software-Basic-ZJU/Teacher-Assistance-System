import router from "../routes";
import Vue from "vue";
import {LS} from "../helpers/utils";

export const editorSubmit=({dispatch,commit},payload)=>{
    console.log(payload);
    dispatch(payload.method,payload);
    // switch(payload.method){
    //     case 'addPost':
    //         dispatch('addPost',payload);
    //         break;
    //     case 'editPost':break;
    //     case 'addNotice':break;
    //     case 'editNotice':break;
    //     case 'addArticle':break;
    //     case 'editArticle':break;
    //     case 'editCourse':break;
    //     case 'editTeacher':break;
    //     case 'addQues':break;
    //     case 'editQues':break;
    //     default:break;
    // }
};

export const editorLoading=({commit},signal)=>{
    commit('editorLoading',signal)
};

// 变更是否已上传的状态
export const isFileUpload=({commit},signal)=>{
    commit('isFileUpload',signal);
};

export const login=({commit},loginForm)=>{
    commit('isLoading',true);
    Vue.http.post("backend/login/login.php",
        {
            id:loginForm.id,
            password:loginForm.password,
            type:loginForm.idenType
        }
    ).then((response)=>{
        let resp=response.body;
        if(resp.code!=-1) {
            let userInfo=resp.res;
            LS.setItem("userInfo",userInfo);
            if(resp.code==1){   //判断是否有补全信息
            }
            commit('updateUserInfo',userInfo);
            Vue.prototype.$message({
                type: 'success',
                message: resp.msg
            });
            router.replace({name: 'App'});
        }
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
};

export const logout=({commit})=>{
    commit('isLoading',false);
    commit('logout');
}