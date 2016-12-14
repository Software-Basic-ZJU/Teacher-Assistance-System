import moment from "moment";

export const loading=state=>state.loading;

export const noticeList=state=> {
    let noticeList=state.info.noticeList.sort((itemA, itemB)=> {
        return moment(itemA.time).valueOf() > moment(itemB.time).valueOf()
    });
    return noticeList.slice(15*(state.info.noticeCurrPage-1),15*state.info.noticeCurrPage);
};

export const articleList=(state)=> {
    let articleList=state.info.articleList.sort((itemA, itemB)=> {
        return moment(itemA.time).valueOf() > moment(itemB.time).valueOf()
    });
    return articleList.slice(8*(state.info.articleCurrPage-1),8*state.info.articleCurrPage);
}

export const resrcList=state=>{
    let resrcList=state.resource.resrcFilter==1?state.resource.teachResrcList:state.resource.stuResrcList
    return resrcList.sort((itemA,itemB)=>(
        moment(itemA.uploader_name).valueOf()>moment(itemB.uploader_name).valueOf()
    ));
};

export const mailList=state=>(
    !state.mail.mailListType?state.mail.receivedList:state.mail.sendedList
);