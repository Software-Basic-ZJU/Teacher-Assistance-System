<template>
    <div>
        <div>
            <div v-if="hasTitle">
                标题：<el-input v-model="data.title" placeholder="标题"></el-input>
            </div>
            <div v-if="hasAuthor">
                作者：<el-input class="author" v-model="data.author" placeholder="作者"></el-input>
            </div>
            <div class="level" v-if="hasLevel">通知等级：
                <el-switch
                    v-model="data.level"
                    on-text="重要"
                    on-color="#ff4949"
                    off-text="普通"
                    off-color="#6ECADC"
                >
                </el-switch>
            </div>

            <div id="editor" style="height:300px;max-height:500px;" v-html="data.content">
            </div>
            <el-upload
                v-if="hasUpload"
                action="//jsonplaceholder.typicode.com/posts/"
                :multiple="false"
                :before-upload="checkUpload"
                :on-success="finish"
                :on-remove="removeFile"
                :default-file-list="defaultFileList"
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
        width:400px;
        margin-bottom:15px;
        margin-top:5px;
    }
    .el-input.author{
        width:200px;
    }
    .el-upload{
        margin-top:10px;
    }
    .el-upload__tip{
        margin-left:20px;
    }
    .level{
        margin-bottom:15px;
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
            hasLevel:{
                type:Boolean,
                default:false
            },
            hasAuthor:{
                type:Boolean,
                default:false
            },
            defaultFileList:{
                type:Array,
                default:[]
            },
            btnName:String,             //编辑器的确认按钮内容
            method:String,              //编辑器的功能
            data:{                      //编辑器提交的对象
                type:Object,
                default:{
                    title:'',
                    author:'',
                    content:'',
                    filePath:'',
                    level:false
                }
            }
        },
        methods:{
            publish(){
                this.data.content=this.editor.$txt.html();
                let section=this.$route.params.section;
                let method=this.method;
                this.$store.dispatch('editorSubmit',{
                    method:method,
                    data:this.data,
                    section:section
                })
            },
            reset(){
                this.editor.clear();
                this.data={
                    title:'',
                    author:'',
                    content:'',
                    filePath:'',
                    level:false
                }
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
