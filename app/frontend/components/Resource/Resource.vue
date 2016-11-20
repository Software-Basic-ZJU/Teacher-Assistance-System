<template>
    <div>
        <div class="resource">
            <div>
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .resource{
        padding:0px 20px;
    }
    .resource>div{
        position:relative;
    }
</style>
<script>
    export default{
        data(){
            return{
            }
        }
    }
</script>
