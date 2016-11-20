<template>
    <div>
        <div>
            <el-input v-model="data.title" placeholder="标题" v-if="hasTitle"></el-input>
            <div id="editor" style="height:300px;max-height:500px;" v-html="data.content">
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
                editor:null
            }
        },
        mounted(){
            let editor=new wangEditor('editor');
            editor.create();
            this.editor=editor;
        },
        props:{
            hasTitle:{                  //编辑器是否需要含有标题输入框
                type:Boolean,
                default:true
            },
            btnName:String,             //编辑器的确认按钮内容
            method:String,              //编辑器的功能
            data:{                      //编辑器提交的对象
                type:Object,
                default:{
                    title:'',
                    content:''
                }
            }
        },
        methods:{
            publish(){
                let content=this.editor.$txt.html();
                let section=this.$route.params.section;
                let method=this.method;
                this.$store.dispatch('editorSubmit',{
                    method:method,
                    title:this.data.title,
                    content,
                    section:section
                })
            },
            reset(){
                this.editor.clear();
                this.data.title="";
            }
        }
    }
</script>
