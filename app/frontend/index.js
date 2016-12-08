import Vue from "vue";
import VueResource from "vue-resource";
import VueHead from "vue-head";
import ElementUI from "element-ui";
import '../theme/index.css';
import router from "./routes";
import store from "./vuex";
import {LS} from "./helpers/utils";

Vue.use(VueResource);
Vue.use(VueHead);
Vue.use(ElementUI);

Vue.config.debug=true;

//ajax config
Vue.http.options.root='http://localhost:8000/';
Vue.http.options.timeout=12000;
Vue.http.options.emulateJSON = true;        //php cannot resolve json directly.
let userInfo=LS.getItem('userInfo');
Vue.http.headers.common['x-access-token']=userInfo?userInfo.token:'';

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
            Vue.prototype.$message({
                type:'error',
                message:response.body.msg
            })
        }
    })
})


const app=new Vue({
    router,
    store
}).$mount('#App');