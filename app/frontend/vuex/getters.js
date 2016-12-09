import moment from "moment";

export const loading=state=>state.loading;

export const noticeList=state=>(
    state.info.noticeList.sort((itemA,itemB)=>{
        return moment(itemA.time)<moment(itemB.time)
    })
);

export const resrcList=state=>(
    state.resource.resrcFilter==1?state.resource.teachResrcList:state.resource.stuResrcList
);

export const mailList=state=>(
    !state.mail.mailListType?state.mail.receivedList:state.mail.sendedList
);