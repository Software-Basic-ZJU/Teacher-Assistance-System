<template>
    <div>
        <el-tabs type="card" @tab-click="handleClick" :active-name="currIndex">
            <el-tab-pane label="首页"></el-tab-pane>
            <el-tab-pane label="通知"></el-tab-pane>
            <el-tab-pane label="教学文章"></el-tab-pane>
        </el-tabs>
        <div class="infoBox">
            <router-view></router-view>
        </div>
    </div>
</template>
<style scoped>
    .el-tabs{
        width:100%;
    }
    .infoBox{
        padding:20px;
        padding-top:10px;
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
            let route=this.$route.path.split('/')[2];
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