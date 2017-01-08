<template>
    <div class="app">
        <Header></Header>
        <div class="container">
            <div class="menuBox fl">
                <el-menu :default-active="'/'+$route.path.split('/')[1]" class="el-menu-vertical-demo" :router="true">
                    <el-menu-item v-for="item in menu" :index="item.root || item.path" :route="{path:item.path}">
                        <i class="iconfont" :class="item.icon"></i>{{item.linkName}}
                    </el-menu-item>
                    <a href="/Guest/MessageBoard.php" target="_blank">
                        <el-menu-item>
                            <i class="iconfont icon-iconfontpinglunhou"></i>留言板
                        </el-menu-item>
                    </a>
                </el-menu>
            </div>
            <div class="mainBox">
                <div v-loading="loading">
                    <router-view></router-view>
                </div>
            </div>
            <div class="cl"></div>
        </div>
        <Footer></Footer>
    </div>
</template>
<style scoped>
    .app{
        width:100%;
        height:100vh;
        min-width:960px;
    }
    .container{
        min-height:calc(100% - 110px);
        max-width:1400px;
        margin:0px auto;
        margin-bottom:-85px;
    }
    .menuBox{
        width:250px;
        height:460px;
        padding:10px;
        padding-bottom:155px;
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
        padding:10px 10px 120px 270px;
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
    .noRes{
        padding:10px 0px;
        text-align: center;
        font-size:20px;
        color:#c9c9c9;
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
    .el-input.is-disabled>.el-input__inner{
        color:#8492A6;
    }
    .el-card{
        -webkit-box-shadow: 0 0px 0px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 0px 0px 0 rgba(0,34,77,.1);
        box-shadow: 0 0px 0px 0 rgba(0,34,77,.1);
    }
    /* important!!! 防止tabs下多一条空的div*/
    .el-tabs__content{
        display: none;
    }
</style>
<script>
    import Header from "./Header/Header.vue";
    import Footer from "./Footer/Footer.vue";
    import router from "../routes";
    import {LS} from "../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            if(!userInfo || !userInfo.token) {
                router.replace({name:'login'});
                return {};
            }
            this.$store.dispatch('updateUserInfo',userInfo);        //重要!将用户信息注入store

            // 获取邮件(助教无邮件)
            if(userInfo.type!=3) {
                this.$store.dispatch('getRecMail');
                this.$store.dispatch('getSendMail');
            }

            return {
                menu: [
                    {
                        linkName: "重要信息",
                        path:"/info",
                        icon: "icon-tongzhi",
                    },
                    {
                        linkName: "课程介绍",
                        root: "/intro",
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
                        root: "/homework",
                        path: "/homework/"+(userInfo.type!=2?userInfo.class_id:userInfo.class_id[0].class_id),
                        icon: "icon-zuoye",
                    },
                    {
                        linkName: "讨论区",
                        path: "/forum",
                        icon: "icon-luntan",
                    },
                    {
                        linkName:"小组名单",
                        root:"/member",
                        path:"/member/"+(userInfo.type!=2?userInfo.class_id:userInfo.class_id[0].class_id),
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
            Header,
            Footer
        }
    }
</script>
