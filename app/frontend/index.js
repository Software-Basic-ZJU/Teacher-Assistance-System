import Vue from "vue";
import VueResource from "vue-resource";
import VueHead from "vue-head";
import ElementUI from "element-ui";
import 'element-ui/lib/theme-default/index.css';
import router from "./routes";
import store from "./vuex";
import {LS} from "./helpers/utils";

Vue.use(VueResource);
Vue.use(VueHead);
Vue.use(ElementUI);

Vue.config.debug=true;

//ajax config
Vue.http.options.root='/';
Vue.http.options.timeout=12000;
let userInfo=LS.getItem('userInfo');
Vue.http.headers.common['Access-Token']=userInfo?userInfo.token:'';

//timeout config
Vue.http.interceptors.push((req,next)=>{
    let hasTimeout;

    //timeout callback config
    if(req.timeout){
        hasTimeout=setTimeout(()=>{
            next(req.respondWith(req.body,{
                status:408,
                statusText:'Request Timeout'
            }))
        },req.timeout);
    }
    next((response)=>{
        clearTimeout(hasTimeout);
        if(!response.status) return;
        if(response.body.code==-1){     //身份不通过暂时设为-1
            //Todo
        }
    })
})


const app=new Vue({
    router,
    store
}).$mount('#App');