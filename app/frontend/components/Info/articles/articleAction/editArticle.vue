<template>
    <div>
        <div>
            <h3>编辑教学文章</h3>
            <Editor btn-name="确认更改" method="editArticle" :has-author="true" :data="article"></Editor>
        </div>
    </div>
</template>
<style>

</style>
<script>
    import Editor from "../../../Editor/Editor.vue";
    import {LS} from "../../../../helpers/utils";
    export default{
        data(){
            return{
                article:LS.getItem("article_temp")
            }
        },
        components:{
            Editor
        }
    }
</script>