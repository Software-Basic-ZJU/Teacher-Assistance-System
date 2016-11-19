export const App=resolve=>{
    require.ensure(['../components/App.vue'],()=>{
        resolve(require('../components/App.vue'))
    })
};

export const Info=resolve=>{
    require.ensure(['../components/Info/Info.vue'],()=>{
        resolve(require('../components/Info/Info.vue'))
    })
};

export const Intro=resolve=>{
    require.ensure(['../components/Intro/Intro.vue'],()=>{
        resolve(require('../components/Intro/Intro.vue'))
    })
};

export const Resource=resolve=>{
    require.ensure(['../components/Resource/Resource.vue'],()=>{
        resolve(require('../components/Resource/Resource.vue'))
    })
};

export const Homework=resolve=>{
    require.ensure(['../components/Homework/Homework.vue'],()=>{
        resolve(require('../components/Homework/Homework.vue'))
    })
};

export const hwList=resolve=>{
    require.ensure(['../components/Homework/hw/hwList.vue'],()=>{
        resolve(require('../components/Homework/hw/hwList.vue'))
    })
};

export const hwDetail=resolve=>{
    require.ensure(['../components/Homework/hw/hwDetail.vue'],()=>{
        resolve(require('../components/Homework/hw/hwDetail.vue'))
    })
};

export const quesDetail=resolve=>{
    require.ensure(['../components/Homework/question/quesDetail.vue'],()=>{
        resolve(require('../components/Homework/question/quesDetail.vue'))
    })
};

export const addQues=resolve=>{
    require.ensure(['../components/Homework/question/addQues.vue'],()=>{
        resolve(require('../components/Homework/question/addQues.vue'))
    })
};

export const editQues=resolve=>{
    require.ensure(['../components/Homework/question/editQues.vue'],()=>{
        resolve(require('../components/Homework/question/editQues.vue'))
    })
};

export const infoNotice=resolve=>{
    require.ensure(['../components/Info/notices/notices.vue'],()=>{
        resolve(require('../components/Info/notices/notices.vue'))
    })
};

export const infoHome=resolve=>{
    require.ensure(['../components/Info/home/home.vue'],()=>{
        resolve(require('../components/Info/home/home.vue'))
    })
};


export const noticeDetail=resolve=>{
    require.ensure(['../components/Info/notices/noticeDetail.vue'],()=>{
        resolve(require('../components/Info/notices/noticeDetail.vue'))
    })
};

export const infoArticle=resolve=>{
    require.ensure(['../components/Info/articles/articles.vue'],()=>{
        resolve(require('../components/Info/articles/articles.vue'))
    })
};

export const introCourse=resolve=>{
    require.ensure(['../components/Intro/course/course.vue'],()=>{
        resolve(require('../components/Intro/course/course.vue'))
    })
};

export const Forum=resolve=>{
    require.ensure(['../components/Forum/Forum.vue'],()=>{
        resolve(require('../components/Forum/Forum.vue'))
    })
};

export const forumHome=resolve=>{
    require.ensure(['../components/Forum/home/home.vue'],()=>{
        resolve(require('../components/Forum/home/home.vue'))
    })
};

export const forumScetion=resolve=>{
    require.ensure(['../components/Forum/section/section.vue'],()=>{
        resolve(require('../components/Forum/section/section.vue'))
    })
};

export const Post=resolve=>{
    require.ensure(['../components/Forum/section/post/post.vue'],()=>{
        resolve(require('../components/Forum/section/post/post.vue'))
    })
};

export const addPost=resolve=>{
    require.ensure(['../components/Forum/section/post/addPost.vue'],()=>{
        resolve(require('../components/Forum/section/post/addPost.vue'))
    })
};

export const editPost=resolve=>{
    require.ensure(['../components/Forum/section/post/editPost.vue'],()=>{
        resolve(require('../components/Forum/section/post/editPost.vue'))
    })
};

export const Group=resolve=>{
    require.ensure(['../components/Group/Group.vue'],()=>{
        resolve(require('../components/Group/Group.vue'))
    })
}