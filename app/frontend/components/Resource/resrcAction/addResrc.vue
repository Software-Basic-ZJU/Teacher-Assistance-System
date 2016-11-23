<template>
    <div>
        <div>
            <h3>添加资源</h3>
            <el-form :model="newResrc">
                <el-form-item label="课件资源名称">
                    <el-input placeholder="课件资源名称" v-model="newResrc.title"></el-input>
                </el-form-item>
                <el-upload
                        action="//jsonplaceholder.typicode.com/posts/"
                        type="drag"
                        :multiple="false"
                        :before-upload="checkUpload"
                        :on-remove="removeFile"
                        :on-success="finish"
                        name="resource"
                >
                    <i class="el-icon-upload"></i>
                    <div class="el-dragger__text">将文件拖到此处，或<em>点击上传</em></div>
                    <div class="el-upload__tip" slot="tip">一次只能上传一个文件</div>
                </el-upload>
                <el-form-item>
                    <el-button type="primary" @click="submitResrc">确认上传</el-button>
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
    import {mapActions} from "vuex";
    export default{
        data(){
            return{
                isUpload:false
            }
        },
        computed:{
            newResrc(){
                return this.$store.state.resource.newResrc
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
                this.isUpload=true;
            },
            removeFile(file,fileList){
                console.log(fileList);
                this.isUpload=false;
            },
            ...mapActions([
                'submitResrc',
                'cancelAddResrc'
            ])
        }
    }
</script>
