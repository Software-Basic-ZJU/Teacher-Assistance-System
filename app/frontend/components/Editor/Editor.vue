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
            <div class="level" v-if="hasAuthority">游客是否可见：
                <el-switch
                        v-model="data.authority"
                        on-text="否"
                        on-color="#ff4949"
                        off-text="是"
                        off-color="#6ECADC"
                >
                </el-switch>
            </div>
            <div id="editor" style="height:300px;" v-html="data.content">
            </div>
            <el-upload
                v-if="hasUpload"
                action="http://localhost:8000/backend/aboutResource/addResource.php"
                :data="uploadInfo"
                :headers="header"
                :multiple="false"
                :before-upload="checkUpload"
                :on-success="finish"
                :on-remove="removeFile"
                :default-file-list="defaultFileList"
            >
                <el-button size="small" type="primary">点击上传</el-button>
                <span class="el-upload__tip" slot="tip">只能上传一个文件，且大小不能超过2MB。</span>
            </el-upload>
            <div class="btnGroup">
                <el-button type="primary" @click="publish" :loading="isLoading">{{btnName}}</el-button>
                <el-button @click="reset">清空</el-button>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .btnGroup{
        margin:20px 0px;
    }
    .el-input{
        width:400px;
        margin-bottom:15px;
        margin-top:5px;
    }
    .el-select{
        margin-top:5px;
        margin-bottom:15px;
        width:300px;

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
    import {LS} from "../../helpers/utils";
    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            return{
                editor:null,
                header:{        //上传文件的请求头
                     "X-Access-Token":userInfo.token
                }
            }
        },
        mounted(){
            let editor=new wangEditor('editor');
            editor.create();
            this.editor=editor;
        },
        computed:{
            isLoading(){
                return this.$store.state.editorLoading
            },
            isUpload(){
                return this.$store.state.isFileUpload
            }
        },
        props:{
            hasTitle:{                  //编辑器是否需要含有标题输入框
                type:Boolean,
                default:true
            },
            hasUpload:{                 //编辑器是否需要上传文件功能
                type:Boolean,
                default:false
            },
            hasLevel:{                  //通知专用，重要等级选择
                type:Boolean,
                default:false
            },
            hasAuthor:{                 //是否有作者
                type:Boolean,
                default:false
            },
            hasAuthority:{              //是否对游客可见，fakse为可见,true为不可见
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
                    level:false,
                    authority:false
                }
            },
            uploadInfo:{                //额外参数
                type:Object,
                default:{
                    uploader_id:'',     //上传者id
                    type:''             //资源类型，0为教师资源，1为帖子资源，2为作业附件
                }
            }
        },
        methods:{
            publish(){
                if(!this.data.title){
                    return this.$message({
                        type:'error',
                        message:'标题不能为空'
                    })
                }
                this.data.content=this.editor.$txt.html();
                let params=this.$route.params;
                let method=this.method;
                this.$store.dispatch('editorSubmit',{
                    method:method,
                    data:this.data,
                    routeParams:params
                })
            },
            reset(){
                this.editor.clear();
                this.data={
                    title:'',
                    author:'',
                    content:'',
                    level:false
                }
            },
            checkUpload(file){          //上传前检查上传数量
                if(this.isUpload) {
                    this.$message({
                        type:'warning',
                        message:'一次只能上传一个文件'
                    });
                    return false;
                }
                console.log(file)
            },
            finish(response){           //上传成功
                console.log(response);
                this.data.resrcId=response.res.resource_id;     //resource_id为必须项
                if(this.uploadInfo.type!=2) {
                    LS.setItem("resource", response.res);
                    this.$store.dispatch('isFileUpload',true);
                }
                else{
                    this.$store.dispatch('isSubmitFile',true);
                }
            },
            removeFile(file,fileList){      //删除文件
                console.log(file);
                LS.removeItem("resource");

                this.$store.dispatch('removeResrc',this.data);
                this.$store.dispatch('isFileUpload',false);
            }
        }
    }
</script>
