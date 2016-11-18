<template>
    <div>
        <div>
            <h3>发布主题</h3>
            <div id="editor" style="height:300px;max-height:500px;">
            </div>
            <div class="btnGroup">
                <el-button type="primary" @click="publish">发布</el-button>
                <el-button @click="reset">清空</el-button>
            </div>
        </div>
    </div>
</template>
<style scopde>
    .btnGroup{
        margin-top:10px;
    }
</style>
<style>
    .wangEditor-container .clearfix:after{
        clear: none;
    }
</style>
<script>
    export default{
        data(){
            return{
                editor:null
            }
        },
        mounted(){
            let editor=new wangEditor('editor');
            editor.create();
            this.editor=editor;
        },
        props:{
            publish:Function
        },
        methods:{
            publish(){
                let content=this.editor.$txt.formatText();
                let section=this.$route.name;
                this.$store.dispatch('publishPost',{
                    content,
                    section:section
                })
            },
            reset(){
                this.editor.clear();
            }
        }
    }
</script>
