<template>
    <div>
        <el-tabs @tab-click="handleClick" :active-name="currIndex">
            <el-tab-pane label="课程介绍" ></el-tab-pane>
            <el-tab-pane label="教师介绍"></el-tab-pane>
        </el-tabs>
        <el-button type="success" class="fr" icon="edit" @click="goEdit" v-if="idenType!=1"></el-button>
        <div class="introBox">
            <div>
                <router-view></router-view>
            </div>
    </div>
</template>
<style scoped>
    .el-tabs{
        width:100%;
    }
    .el-button--success{
        position:relative;
        margin-top:-62px;
        margin-right:0px;
        z-index:1;
    }
    .introBox{
        padding:0px 20px;
    }
    .introBox>div{
        position:relative;
    }
</style>
<script>
    import router from "../../routes";
    import {LS} from "../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            return{
                currIndex:"",
                idenType:userInfo.type
            }
        },
        created(){
            //initial tabs' active item
            let route=this.$route.name;
            if(route=='course') this.currIndex="1";
            else if(route=='teacher') this.currIndex="2";
        },
        methods:{
            handleClick(tabs){
                switch(tabs.index){
                    case "1":
                        router.push({name:'course'});
                        break;
                    case "2":
                        router.push({name:'teacher'});
                        break;
                    default:break;
                }
            },
            goEdit(){
                let route=this.$route.name;
                switch(route){
                    case 'course':
                        router.push({name:'editCourse'});
                        break;
                    case 'teacher':
                        router.push({name:'editTeacher'});
                        break;
                    default:break;
                }
            }
        }
    }
</script>
