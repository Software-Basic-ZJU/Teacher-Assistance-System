import Vue from "vue";
import VueRouter from "vue-router";
import {
    App,
    Info,
    infoNotice,
    noticeDetail,
    infoArticle,
    Intro,
    introCourse,
    Resource,
    Homework
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
                redirect:'/info/notices',
                children:[
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
            }
        ]
    },
]

const router=new VueRouter({
    routes
});

export default router;