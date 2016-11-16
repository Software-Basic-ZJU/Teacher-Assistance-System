import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const App=resolve=>{
    require.ensure(['../components/App.vue'],()=>{
        resolve(require('../components/App.vue'))
    })
};

const Info=resolve=>{
    require.ensure(['../components/Info/Info.vue'],()=>{
        resolve(require('../components/Info/Info.vue'))
    })
};

const notices=resolve=>{
    require.ensure(['../components/Info/notices/notices.vue'],()=>{
        resolve(require('../components/Info/notices/notices.vue'))
    })
}


const routes=[
    {
        path:'/',
        component:App,
        redirect:'/info',
        children:[
            {
                path:'/info',
                component:Info,
                redirect:'/info/notice',
                children:[
                    {
                        path:'/info/notice',
                        component:notices
                    },
                    {
                        path:'/info/articles',
                        component:notices
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