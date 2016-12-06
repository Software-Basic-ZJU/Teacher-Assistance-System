<template>
    <div>
        <div class="AppHeader">
            <div class="main">
                <div class="logo fl">
                    <img src="./static/zjulogo.png"/>
                    <div class="name" >软件工程@计算机科学与技术学院</div>
                </div>
                <div class="actionBox fr">
                    <div class="topBox">
                        <i class="iconfont icon-search fl" @click="search"></i>
                        <el-badge is-dot class="item fl">
                            <i class="iconfont icon-i-mail fl" @click="showMail = true"></i>
                        </el-badge>
                        <!--<i class="iconfont icon-setting fl" @click="goRoute"></i>-->
                        <i class="iconfont icon-user fl" @click="showUserInfo = true"></i>
                        <i class="iconfont icon-jiaoshixinxi fl" v-if="identify==1" @click="showTAmanage = true"></i>
                        <div class="cl"></div>
                    </div>
                </div>
                <div class="cl"></div>
            </div>

            <!-- mail -->
            <el-dialog class="mailBox" title="我的信箱" v-model="showMail" :close-on-click-modal="false" size="large">
                <Mail></Mail>
            </el-dialog>

            <!-- TAManage -->
            <el-dialog class="TAmanage" title="助教管理" v-model="showTAmanage" :close-on-click-modal="false" size="large">
                <Teach-assist></Teach-assist>
            </el-dialog>

            <!-- personal info -->
            <el-dialog title="个人信息" v-model="showUserInfo" :close-on-click-modal="false" size="tiny">
                <User></User>
            </el-dialog>

        </div>
    </div>
</template>
<style scoped>
    .AppHeader{
        width:100%;
        height:110px;
        background-color: white;
        -webkit-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
    }
    .main{
        max-width:1400px;
        height:100px;
        margin:0px auto;
    }
    .main .logo>img{
        margin-top:5px;
        width:230px;
        margin-left:5px;
    }
    .main .logo .name{
        font-size:16px;
        margin-left:15px;
        margin-top:-2px;
        font-weight: bold;
    }
    .actionBox .topBox{
        height:30px;
        background-color: #F9FAFC;
        border:1px solid #D3DCE6;
    }
    .actionBox .iconfont{
        width:35px;
        height:30px;
        font-size:24px;
        cursor:pointer;
        text-align: center;
    }
    .actionBox .iconfont.icon-i-mail,
    .actionBox .iconfont.icon-setting{
        height:28px;
        padding-top:2px;
    }
    .actionBox .iconfont:hover{
        background-color: #EFF2F7;
    }
    .el-dialog{
        min-width:700px;
    }

</style>
<style>
    .AppHeader .mailBox{
        min-width:760px;
    }
</style>
<script>
    import router from "../../routes";
    import Mail from "../Global/Mail/Mail.vue";
    import TeachAssist from "../Global/TeachAssist/TeachAssist.vue";
    import User from "../Global/User/User.vue";
    export default{
        data(){
            return{
                showMail:false,
                showTAmanage:false,
                showUserInfo:false,
                identify:1
            }
        },
        methods:{
            search(){

            },
            goRoute(){

            },
        },
        components:{
            Mail,
            TeachAssist,
            User
        }
    }
</script>
