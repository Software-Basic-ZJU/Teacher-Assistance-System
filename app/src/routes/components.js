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

export const teacherQA=resolve=>{
    require.ensure(['../components/Forum/teacherQA/teacherQA.vue'],()=>{
        resolve(require('../components/Forum/teacherQA/teacherQA.vue'))
    })
};

export const publicForum=resolve=>{
    require.ensure(['../components/Forum/publicForum/publicForum.vue'],()=>{
        resolve(require('../components/Forum/publicForum/publicForum.vue'))
    })
};

export const groupForum=resolve=>{
    require.ensure(['../components/Forum/groupForum/groupForum.vue'],()=>{
        resolve(require('../components/Forum/groupForum/groupForum.vue'))
    })
};