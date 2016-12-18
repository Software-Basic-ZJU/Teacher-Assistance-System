import * as actions from "./actions";

const state={
    loading:false,
    receivedList:[],        //收件箱邮件
    sendedList:[],          //发件箱邮件
    mailListType:'0',         //0为收件箱，1为已发送信件,2为发私信页面
    detailShow:false,       //信件详情显示开关
    toSend:false,           //发送信件页面显示开关
    currMail:{},
    mailForm:{
        destId:'',
        title:'',
        content:''
    },
    currPage:1,              //当前页数
}

const mutations={
    mailLoading(state,signal){
        state.loading=signal;
    },
    updateMailType(state,type){
        state.mailListType=type;
    },
    showMailDetail(state,signal){
        state.detailShow=signal;
    },
    updateRecList(state,mailList){
        state.receivedList=mailList
    },
    updateSendedList(state,mailList){
        state.sendedList=mailList
    },
    getCurrMail(state,mailId){
        let list=[];
        if(state.mailListType==0) list=state.receivedList;
        else if (state.mailListType==1) list=state.sendedList;

        list.forEach((item)=>{
            if(item.mail_id==mailId){
                state.currMail=item;
                if(item.is_read) {
                    item.is_read = 1;
                }
                return;
            }
        });
    },
    showToSend(state,signal){
        state.toSend=signal;
    },
    updateMailForm(state,mail){        //回复信件时对待发送的信件表单进行更新
        state.mailForm= {
            destId: mail.src_id,
            title: '回复 ' + mail.src_name + '：' + mail.title,
            content: ''
        };
    },
    clearMailForm(state){
        state.mailForm={
          destId:'',
          title:'',
          content:''
        }
    },
    changeMailPage(state,val){
        state.currPage=val;
    },
    addSendedList(state,newMail){
        state.sendedList.push(newMail);
    },
    removeMail(state,mailId){
        let list=[];
        if(state.mailListType==0) list=state.receivedList;
        else if(state.mailListType==1) list=state.sendedList;

        list.forEach((item,index)=>{
            if(item.mail_id==mailId){
                list.splice(index,1);
                return;
            }
        })
    }

}

export default {
    state,
    actions,
    mutations
}