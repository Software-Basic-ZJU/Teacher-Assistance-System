import Vue from "vue";
import {LS} from "../../../helpers/utils";
import router from "../../../routes";

// 获取课程信息
export const getCourseInfo=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('aboutInfo/getCourseInfo.php',
        {
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateCourseInfo',resp.res.course_info);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 编辑课程信息
export const editCourseInfo=({commit},payload)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('aboutInfo/editCourseInfo.php',
        {
            course_info:payload.data.content,
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateCourseInfo',resp.res.course_info);
            router.replace({name:'course'});
        }
    }).then(()=>{
        commit('isLoading',false);
    })
}

// 获取教师简介
export const getTeacherInfo=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('aboutInfo/getTeacherInfo.php',
        {
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateTeacherInfo',resp.res.teacher_info);
        }
    }).then(()=>{
        commit('isLoading',false);
    })
};

// 编辑教师简介
export const editTeacherInfo=({commit},payload)=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('aboutInfo/editTeacherInfo.php',
        {
            teacher_info:payload.data.content,
            teacher_id:userInfo.teacher_id
        }
    ).then((response)=>{
        let resp=response.body;
        if(!resp.code){
            commit('updateTeacherInfo',resp.res.teacher_info);
            router.replace({name:'teacher'});
        }
    }).then(()=>{
        commit('isLoading',false);
    })
}
