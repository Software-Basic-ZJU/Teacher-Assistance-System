<template>
    <div>
        <div>
            <h3>添加资源</h3>
            <el-form :model="newResrc">
                <el-form-item label="课件资源名称">
                    <el-input placeholder="课件资源名称" v-model="newResrc.name"></el-input>
                </el-form-item>
                <el-upload
                        action="http://localhost:8000/backend/aboutResource/addResource.php"
                        type="drag"
                        :headers="header"
                        :data="uploadInfo"
                        :multiple="false"
                        :before-upload="checkUpload"
                        :on-remove="removeFile"
                        :on-success="finish"
                >
                    <i class="el-icon-upload"></i>
                    <div class="el-dragger__text">将文件拖到此处，或<em>点击上传</em></div>
                    <div class="el-upload__tip" slot="tip">一次只能上传一个文件</div>
                </el-upload>
                <el-form-item>
                    <el-button type="primary" @click="submitResrc" :loading="resrcLoading">确认上传</el-button>
                    <el-button @click="cancelAddResrc">取消</el-button>
                </el-form-item>
            </el-form>
        </div>
    </div>
</template>
<style scoped>
    .el-form-item{
        height:70px;
    }
    .el-button{
        margin-top:20px;
    }
    .el-input{
        width:200px;
    }
</style>
<script>
    import router from "../../../routes";
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            return{
                isUpload:false,
                header:{        //上传文件的请求头
                    "X-Access-Token":userInfo.token
                },
                uploadInfo:{
                    uploader_id:userInfo.id,
                    type:0
                },
                newResrc:{
                    resrcId:'',
                    name:''
                }
            }
        },
        computed:{
            resrcLoading(){
                return this.$store.state.resource.loading;
            }
        },
        methods:{
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
                this.newResrc.resrcId=response.res.resource_id;
                this.isUpload=true;
            },
            removeFile(file,fileList){
                console.log(file);
                file.resrcId=this.newResrc.resrcId;
                this.$store.dispatch('removeResrc',file);
                this.isUpload=false;
            },
            submitResrc(){
                if(!this.isUpload) {
                    this.$message({
                        type:'error',
                        message:'请上传资源'
                    });
                    return;
                }
                if(this.newResrc=="") {
                    this.$message({
                        type:'warning',
                        message:'请填写资源名称'
                    });
                    return;
                }
                this.$store.dispatch('uploadResrc',this.newResrc);
            },
            cancelAddResrc(){
                router.go(-1);
            }
        }
    }
</script>
