<template>
    <div>
        <div>
            <div class="info" v-html="teacherInfo.content"></div>
        </div>
    </div>
</template>
<style scoped>
    .info{
        margin:20px 0px;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            this.$store.dispatch('getTeacherInfo');
            return{
            }
        },
        computed:{
            teacherInfo(){
                return this.$store.state.intro.teacherInfo;
            }
        },
        head:{
            title(){
                return {
                    inner:'教师介绍'
                }
            }
        }
    }
</script>
