import * as actions from "./actions";

const state={
    loading:false,
    receivedList:[
        {
            mailId:123,
            isRead:0,
            srcId:3140103367,
            srcName:'LowesYang',
            title:'haha hello ',
            content:'worlddsfdsfdsfdsfsdfsdfsdf',
            time:'2016-10-12 12:44:22'
        },
        {
            mailId:123,
            isRead:1,
            srcId:3140103367,
            srcName:'LowesYang',
            title:'haha hello world',
            content:'worlddsfdsfdsfdsfsdfsdfsdf',
            time:'2016-10-12 12:44:22'
        }
    ],
    sendedList:[
        {
            mailId:555,
            destId:322,
            destName:'Yang',
            title:'haha hello ',
            content:'worlddsfdsfdsfdsfsdfsdfsdf',
            time:'2016-10-12 12:44:22'
        },
        {
            mailId:123,
            destId:432,
            destName:'Yang',
            title:'haha hel world',
            content:'worlddsfdsfdsfdsfsdfsdfsdf',
            time:'2016-10-12 12:44:22'
        }
    ],
    mailListType:0,         //0为收件箱，1为已发送信件
    detailShow:false,       //信件详情显示开关
    toSend:false,           //发送信件页面显示开关
    currMail:{},
    mailForm:{
        destId:'',
        title:'',
        content:''
    }
}

const mutations={
    updateMailType(state,type){
        state.mailListType=type;
    },
    showMailDetail(state,signal){
        state.detailShow=signal;
    },
    getCurrMail(state,mailId){
        let list=[];
        if(!state.mailListType) list=state.receivedList;
        else list=state.sendedList;

        for(let i=0;i<list.length;i++){
            if(list[i].mailId==mailId){
                state.currMail=list[i];
                break;
            }
        }
    },
    showToSend(state,signal){
        state.toSend=signal;
    },
    //回复信件时对待发送的信件表单进行更新
    updateMailForm(state,mail){
        state.mailForm.destId=mail.destId;
        state.mailForm.title='回复 '+mail.srcName+'：'+mail.title;
        state.mailForm.title='';
    }
}

export default {
    state,
    actions,
    mutations
}