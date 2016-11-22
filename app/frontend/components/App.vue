<template>
    <div class="app">
        <Header></Header>
        <div class="container">
            <div class="menuBox fl">
                <el-menu :default-active="'/'+$route.path.split('/')[1]" class="el-menu-vertical-demo" router="true">
                    <el-menu-item v-for="item in menu" :index="item.path">
                        <i class="iconfont" :class="item.icon"></i>{{item.linkName}}
                    </el-menu-item>
                </el-menu>
            </div>
            <div class="mainBox">
                <div v-loading="loading">
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
        max-width:1400px;
        min-width:960px;
    }
    .container{
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
    .mainBox>div{
        position: relative;
    }
</style>
<style>
    .fade-enter,
    .fade-leave,
    .fade-enter-active,
    .fade-leave-active{
        width:100%;
        position:absolute;
    }
    .el-breadcrumb{
        margin-top:0px;
        padding-bottom:5px;
        font-size:18px;
        border-bottom:1px solid #E5E9F2;
        height:30px;
    }
    .el-form-item:after,
    .el-form-item__content:after{
        clear:none;
    }
    .el-dialog{
        min-width:300px;
    }
</style>
<script>
    import Header from "./Header/Header.vue";
    import store from "../vuex"

    export default{
        data(){
            return {
                menu: [
                    {
                        linkName: "重要信息",
                        path: "/info",
                        icon: "icon-tongzhi",
                    },
                    {
                        linkName: "课程介绍",
                        path: "/intro",
                        icon: "icon-jieshao",
                    },
                    {
                        linkName: "课程资源",
                        path: "/resource",
                        icon: "icon-serviceresource",
                    },
                    {
                        linkName: "作业列表",
                        path: "/homework",
                        icon: "icon-zuoye",
                    },
                    {
                        linkName: "讨论区",
                        path: "/forum",
                        icon: "icon-luntan",
                    },
                    {
                        linkName:"小组名单",
                        path:"/member",
                        icon:"icon-group"
                    }
                ]
            }
        },
        computed:{
            loading(){
                return this.$store.getters.loading;
            }
        },
        components:{
            Header
        }
    }
</script>
