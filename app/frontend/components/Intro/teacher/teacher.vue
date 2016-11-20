<template>
    <div>
        <div>
            <el-button type="success" icon="edit" @click="editTeacher"></el-button>
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
        },
        methods:{
            editTeacher(){
                router.push({name:'editTeacher'});
            }
        }
    }
</script>
