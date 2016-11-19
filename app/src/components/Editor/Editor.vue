<template>
    <div>
        <div>
            <el-input v-model="title" placeholder="标题" v-if="hasTitle"></el-input>
            <div id="editor" style="height:300px;max-height:500px;">
            </div>
            <div class="btnGroup">
                <el-button type="primary" @click="publish">{{btnName}}</el-button>
                <el-button @click="reset">清空</el-button>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .btnGroup{
        margin-top:10px;
    }
    .el-input{
        width:50%;
        margin:10px 0px 20px 0px;
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
                editor:null,
                title:""
            }
        },
        mounted(){
            let editor=new wangEditor('editor');
            editor.create();
            this.editor=editor;
        },
        props:{
            hasTitle:{
                type:Boolean,
                default:true
            },
            btnName:String,
            method:String
        },
        methods:{
            publish(){
                let content=this.editor.$txt.formatText();
                let section=this.$route.params.section;
                let method=this.method;
                console.log(method)
                this.$store.dispatch('publish',{
                    title:this.title,
                    content,
                    section:section,
                    method:method
                })
            },
            reset(){
                this.editor.clear();
                this.title="";
            }
        }
    }
</script>
