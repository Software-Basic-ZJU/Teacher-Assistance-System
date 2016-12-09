<template>
    <div>
        <div>
            <div class="info" v-html="courseInfo.content"></div>
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
            this.$store.dispatch('getCourseInfo');
            return{
            }
        },
        computed:{
            courseInfo(){
                return this.$store.state.intro.courseInfo
            }
        }
    }
</script>
