import Vue from "vue";
import VueResource from "vue-resource";
import VueHead from "vue-head";
import ElementUI from "element-ui";
import './theme/index.css';
import './normalize.css';
import router from "./routes";
import store from "./vuex";
import {LS} from "./helpers/utils";

Vue.use(VueResource);
Vue.use(VueHead);
Vue.use(ElementUI);
Vue.use(VueHead);

Vue.config.debug=true;

//ajax config
Vue.http.options.root='backend';         //server config
// Vue.http.options.root='http://localhost:8000/backend';  //local config
Vue.http.options.timeout=12000;
Vue.http.options.emulateJSON = true;        //php cannot resolve json directly.
let userInfo=LS.getItem('userInfo');
Vue.http.headers.common['X-Access-Token']=userInfo?userInfo.token:'';

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
        if(!response.status){       //error回调
            Vue.prototype.$message({
                type:'error',
                message:'请检查网络配置'
            });
            return;
        }
        if(response.status==408){      //超时回调
            Vue.prototype.$message({
                type:'error',
                message:'请求超时，请稍后重试'
            });
            return;
        }
        if(!response.body){
            Vue.prototype.$message({
                type:'error',
                message:'系统错误，返回体为null值'
            })
        }
        else if(response.body.code== -1){       //请求错误码统一处理
            Vue.prototype.$message({
                type:'error',
                message:response.body.msg
            });
        }
        else if(response.body.code==403){   //身份不通过设为403
            Vue.prototype.$message({
                type:'error',
                message:response.body.msg
            });
            LS.clear();
            router.push({name:'login'});
            store.dispatch('logout');
            return;
        }
        else{
            if(response.body.res && response.body.res.token) {      //更新token
                let userInfo=LS.getItem("userInfo") || {};
                if(userInfo && userInfo.token) {
                    userInfo.token = response.body.res.token;
                    Vue.http.headers.common["X-Access-Token"] = response.body.res.token;
                    LS.setItem("userInfo", userInfo);
                }
                //刚登录时无token，由相应action作特别处理
            }
        }
    })
})


const app=new Vue({
    router,
    store
}).$mount('#App');