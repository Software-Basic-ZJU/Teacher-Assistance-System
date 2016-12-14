import moment from "moment";
import Vue from "vue";

//extend localstorage,and support json
export const LS={
    setItem(key,value){
        if(typeof value=='object') value=JSON.stringify(value);
        localStorage.setItem(key,value);
    },
    getItem(key){
        let temp=localStorage.getItem(key);
        let res=null;
        if(res=JSON.parse(temp)) return res;
        return temp;
    },
    removeItem(key){
        localStorage.removeItem(key);
    },
    clear(){
        Vue.http.headers.common['x-access-token']="";
        localStorage.clear();
    }
};

