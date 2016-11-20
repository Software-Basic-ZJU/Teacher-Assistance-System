import Vue from "vue";
import Vuex from "vuex";
import * as getters from "./getters";
import info from "./modules/info";
import intro from "./modules/intro";
import resource from "./modules/resource";
import homework from "./modules/homework";
import forum from "./modules/forum";

Vue.use(Vuex);

export default new Vuex.Store({
    getters,
    modules:{
        info,
        intro,
        resource,
        homework,
        forum
    }
})