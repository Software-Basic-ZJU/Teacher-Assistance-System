<template>
    <div class="app">
        <Header></Header>
        <div class="container">
            <div class="menuBox fl">
                <el-menu :default-active="curr" class="el-menu-vertical-demo" router="true">
                    <el-menu-item v-for="item in menu" :index="item.path" :class="{'is-active':curr==item.id}">
                        <i :class="item.icon"></i>{{item.linkName}}
                    </el-menu-item>
                </el-menu>
            </div>
            <div class="mainBox">
                <div class="main">
                    <transition>
                        <router-view></router-view>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .app{
        width:100%;
        height:100vh;
    }
    .container{
        max-width:1400px;
        margin:0px auto;
    }
    .menuBox{
        width:250px;
        height:460px;
        padding:10px;
        text-align:center;
    }
    .menuBox .el-menu-item{
        font-size:16px;
    }
    .menuBox .el-menu-item>i{
        margin-right:15px;
        font-size:16px;
    }
    .mainBox{
        padding:10px 10px 10px 270px;
    }
    .mainBox>.main{
        padding:10px;
    }
</style>
<script>
    import Header from "./Header/Header.vue";

    export default{
        data(){

            return{
                menu:[
                    {
                        id:1,
                        linkName:"重要信息",
                        path:"/info/notice",
                        icon:"iconfont icon-tongzhi",
                    },
                    {
                        id:2,
                        linkName:"课程介绍",
                        path:"/a",
                        icon:"iconfont icon-jieshao",
                    },
                    {
                        id:3,
                        linkName:"课程资源",
                        path:"/a",
                        icon:"iconfont icon-serviceresource",
                    },
                    {
                        id:4,
                        linkName:"作业列表",
                        path:"/b",
                        icon:"iconfont icon-zuoye",
                    },
                    {
                        id:5,
                        linkName:"讨论区",
                        path:"/b",
                        icon:"iconfont icon-luntan",
                    }
                ],
                curr:1
            }
        },
        beforeRouteLeave(to,from,next){
            this.curr=this.getCurr(to.path);
            next();
        },
        methods:{
            getCurr(path){
                let route=path.split('/')[1];
                let currActive;
                switch(route){
                    case 'info':
                        currActive=1;
                        break;
                    case 'a':
                        currActive=2;
                        break;
                    default:
                        currActive=0;
                        break;
                }
                console.log(currActive);
                return currActive;
            }
        },
        components:{
            Header
        }
    }
</script>
