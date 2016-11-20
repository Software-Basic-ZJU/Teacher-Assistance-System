<template>
    <div>
        <div>
            <el-button type="success" icon="edit" @click="editCourse"></el-button>
            <div class="info" v-html="courseInfo.content"></div>
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
            courseInfo(){
                return this.$store.state.intro.courseInfo
            }
        },
        methods:{
            editCourse(){
                router.push({name:'editCourse'});
            }
        }
    }
</script>
