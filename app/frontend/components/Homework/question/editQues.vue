<template>
    <div>
        <div>
            <h3>编辑问题</h3>
            <Editor btn-name="确认更改" method="editQues" :data="question"></Editor>
        </div>
    </div>
</template>
<style>
    
</style>
<script>
    import Editor from "../../Editor/Editor.vue";
    import router from "../../../routes";
    export default{
        data(){
            this.$store.dispatch('getQuesDetail',this.$route.params.quesId);
            return{
            }
        },
        computed:{
            question(){
                return this.$store.state.homework.quesDetail;
            }
        },
        components:{
            Editor
        }
    }
</script>
