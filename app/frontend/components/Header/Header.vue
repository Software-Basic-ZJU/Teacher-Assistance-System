<template>
    <div>
        <div class="header">
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
                        <i class="iconfont icon-user fl" @click="goRoute"></i>
                        <div class="cl"></div>
                    </div>
                </div>
                <div class="cl"></div>
            </div>

            <!-- mail -->
            <el-dialog class="mailBox" title="我的信箱" v-model="showMail" :close-on-click-modal="false" size="large">
                <Mail></Mail>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .header{
        width:100%;
        height:100px;
        background-color: #eff2f7;
    }
    .main{
        max-width:1400px;
        height:100px;
        margin:0px auto;
    }
    .main .logo>img{
        width:220px;
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

</style>
<script>
    import router from "../../routes";
    import Mail from "../Global/Mail/Mail.vue";
    export default{
        data(){
            return{
                showMail:false,
            }
        },
        created(){
            this.$on('closeMail',function(){
                console.log('yo')
                this.showMail=false;
            });
        },
        methods:{
            search(){

            },
            goRoute(){

            },
        },
        components:{
            Mail
        }
    }
</script>
