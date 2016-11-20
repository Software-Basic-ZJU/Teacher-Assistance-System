<template>
    <div>
        <div>
            <div class="info" v-html="teacherInfo.content"></div>
        </div>
    </div>
</template>
<style scoped>
    .info{
        margin-top:20px;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            return{
            }
        },
        computed:{
            teacherInfo(){
                return this.$store.state.intro.teacherInfo;
            }
        }
    }
</script>
