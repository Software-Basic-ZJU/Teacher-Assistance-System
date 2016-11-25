export const loading=state=>(
    state.info.loading&&state.intro.loading&&state.resource.loading
    &&state.homework.loading&&state.forum.loading&&state.member.loading
);

export const resrcList=state=>(
    state.resource.resrcFilter==1?state.resource.teachResrcList:state.resource.stuResrcList
);

export const mailList=state=>(
    !state.mail.mailListType?state.mail.receivedList:state.mail.sendedList
)