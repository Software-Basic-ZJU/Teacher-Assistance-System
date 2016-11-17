import Vue from "vue";
import VueResource from "vue-resource";
import VueHead from "vue-head";
import ElementUI from "element-ui";
import 'element-ui/lib/theme-default/index.css';
import router from "./routes";
import store from "./vuex";

Vue.use(VueResource);
Vue.use(VueHead);
Vue.use(ElementUI);

const app=new Vue({
    router,
}).$mount('#App');