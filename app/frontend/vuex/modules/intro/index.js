import Vue from 'vue';
import * as actions from "./actions";

const state={
    loading:false,
    courseInfo:{
        content:'<h5>dfsd</h5>'
    },
    teacherInfo:{
        content:'fffff'
    }
};

const mutations={
    updateCourseInfo(state){

    },
    updateTeacherInfo(state){

    }
};

export default {
    state,
    actions,
    mutations
}