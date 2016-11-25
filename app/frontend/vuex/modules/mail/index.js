import * as actions from "./actions";

const state={
    loading:false,
    receivedList:[
        {
            mailId:123,
            isRead:0,
            sender:'LowesYang',
            title:'haha hello worlddsfdsfdsfdsfsdfsdfsdf',
            datetime:'2016-10-12 12:44:22'
        },
        {
            mailId:123,
            isRead:1,
            sender:'LowesYang',
            title:'haha hello world',
            datetime:'2016-10-12 12:44:22'
        }
    ],
    sendedList:[
        {
            mailId:555,
            sender:'Yang',
            title:'haha hello ',
            datetime:'2016-10-12 12:44:22'
        },
        {
            mailId:123,
            sender:'Yang',
            title:'haha hel world',
            datetime:'2016-10-12 12:44:22'
        }
    ],
    mailListType:0,         //0为收件箱，1为已发送信件
}

const mutations={
    updateMailType(state,type){
        state.mailListType=type;
    }
}

export default {
    state,
    actions,
    mutations
}