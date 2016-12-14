import Vue from "vue";
import {LS} from "../../../helpers/utils";
import router from "../../../routes";

export const showHwAction=({commit},signal)=>{
    commit('clearEditHwId');
    commit('showHwAction',signal);
};

export const showEditHw=({commit},hwId)=>{
    commit('showHwAction',true);
    commit('showEditHw',hwId);
};

// 获取作业列表
export const getHwList=({commit},classId)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutHW/getHwList.php',
        {
            class_id:classId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateHwList',resp.res.hwList);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 添加或编辑作业
export const addHw=({dispatch,commit,state},newHw)=>{
    console.log(newHw);
    commit('isHwLoading',true);
    if(!state.actionType) {
        Vue.http.post('backend/aboutHW/addHw.php',
            {
                class_id: newHw.classId,
                title: newHw.title,
                deadline: newHw.deadline,
                type: newHw.hwType,
                punish_type: newHw.punishType,
                punish_rate: newHw.punishRate
            }
        ).then((response) => {
            let resp = response.body;
            if (!resp.code) {
                dispatch('showHwAction', false);
                dispatch('getHwList', newHw.classId);
                Vue.prototype.$message({
                    type: 'success',
                    message: '添加作业成功'
                })
            }
        }).then(() => {
            commit('isHwLoading', false);
        })
    }
    else{
        Vue.http.post('backend/aboutHW/editHw.php',
            {
                hw_id:newHw.hw_id,
                class_id: newHw.classId,
                title: newHw.title,
                deadline:newHw.deadline,
                type:newHw.hwType,
                punish_type:newHw.punishType,
                punish_rate:newHw.punishRate
            }
        ).then((response)=> {
            let resp = response.body;
            if (!resp.code) {
                dispatch('showHwAction',false);
                dispatch('getHwList',newHw.classId);
                Vue.prototype.$message({
                    type:'success',
                    message:'修改作业成功'
                })
            }
        }).then(()=> {
            commit('isHwLoading', false);
        })
    }
};

// 删除作业
export const deleteHw=({commit},hwId)=>{
    commit('isHwLoading',true);
    Vue.http.post('backend/aboutHW/deleteHw.php',
        {
            hw_id:hwId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('deleteHwItem',hwId);
            Vue.prototype.$message({
                type:'success',
                message:'删除成功'
            })
        }
    }).then(()=>{
        commit('isHwLoading',false);
    })
};

// 获取问题列表
export const getQuesList=({commit},hwId)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutQues/getQuesList.php',
        {
            hw_id:hwId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateHwDetail',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 查看单个问题
export const getQuesDetail=({commit},quesId)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutQues/getQuesDetail.php',
        {
            ques_id:quesId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            console.log(resp.res);
            commit('updateQuesDetail',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 添加问题
export const addQues=({dispatch,commit},payload)=>{
    commit('editorLoading',true);
    Vue.http.post('backend/aboutQues/addQues.php',
        {
            hw_id:payload.routeParams.hwId,
            title:payload.data.title,
            content:payload.data.content
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            dispatch('getQuesList',payload.routeParams.hwId);
            router.replace({
                name:'hwDetail',
                params:{
                    classId:payload.routeParams.classId,
                    hwId:payload.routeParams.hwId
                }
            })
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

// 编辑问题
export const editQues=({dispatch,commit},payload)=>{
    commit('editorLoading',true);
    Vue.http.post('backend/aboutQues/addQues.php',
        {
            ques_id:payload.ques_id,
            title:payload.data.title,
            content:payload.data.content,
            type:payload.data.type
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            dispatch('getQuesList',payload.routeParams.hwId);
            router.replace({
                name:'hwDetail',
                params:{
                    classId:payload.routeParams.classId,
                    hwId:payload.routeParams.hwId
                }
            })
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

//删除问题
export const removeQues=({commit},quesId)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutQues/removeQues.php',
        {
            ques_id:quesId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('removeQues',quesId);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 获得某个学生的作业
export const getStuWork=({commit},payload)=>{
    commit('isLoading',true);
    Vue.http.post('backend/aboutWork/getStuWork.php',
        {
            ques_id:payload.quesId,
            uploader_id:payload.sid
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            console.log(resp.res);
            commit('updateStuWork',resp.res);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 提交作业
export const submitHw=({commit},payload)=>{
    let userInfo=LS.getItem('userInfo');
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('editorLoading',true);
    Vue.http.post('backend/aboutWork/submitWork.php',
        {
            ques_id:payload.routeParams.quesId,
            uploader_id:userInfo.id,
            content:payload.data.content,
            resrc_id:payload.data.resrcId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            Vue.prototype.$message({
                type:'success',
                message:'提交成功'
            });
            commit('isSubmitFile',false);
        }
    }).then(()=>{
        commit('editorLoading',false);
    })
};

// 更新是否上传附件的状态
export const isSubmitFile=({commit},signal)=>{
    commit('isSubmitFile',signal);
};

// 批改作业并提交
export const submitReview=({commit},markForm)=>{
    commit('isHwLoading',true);
    Vue.http.post('backend/aboutWork/correctWork.php',
        {
            work_id:markForm.workId,
            score:markForm.score,
            reply:markForm.reply
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            Vue.prototype.$message({
                type:'success',
                message:'批改成功'
            });
        }
    }).then(()=>{
        commit('isHwLoading',false);
    })
};

// 提交成绩（提交后不能再更改分数）
export const finishQues=({dispatch,commit},quesId)=>{
    commit('isHwLoading',true);
    Vue.http.post('backend/aboutQues/finishQues.php',
        {
            ques_id:quesId
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            Vue.prototype.$message({
                type:'success',
                message:'提交成绩成功'
            });
            dispatch('getQuesDetail',quesId);
        }
    }).then(()=>{
        commit('isHwLoading',false);
    })
};

