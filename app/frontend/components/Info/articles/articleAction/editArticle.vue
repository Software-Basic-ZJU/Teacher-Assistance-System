<template>
    <div>
        <div>
            <h3>编辑教学文章</h3>
            <Editor btn-name="确认更改" method="addArticle" :data="article" :has-author="true"></Editor>
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
        computed:{
            article(){
                let artId=this.$route.params.artId;
                let articles=this.$store.state.info.articleList;
                for(let i=0;i<articles.length;i++){
                    if(articles[i].artId==artId){
                        return articles[i];
                    }
                }
            }
        },
        components:{
            Editor
        }
    }
</script>