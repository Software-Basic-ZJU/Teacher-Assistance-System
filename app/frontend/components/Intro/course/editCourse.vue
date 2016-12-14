<template>
    <div>
        <div>
            <h3>编辑课程介绍</h3>
            <Editor
                    btn-name="确认修改"
                    method="editCourseInfo"
                    :has-title="false"
                    :data="Object.assign({},courseInfo)"
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
            courseInfo(){
                let courseInfo=this.$store.state.intro.courseInfo;
                if(courseInfo.content==''){
                    this.$store.dispatch('getCourseInfo');
                }
                return this.$store.state.intro.courseInfo;
            }
        },
        components:{
            Editor
        }
    }
</script>
