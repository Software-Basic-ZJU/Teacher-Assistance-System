<template>
    <div>
        <div>
            <el-dialog class="mainBox" title="私信" v-model="showMail" @close="$parent.showMail = false" :close-on-click-modal="false" size="large">
                <div class="leftBox fl">
                    <el-menu default-active="1" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose">
                        <el-menu-item index="1">收件箱</el-menu-item>
                        <el-menu-item index="2">已发送</el-menu-item>
                    </el-menu>
                </div>
                <div class="rightBox">
                    <div class="main">

                    </div>
                </div>
                <div class="cl"></div>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .mainBox .leftBox{
        width:160px;
    }
    .mainBox .rightBox{
        padding-left:180px;
    }
    .mainBox .rightBox .main{
        background-color:#58B7FF;
        width:100%;
        height:100px;
    }
</style>
<script>

    export default{
        data(){
            return{
            }
        },
        props:{
            showMail:Boolean
        },
        components:{

        }
    }
</script>
