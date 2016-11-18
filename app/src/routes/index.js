import Vue from "vue";
import VueRouter from "vue-router";
import {
    App,
    Info,
    infoNotice,
    noticeDetail,
    infoArticle,
    infoHome,
    Intro,
    introCourse,
    Resource,
    Homework,
    Forum,
    teacherQA,
    publicForum,
    groupForum
} from "./components";

Vue.use(VueRouter);


const routes=[
    {
        path:'/',
        component:App,
        name:'App',
        redirect:'/info',
        children:[
            {
                path:'/info',
                name:'Info',
                component:Info,
                redirect:'/info/home',
                children:[
                    {
                        name:'home',
                        path:'/info/home',
                        component:infoHome
                    },
                    {
                        name:'notices',
                        path:'/info/notices',
                        component:infoNotice
                    },
                    {
                        name:'notice',
                        path:'/info/notice/:nid',
                        comiponent:noticeDetail
                    },
                    {
                        name:'articles',
                        path:'/info/articles',
                        component:infoArticle
                    }
                ]
            },
            {
                name:'intro',
                path:'/intro',
                component:Intro,
                redirect:'/intro/course',
                children:[
                    {
                        name:'course',
                        path:'/intro/course',
                        component:introCourse
                    },
                    {
                        name:'teacher',
                        path:'/intro/teacher',
                        component:introCourse
                    }
                ]
            },
            {
                name:'resource',
                path:'/resource',
                component:Resource
            },
            {
                name:'homework',
                path:'/homework',
                component:Homework
            },
            {
                name:'forum',
                path:'/forum',
                component:Forum,
                children:[
                    {
                        name:'teacherQA',
                        path:'/forum/teacherQA',
                        component:teacherQA
                    },
                    {
                        name:'publicForum',
                        path:'/forum/public',
                        component:publicForum
                    },
                    {
                        name:'groupForum',
                        path:'/forum/group',
                        component:groupForum
                    }
                ]
            }
        ]
    },
]

const router=new VueRouter({
    routes
});

export default router;