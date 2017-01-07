<template>
    <div>
        <div>
            <el-tabs @tab-click="changeTabs" :value="$route.name">
                <el-tab-pane label="通知" name="notices" ></el-tab-pane>
                <el-tab-pane label="联系方式" name="contact"></el-tab-pane>
                <el-tab-pane label="教学文章" name="articles"></el-tab-pane>
            </el-tabs>
            <div class="infoBox">
                <div>
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .el-tabs{
        width:100%;
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
            }
        },
        methods: {
            changeTabs(tab) {
                switch(tab.name){
                    case "notices":
                        router.push({name:'notices'});
                        break;
                    case "contact":
                        router.push({name:'contact'});
                        break;
                    case "articles":
                        router.push({name:'articles'});
                        break;
                    default:break;
                }
            }
        }

    };
</script>