<template>
    <div>
        <div>
            <h3>添加教学文章</h3>
            <Editor btn-name="确认发表" method="addArticle" :has-author="true" :has-authority="true"></Editor>
        </div>
    </div>
</template>
<style>
    
</style>
<script>
    import Editor from "../../../Editor/Editor.vue";
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
