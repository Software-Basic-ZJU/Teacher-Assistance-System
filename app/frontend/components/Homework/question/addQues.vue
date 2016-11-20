<template>
    <div>
        <div>
            <h3>添加问题</h3>
            <Editor btn-name="确认添加" method="addQues" :has-title="true"></Editor>
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
