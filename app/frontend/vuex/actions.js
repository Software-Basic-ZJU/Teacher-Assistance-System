import router from "../routes";
import Vue from "vue";
import {LS} from "../helpers/utils";

export const updateUserInfo=({commit},userInfo)=>{
    commit('updateUserInfo',userInfo);
}

// 编辑器action转发
export const editorSubmit=({dispatch},payload)=>{
    console.log(payload);
    dispatch(payload.method,payload);
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
            commit('updateUserInfo',userInfo);
            Vue.http.headers.common["X-Access-Token"] = userInfo.token;
            if(resp.code==1 && userInfo.question1==''){   //判断是否有补全信息
                commit('showCompleteInfo',true);
            }
            else {
                LS.setItem('userInfo',resp.res);
                router.replace({name: 'App'});
                Vue.prototype.$message({
                    type: 'success',
                    message: resp.msg
                });
            }
        }
    }).then(()=>{
        commit('isLoading',false);
    });
};

// 补全学生个人信息
export const completeInfo=({state,commit},newInfo)=>{
    return new Promise((resolve,reject)=>{
        console.log(newInfo);
        Vue.http.post("backend/login/completeInfo.php",
            {
                student_id:state.userInfo.id,
                name:newInfo.name,
                email:newInfo.email,
                question1:newInfo.question1,
                question2:newInfo.question2,
                answer1:newInfo.answer1,
                answer2:newInfo.answer2
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code) {
                let userInfo=state.userInfo;
                userInfo.name=resp.res.name;
                userInfo.email=resp.res.email;
                userInfo.question1=resp.res.question1;
                userInfo.question2=resp.res.question2;
                LS.setItem('userInfo',userInfo);
                commit('updateUserInfo',userInfo);
                commit('showCompleteInfo',false);
                Vue.prototype.$message({
                    type:'success',
                    message:resp.msg
                });
                router.replace({name:'App'});
            }
        }).then(()=>{
            resolve();
        })
    })
};

// 修改学生与教师个人信息
export const editUserInfo=({commit},newInfo)=>{
    return new Promise((resolve,reject)=>{
        let userInfo=LS.getItem('userInfo');
        if(!userInfo || !userInfo.token) return commit('logout');
        Vue.http.post("backend/aboutInfo/editStuInfo.php",
            {
                id:newInfo.id,
                name:newInfo.name,
                email:newInfo.email,
                type:userInfo.type
            }
        ).then((response)=>{
            let resp=response.body;
            if(resp.code!=-1) {
                userInfo.name=resp.res.name;
                userInfo.email=resp.res.email;
                LS.setItem('userInfo',userInfo);
                commit('updateUserInfo',userInfo);
            }
        }).then(()=>{
            resolve();
        });
    })
};

// 未补全信息时显示表单
export const showCompleteInfo=({commit},signal)=>{
    commit('showCompleteInfo',signal);
};

// 获取问题(用于找回密码)
export const getIdenQues=({commit},userId)=>{
    return new Promise((resolve,reject)=>{
        Vue.http.post("backend/aboutInfo/getIdenQues.php",
            {
                id:userId
            }
        ).then((response)=>{
            let resp=response.body;
            if(resp.code!=-1) {
                let userInfo={
                    id:userId,
                    type:resp.res.type,
                    question1:resp.res.question1,
                    question2:resp.res.question2
                };
                commit('updateUserInfo',userInfo);
                commit('goFindStep',1);
            }
        }).then(()=>{
            resolve();
        });
    });
};

// 验证密保信息(用于找回密码)
export const checkQA=({state,commit},idenForm)=>{
    return new Promise((resolve,reject)=>{
        Vue.http.post("backend/aboutInfo/checkQA.php",
            {
                student_id:state.userInfo.id,
                question:idenForm.question,
                answer:idenForm.answer
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code) {
                commit('goFindStep',2);
            }
        }).then(()=>{
            resolve();
        });
    })
};

// 发送验证邮件(用于找回密码)
export const getEmail=({state,commit})=>{
    return new Promise((resolve,reject)=>{
        Vue.http.post("backend/aboutInfo/sendEmail.php",
            {
                id:state.userInfo.id,
                type:state.userInfo.type
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code) {
                Vue.prototype.$message({
                    type:'success',
                    message:resp.msg
                })
                commit('emailLoading',true)
            }
        }).then(()=>{
            resolve();
        });
    })
};

// 验证邮箱验证码
export const checkWithEmail=({state,commit},idenForm)=>{
    return new Promise((resolve,reject)=>{
        console.log(idenForm)
        Vue.http.post("backend/aboutInfo/checkWithEmail.php",
            {
                id:state.userInfo.id,
                type:state.userInfo.type,
                code:idenForm.idenCode
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code) {
                commit('goFindStep',2);
            }
        }).then(()=>{
            resolve();
        });
    })
};

// 设置新密码
export const setNewPassword=({state,commit},editForm)=>{
    return new Promise((resolve,reject)=>{
        Vue.http.post("backend/aboutInfo/changeForgetPassword.php",
            {
                id:state.userInfo.id,
                type:state.userInfo.type,
                newPassword:editForm.newPswd
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code) {
                commit('goFindStep',3);
            }
        }).then(()=>{
            resolve();
        });
    })
};

// 找回密码step修改
export const goFindStep=({commit},val)=>{
    commit('goFindStep',val);
};

// 获取邮件loading
export const emailLoading=({commit},signal)=>{
    commit('emailLoading',signal);
};

// 修改密码(根据新旧密码)
export const changePswd=({commit},editForm)=>{
    return new Promise((resolve,reject)=>{
        let userInfo=LS.getItem('userInfo');
        if(!userInfo || !userInfo.token) return commit('logout');
        Vue.http.post("backend/aboutInfo/changePassword.php",
            {
                id:userInfo.id,
                type:userInfo.type,
                oldPassword:editForm.oldPassword,
                newPassword:editForm.newPassword
            }
        ).then((response)=>{
            let resp=response.body;
            if(!resp.code) {
                Vue.prototype.$message({
                    type:'success',
                    message:'修改成功，请重新登录'
                });
                commit('logout');
            }
        }).then(()=>{
            resolve();
        });
    })
};

// 登出
export const logout=({commit})=>{
    commit('isLoading',false);
    commit('logout');
};