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
import {LS} from "../helpers/utils";
import router from "../routes";

Vue.use(Vuex);

const state={
    loading:false,                 //全局loading state,遮盖主体.各组件中有局部loading
    isLogin:false,
    userInfo:{},                    //身份为老师或助教时，class_id为数组
    showCompleteInfo:false,        //补全信息对话框显示开关
    editorLoading:false,           //编辑器的loading
    isFileUpload:false,            //检测编辑器中是否已有文件上传
    checkStep:0,                    //找回密码step，分0,1,2,3。3为结果态
};

const mutations={
    isLoading(state,signal){
        state.loading=signal;
    },
    updateUserInfo(state,userInfo){
        state.userInfo=userInfo;
    },
    showCompleteInfo(state,signal){
        state.showCompleteInfo=signal;
    },
    logout(state){
        state.isLogin=false;
        LS.clear();
        router.push({name:'login'});
    },
    editorLoading(state,signal){        //编辑器Loading状态
        state.editorLoading=signal;
    },
    isFileUpload(state,signal){
        state.isFileUpload=signal;
    },
    goFindStep(state,val){
        state.checkStep=val;
    }
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