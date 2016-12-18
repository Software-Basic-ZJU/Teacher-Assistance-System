<template>
    <div>
        <div class="mainBox">
            <div class="leftBox fl">
                <el-menu
                        :default-active="currIndex"
                        class="el-menu-vertical-demo"
                        @select="selectPage">
                    <el-menu-item index="0">收件箱</el-menu-item>
                    <el-menu-item index="1">已发送</el-menu-item>
                    <el-menu-item index="2">发送信件</el-menu-item>
                </el-menu>
            </div>
            <div class="rightBox" v-loading.body="loading">
                <div class="main">
                    <!-- mail list -->
                    <div v-if="!toSend && !detailShow">
                        <div class="mailList">
                            <mail-item
                                    v-for="item in mailList"
                                    :key="item.mail_id"
                                    :mail-id="item.mail_id"
                                    :is-read="item.is_read"
                                    :sender="item.src_name || item.dest_name"
                                    :title="item.title"
                                    :datetime="item.time"
                            ></mail-item>
                        </div>
                        <el-pagination
                                small
                                page-size="9"
                                @current-change="changePage"
                                layout="prev,pager,next"
                                :total="mailNum"
                                class="fr"
                        ></el-pagination>
                    </div>

                    <!-- mail detail -->
                    <div v-if="detailShow">
                        <mail-detail :mail="currMail"></mail-detail>
                    </div>


                    <!-- send mail -->
                    <div v-if="toSend && !detailShow">
                        <to-send :mail-form="mailForm"></to-send>
                    </div>
                </div>
            </div>
            <div class="cl"></div>
        </div>
    </div>
</template>
<style scoped>
    .el-menu{
        background-color: #F0F0F0;
    }
    .mainBox .leftBox{
        width:140px;
    }
    .mainBox .rightBox{
        padding-left:160px;
    }
    .mainBox .rightBox .main{
        width:100%;
        height:410px;
    }
    .mainBox .mailList{
        position:relative;
        height:375px;
    }
    .el-pagination{
        padding-top:10px;
    }
</style>
<script>
    import mailItem from "./mailItem/mailItem.vue";
    import mailDetail from "./mailItem/mailDetail.vue";
    import toSend from "./toSend/toSend.vue";
    import {mapState} from "vuex";
    export default{
        data(){
            return{
                toSend:false,
            }
        },
        computed:{
            ...mapState({
                loading:state=>state.mail.loading,
                detailShow:state=>state.mail.detailShow,
                currMail:state=>state.mail.currMail,
                toSend:state=>state.mail.toSend,
                mailForm:state=>state.mail.mailForm,
                currIndex:state=>state.mail.mailListType
            }),
            mailList(){
                return this.$store.getters.mailList
            },
            mailNum(){
                return this.$store.getters.mailNum;
            }
        },
        methods:{
            selectPage(index){
                switch(index){
                    case '0':       //收件箱
                        this.$store.dispatch('showToSend',false);
                        this.$store.dispatch('showMailDetail',false);
                        this.$store.dispatch('updateMailType','0');
                        break;
                    case '1':       //发件箱
                        this.$store.dispatch('showToSend',false);
                        this.$store.dispatch('showMailDetail',false);
                        this.$store.dispatch('updateMailType','1');
                        break;
                    case '2':       //发邮件表单
                        this.$store.dispatch('showMailDetail',false);
                        this.$store.dispatch('showToSend',true);
                        this.$store.dispatch('updateMailType','2');
                        break;
                    default:break;
                }
            },
            changePage(val){
                this.$store.dispatch('changeMailPage',val);
            }
        },
        components:{
            mailItem,
            mailDetail,
            toSend
        }
    }
</script>
