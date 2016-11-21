<template>
    <div>
        <div>
            <h3>发布主题</h3>
            <Editor method="addPost" btn-name="发布"></Editor>
        </div>
    </div>
</template>
<style>
    
</style>
<script>
    import Editor from "../../Editor/Editor.vue"
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
