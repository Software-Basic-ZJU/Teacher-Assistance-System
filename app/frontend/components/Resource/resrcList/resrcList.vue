<template>
    <div>
        <div>
            <div class="header">
                <h2>课程资源</h2>
                <el-button type="success" class="fr" @click="addResrc">添加资源</el-button>
            </div>
            <el-table :data="resrcList" border :row-key="resrcId">
                <el-table-column
                        prop="title"
                        label="课件名称"
                        min-width="150"
                        show-overflow-tooltip="true"
                >
                </el-table-column>
                <el-table-column
                        prop="time"
                        label="上传时间"
                        show-overflow-tooltip="true"
                >
                </el-table-column>
                <el-table-column
                        prop="uploader"
                        label="上传人"
                        show-overflow-tooltip="true"
                >
                </el-table-column>
                <el-table-column
                        prop="size"
                        label="文件大小"
                        show-overflow-tooltip="true"
                >
                </el-table-column>
                <el-table-column
                        inline-template
                        label="操作"
                        min-width="120"
                >
                    <span>
                        <el-button size="small" @click="showEdit($index,row)">更新</el-button>
                        <a :download="resrcList[$index].filePath" ><el-button type="primary" size="small">下载</el-button></a>
                    </span>
                </el-table-column>
            </el-table>
            <el-dialog title="编辑资源" v-model="showEditResrc" @close="closeEdit">
                <el-form :model="editResrc">
                    <el-form-item label="资源名称" :label-width="formLabelWidth">
                        <el-input v-model="editResrc.title" auto-complete="off"></el-input>
                    </el-form-item>
                    <el-upload
                            action="//jsonplaceholder.typicode.com/posts/"
                            type="drag"
                            :multiple="false"
                            :before-upload="checkUpload"
                            :on-remove="removeFile"
                            :on-success="finish"
                    >
                        <i class="el-icon-upload"></i>
                        <div class="el-dragger__text">将文件拖到此处，或<em>点击上传</em></div>
                        <div class="el-upload__tip" slot="tip">文件大小不超过15MB</div>
                    </el-upload>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click.native="closeEdit">取消</el-button>
                    <el-button type="primary" @click.native="uploadResrc">确认更新</el-button>
                </div>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .header>h2{
        color:#475669;
        height:25px;
        margin-top:0px;
    }
    .el-table{
        width:100%;
        max-height:900px;
    }
    .el-button--success{
        margin-top:-45px;
    }
    .el-input{
        padidng:0px 10px;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            return{
                isUpload:false
            }
        },
        computed:{
            resrcList(){
                return this.$store.state.resource.resrcList;
            },
            showEditResrc(){
                return this.$store.state.resource.showEditResrc;
            },
            editResrc(){
                return this.$store.state.resource.editResrc;
            }
        },
        methods:{
            addResrc(){
                router.push({name:'addResrc'});
            },
            showEdit(index,row){
                this.$store.dispatch('showEdit',{
                    index,
                    row
                });
            },
            closeEdit(){
                this.$store.dispatch('closeEdit')
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
            },
            uploadResrc(){
                this.$store.dispatch('uploadResrc')
            }
        }
    }
</script>
