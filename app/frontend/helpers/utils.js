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

// export function HTMLDecode(str){
//     let s="";
//     if(str.length==0) return "";
//     s = str.replace(/&amp;/g,"&");
//     s = s.replace(/&lt;/g, " <");
//     s = s.replace(/&gt;/g,">");
//     s = s.replace(/&nbsp;/g," ");
//     s = s.replace(/'/g,"\'");
//     s = s.replace(/&quot;/g,"\"");
//     s = s.replace(/ <br>/g,"\n");
//     return s;
// }

export function HTMLFilter(str){
    return str.replace(/<\/?[^>]+>/g,"");
}

