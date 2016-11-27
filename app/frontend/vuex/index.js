import Vue from "vue";
import Vuex from "vuex";
import * as getters from "./getters";
import * as actions from "./actions";
import info from "./modules/info";
import intro from "./modules/intro";
import resource from "./modules/resource";
import homework from "./modules/homework";
import forum from "./modules/forum";
import group from "./modules/group";
import mail from "./modules/mail";
import TAmanage from "./modules/TAmanage";

Vue.use(Vuex);

const state={
    isLogin:false,
    userInfo:{
        id:'123456',
        name:'LowesYang',
        identify:0,
        classId:'143',
        className:'mmm',
        teacherId:'12356',
        email:'234347589@qq.com',
        groupId:'163',
        question1:'你的家乡在哪里',
        question2:'你几岁了',
        answer1:'柳州',
        answer2:'21'
    }
};

const mutations={
    
};

export default new Vuex.Store({
    state,
    getters,
    actions,
    mutations,
    modules:{
        info,
        intro,
        resource,
        homework,
        forum,
        group,
        mail,
        TAmanage
    }
})