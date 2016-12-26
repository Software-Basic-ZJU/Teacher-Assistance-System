import moment from "moment";

export const loading=state=>state.loading;

// 获取通知列表，按时间排序
export const noticeList=state=> {
    let noticeList=state.info.noticeList.sort((itemA, itemB)=> {
        return moment(itemA.time).format('x') < moment(itemB.time).format('x')
    });
    return noticeList.slice(15*(state.info.noticeCurrPage-1),15*state.info.noticeCurrPage);
};

// 获取文章列表，按时间排序
export const articleList=(state)=> {
    let articleList=state.info.articleList.filter((item)=>(
        item.title.indexOf(state.info.keywords)>=0
    ));
    articleList=articleList.sort((itemA, itemB)=> {
        return moment(itemA.time).format('x') < moment(itemB.time).format('x')
    });
    return articleList.slice(8*(state.info.articleCurrPage-1),8*state.info.articleCurrPage);
};

// 获取资源列表，按时间排序
export const resrcList=state=>{
    let resrcList=state.resource.resrcFilter==0?state.resource.teachResrcList:state.resource.stuResrcList
    return resrcList.sort((itemA,itemB)=>(
        moment(itemA.upload_time).format('x') < moment(itemB.upload_time).format('x')
    ));
};

// 获取帖子列表，按时间排序
export const postList=state=>{
    let postList=state.forum.postList.sort((itemA,itemB)=>(
        moment(itemA.update_time).format('x') < moment(itemB.update_time).format('x')
    ));
    return postList.slice(8*(state.forum.currPage-1),8*state.forum.currPage);
}

// 获取信件个数
export const mailNum=state=>(
    state.mail.mailListType==0?state.mail.receivedList.length:state.mail.sendedList.length
);

//获取信件列表
export const mailList=state=> {
    let mailList=state.mail.mailListType==0? state.mail.receivedList : state.mail.sendedList;
    return mailList.slice(9*(state.mail.currPage-1),9*state.mail.currPage);
};

//返回是否有未读邮件
export const mailUnRead=state=>{
    let hasUnRead=false;
    state.mail.receivedList.forEach((item)=>{
        if(item.is_read==0){
            hasUnRead=true;
            return;
        }
    })
    return hasUnRead;
    
}