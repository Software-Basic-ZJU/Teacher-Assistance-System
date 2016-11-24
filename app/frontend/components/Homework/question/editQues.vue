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
            return{
            }
        },
        computed:{
            question(){
                let quesList=this.$store.state.homework.quesList;
                let i;
                for(i=0;i<quesList.length;i++){
                    if(quesList[i].quesId=this.$route.params.quesId){
                        return quesList[i];
                    }
                }
                if(i==list.length){
                    router.go(-1);
                    return this.$message({
                        type:'error',
                        message:'该问题不存在!'
                    })
                }
            }
        },
        components:{
            Editor
        }
    }
</script>
