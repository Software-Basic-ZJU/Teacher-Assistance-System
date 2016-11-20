<template>
    <div>
        <div>
            <h3>编辑问题</h3>
            <Editor btn-name="确认更改" method="editQues"></Editor>
        </div>
    </div>
</template>
<style>
    
</style>
<script>
    import Editor from "../../Editor/Editor.vue";
    export default{
        data(){
            return{
            }
        },
        components:{
            Editor
        }
    }
</script>
