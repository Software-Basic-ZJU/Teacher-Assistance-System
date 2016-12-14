import Vue from 'vue';
import * as actions from "./actions";


const state={
    loading:false,
    courseInfo:{
        content:''
    },
    teacherInfo:{
        content:''
    }
};

const mutations={
    updateCourseInfo(state,courseInfo){
        state.courseInfo.content=courseInfo;
    },
    updateTeacherInfo(state,teacherInfo){
        state.teacherInfo.content=teacherInfo;
    }
};

export default {
    state,
    actions,
    mutations
}