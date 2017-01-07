<template>
    <div>
        <el-tabs @tab-click="handleClick" :value="$route.name">
            <el-tab-pane label="课程介绍" name="course"></el-tab-pane>
            <el-tab-pane label="教师介绍" name="teacher"></el-tab-pane>
        </el-tabs>
        <el-button type="success" class="fr" icon="edit" @click="goEdit" v-if="idenType==2"></el-button>
        <div class="introBox">
            <div>
                <router-view></router-view>
            </div>
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
                idenType:userInfo.type
            }
        },
        methods:{
            handleClick(tabs){
                switch(tabs.name){
                    case "course":
                        router.push({name:'course'});
                        break;
                    case "teacher":
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
