<template>
    <div>
        <div>
            <el-input v-model="data.title" placeholder="标题" v-if="hasTitle"></el-input>
            <div id="editor" style="height:300px;max-height:500px;" v-html="data.content">
            </div>
            <el-upload
                v-if="hasUpload"
                action="//jsonplaceholder.typicode.com/posts/"
                :multiple="false"
                :before-upload="checkUpload"
                :on-success="finish"
                :on-remove="removeFile"
            >
                <el-button size="small" type="primary">点击上传</el-button>
                <span class="el-upload__tip" slot="tip">只能上传一个文件，且大小不能超过15MB。</span>
            </el-upload>
            <div class="btnGroup">
                <el-button type="primary" @click="publish">{{btnName}}</el-button>
                <el-button @click="reset">清空</el-button>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .btnGroup{
        margin-top:20px;
    }
    .el-input{
        width:50%;
        margin:10px 0px 20px 0px;
    }
    .el-upload{
        margin-top:10px;
    }
    .el-upload__tip{
        margin-left:20px;
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
                isUpload:false
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
            hasUpload:{
                type:Boolean,
                default:false
            },
            btnName:String,             //编辑器的确认按钮内容
            method:String,              //编辑器的功能
            data:{                      //编辑器提交的对象
                type:Object,
                default:{
                    title:'',
                    content:'',
                    filePath:''
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
                    filePath:this.data.filePath,
                    section:section
                })
            },
            reset(){
                this.editor.clear();
                this.data.title="";
            },
            checkUpload(file){
                if(this.isUpload) {
                    this.$message({
                        type:'warning',
                        message:'一次只能上传一个文件'
                    })
                    return false;
                }
                console.log(file)
            },
            finish(response){
                console.log(response);
                this.isUpload=true;
            },
            removeFile(file,fileList){
                console.log(fileList);
                this.isUpload=false;
            }
        }
    }
</script>
