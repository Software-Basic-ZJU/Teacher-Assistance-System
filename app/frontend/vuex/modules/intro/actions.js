import Vue from "vue";
import {LS} from "../../../helpers/utils";

// 获取课程信息
export const getCourseInfo=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutInfo/getCourseInfo.php',
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

// 获取教师简介
export const getTeacherInfo=({commit})=>{
    let userInfo=LS.getItem("userInfo");
    if(!userInfo || !userInfo.token) return commit('logout');
    commit('isLoading',true);
    Vue.http.post('backend/aboutInfo/getTeacherInfo.php',
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

export const editCourseInfo=({commit},payload)=>{
    commit('updateCourseInfo');
};

export const editTeacherInfo=({commit},payload)=>{
    commit('updateTeacherInfo');
}