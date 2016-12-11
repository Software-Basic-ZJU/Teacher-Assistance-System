<!-- 作业模块根组件 -->
<template>
    <div>
        <div>
            <el-menu @select="goClassPath" :default-active="$route.params.classId" class="el-menu-vertical-demo">
                <el-menu-item v-for="item in classArr" :key="item.class_id" :index="item.class_id">{{item.class_name}}</el-menu-item>
            </el-menu>
            <router-view></router-view>
        </div>
    </div>
</template>
<style scoped>
    .el-menu{
        position: absolute;
        width:250px;
        text-align: center;
        left:-260px;
        top:350px;
        background-color:white;
        -webkit-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        -moz-box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
        box-shadow: 0 1px 5px 0 rgba(0,34,77,.1);
    }
</style>
<script>
    import {LS} from "../../helpers/utils";
    import router from "../../routes";

    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            if(!this.$route.params.classId) {       //若路由中不带参数，则自动重定向
                router.push({
                    name: 'hwList',
                    params: {
                        classId: userInfo.type == 1 ? userInfo.class_id : userInfo.class_id[0].class_id
                    }
                });
            }
            return{
                idenType:userInfo.type,
                classArr:userInfo.class_id
            }
        },
        created(){
            this.$store.dispatch('getHwList',this.$route.params.classId);
        },
        methods:{
            goClassPath(index){
                console.log(index);
                this.$store.dispatch('getHwList',index);
                router.push({
                    name:'hwList',
                    params:{
                        classId:index
                    }
                })
            }
        }
    }
</script>
