<template>
    <div>
        <el-tabs type="card" @tab-click="handleClick">
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

    }
</style>
<script>
    import router from "../../routes";
    export default {
        methods: {
            handleClick(tab) {
                switch(tab.index){
                    case "1":
                        router.push({path:'notice'});
                        break;
                    case "2":
                        router.push({path:'articles'});
                        break;
                    default:break;
                }
            }
        }
    };
</script>