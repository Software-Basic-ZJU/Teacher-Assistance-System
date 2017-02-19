<template>
    <div>
        <div class="resource">
            <div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<style scoped>
</style>
<script>
    export default{
        head:{
            title(){
                return {
                    inner:'课件资源'
                }
            }
        }
    }
</script>
