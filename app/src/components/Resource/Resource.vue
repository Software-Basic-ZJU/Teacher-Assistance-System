<template>
    <div>
        <el-tabs type="card" @tab-click="handleClick">
            <el-tab-pane label="课程介绍"></el-tab-pane>
            <el-tab-pane label="教师介绍"></el-tab-pane>
        </el-tabs>
    </div>
</template>
<style scoped>
    .el-tabs{
        width:100%;
    }
</style>
<script>
    export default{
        data(){
            return{
                msg:'hello vue'
            }
        }
    }
</script>
