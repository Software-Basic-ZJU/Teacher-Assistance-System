<template>
    <div>
        <div>
            <div class="header">
                <el-tabs :active-name="currIndex" @tab-click="resrcFilter">
                    <el-tab-pane label="教师资源"></el-tab-pane>
                    <el-tab-pane label="学生资源"></el-tab-pane>
                </el-tabs>
                <el-button type="success" class="fr" @click="addResrc">添加资源</el-button>
            </div>
            <span class="warning">以下是学生在论坛中分享的各种资源。</span>
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
                        width="180"
                >
                    <span>
                        <el-button size="small" :plain="true" type="danger" @click="remove($index,row)">删除</el-button>
                        <el-button class="updateBtn" size="small" @click="showEdit($index,row)">更新</el-button>
                        <a :href="resrcList[$index].filePath" :download="resrcList[$index].title"><el-button type="primary" size="small">下载</el-button></a>
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
    .header .el-tabs{
        width:100%;
    }
    .header .el-button--success{
        position: relative;
        z-index:1;
        margin-top:-62px;
    }
    .el-table{
        width:100%;
        max-height:900px;
    }
    .updateBtn{
        margin-left:0px;
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
    import {mapState} from "vuex";
    export default{
        data(){
            return{
                isUpload:false
            }
        },
        computed:{
            resrcList(){
                return this.$store.getters.resrcList;
            },
            showEditResrc(){
                return this.$store.state.resource.showEdit
            },
            editResrc(){
                return this.$store.state.resource.editResrc
            },
        },
        methods:{
            addResrc(){
                router.push({name:'addResrc'});
            },
            showEdit(index,row){
                this.$store.dispatch('showEditResrc',{
                    index,
                    row
                });
            },
            closeEdit(){
                this.$store.dispatch('closeEditResrc')
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
            },
            resrcFilter(tab){
                this.$store.dispatch('resrcFilter',tab.index);
            },
            remove(index,row){

            }
        }
    }
</script>
