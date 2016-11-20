<template>
    <div>
        <div>
            <el-tabs type="card" @tab-click="handleClick" :active-name="currIndex">
                <el-tab-pane label="首页"></el-tab-pane>
                <el-tab-pane label="通知"></el-tab-pane>
                <el-tab-pane label="教学文章"></el-tab-pane>
            </el-tabs>
            <div class="infoBox">
                <div>
                    <transition name="fade">
                        <router-view></router-view>
                    </transition>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .el-tabs{
        width:100%;
    }
    .infoBox{
        padding:0px 20px;
    }
    .infoBox>div{
        position: relative;
    }
</style>
<script>
    import router from "../../routes";
    export default {
        data(){
            return {
                currIndex:""
            }
        },
        created(){
            //initial tabs' active item
            let route=this.$route.name;
            if(route=='home') this.currIndex="1";
            else if(route=='notices') this.currIndex="2";
            else if(route=='articles') this.currIndex="3";
        },
        methods: {
            handleClick(tab) {
                switch(tab.index){
                    case "1":
                        router.push({name:'home'});
                        break;
                    case "2":
                        router.push({name:'notices'});
                        break;
                    case "3":
                        router.push({name:'articles'});
                        break;
                    default:break;
                }
            }
        }
    };
</script>