<template>
    <div class="app">
        <Header></Header>
        <div class="container">
            <div class="menuBox fl">
                <el-menu :default-active="$route.path" class="el-menu-vertical-demo" router="true">
                    <el-menu-item v-for="item in menu" :index="item.path">
                        <i :class="item.icon"></i>{{item.linkName}}
                    </el-menu-item>
                </el-menu>
            </div>
            <div class="mainBox">
                <div class="main">
                    <transition name="fade">
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
    .fade-leave-active{
        position:absolute;
    }
</style>
<script>
    import Header from "./Header/Header.vue";

    export default{
        data(){

            return{
                menu:[
                    {
                        linkName:"重要信息",
                        path:"/info/notice",
                        icon:"iconfont icon-tongzhi",
                    },
                    {
                        linkName:"课程介绍",
                        path:"/intro",
                        icon:"iconfont icon-jieshao",
                    },
                    {
                        linkName:"课程资源",
                        path:"/resource",
                        icon:"iconfont icon-serviceresource",
                    },
                    {
                        linkName:"作业列表",
                        path:"/homework",
                        icon:"iconfont icon-zuoye",
                    },
                    {
                        linkName:"讨论区",
                        path:"/forum",
                        icon:"iconfont icon-luntan",
                    }
                ]
            }
        },
        created(){
        },
        methods:{
        },
        components:{
            Header
        }
    }
</script>
