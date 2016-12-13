<template>
    <div>
        <div>
            <h3>编辑主题</h3>
            <Editor method="editPost" btn-name="更新"></Editor>
        </div>
    </div>
</template>
<style>
    
</style>
<script>
    import Editor from "../../../Editor/Editor.vue"
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
