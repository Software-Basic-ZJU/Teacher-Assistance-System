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
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .app{
        width:100%;
        height:100vh;
        min-width:960px;
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
    .menuBox .el-menu{
        background-color:white;
        -webkit-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
    }
    .mainBox{
        padding:10px 10px 10px 270px;
    }
    .mainBox>div{
        position: relative;
    }
    .mainBox>div>div{
        background-color: white;
        padding:10px 15px;
        -webkit-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
    }
</style>
<style>
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
    .el-input.is-disabled>.el-input__inner{
        color:#8492A6;
    }
    .el-card{
        -webkit-box-shadow: 0 0px 0px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 0px 0px 0 rgba(0,34,77,.1);
        box-shadow: 0 0px 0px 0 rgba(0,34,77,.1);
    }
    .el-step__head.is-text.is-success{
        background-color: #6ECADC;
        border-color:#6ECADC;
    }
</style>
<script>
    import Header from "./Header/Header.vue";
    import store from "../vuex"
    import router from "../routes";

    export default{
        data(){
//            router.replace({name:'login'});
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
