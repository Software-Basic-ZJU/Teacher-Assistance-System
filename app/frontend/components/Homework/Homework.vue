<!-- 作业模块根组件 -->
<template>
    <div>
        <div>
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>
<style scoped>
</style>
<script>
    export default{
        data(){
            return{
            }
        }
    }
</script>
