<template>
    <div>
        <div class="AppHeader">
            <div class="main">
                <div class="logo fl">
                    <!--<img src="./static/zjulogo.png"/>-->
                    <div class="name" >课程辅助系统</div>
                </div>
                <div class="actionBox fr" v-if="idenType">
                    <div class="topBox">
                        <el-badge is-dot class="item fl" v-if="hasUnRead && idenType!=3">
                            <i class="iconfont icon-i-mail fl" @click="showMail = true" ></i>
                        </el-badge>
                        <i class="iconfont icon-i-mail fl" @click="showMail = true" v-if="!hasUnRead && idenType!=3"></i>
                        <!--<i class="iconfont icon-setting fl" @click="goRoute"></i>-->
                        <i class="iconfont icon-user fl" v-if="idenType!=3"  @click="showUserInfo = true" ></i>
                        <i class="iconfont icon-jiaoshixinxi fl" v-if="idenType==2"  @click="showTAmanage = true"></i>
                        <i class="iconfont icon-tuichudenglu fl" @click="logout"></i>
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
        background-color: #2a2a2a;
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
        font-family: "Helvetica Neue", Helvetica, "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", Arial, sans-serif;
        font-size:32px;
        margin-left:20px;
        margin-top:20px;
        font-weight: bold;
        color:snow ;
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
    .actionBox .iconfont.icon-tuichudenglu{
        font-size:20px;
        padding-top:3px;
        height:28px;
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
    import {LS} from "../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            let idenType=false;
            if(userInfo && userInfo.token) {
                idenType=userInfo.type;
            }
            return{
                showMail:false,
                showTAmanage:false,
                showUserInfo:false,
                idenType:idenType
            }
        },
        computed:{
            hasUnRead(){
                return this.$store.getters.mailUnRead;
            }
        },
        methods:{
            search(){

            },
            goRoute(){

            },
            logout(){
                this.$confirm('确认要登出吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('logout');
                }).catch(() => {});
            }
        },
        components:{
            Mail,
            TeachAssist,
            User
        }
    }
</script>
