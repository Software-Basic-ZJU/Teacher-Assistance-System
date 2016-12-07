<template>
    <div>
        <div class="forum">
            <div class="view">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .forum{
        padding:0px 10px;
    }
    .forum>.view{
        position:relative;
    }
</style>
<script>
    export default{
        data(){
            return{
            }
        },
        methods:{
        }
    }
</script>
