<template>
    <div>
        <div>
            <h3>编辑教师介绍</h3>
            <Editor
                    btn-name="确认修改"
                    method="editTeacherInfo"
                    :has-title="false"
                    :data="teacherInfo"
            ></Editor>
        </div>
    </div>
</template>
<style scoped>
    h3{
        margin-top:0px;
    }
</style>
<script>
    import Editor from "../../Editor/Editor.vue";
    export default{
        data(){
            return{
            }
        },
        computed:{
            teacherInfo(){
                let teacherInfo=this.$store.state.intro.teacherInfo;
                if(teacherInfo.content==''){
                    this.$store.dispatch('getTeacherInfo');
                }
                return this.$store.state.intro.teacherInfo;
            }
        },
        components:{
            Editor
        },
        head:{
            title(){
                return {
                    inner:'编辑教师介绍'
                }
            }
        }
    }
</script>
