<template>
    <div>
        <div>
            <div class="header">
                <el-tabs :value="currIndex" @tab-click="resrcFilter">
                    <el-tab-pane label="教师资源" name="0"></el-tab-pane>
                    <el-tab-pane label="学生资源" name="1"></el-tab-pane>
                </el-tabs>
                <el-button type="success" class="fr" @click="addResrc" v-show="currIndex!=1 && idenType==2" icon="plus"></el-button>
            </div>
            <div class="warning" v-if="currIndex==1">以下是学生在论坛中分享的各种资源。</div>
            <el-table :data="resrcList" border :row-key="resource_id">
                <el-table-column
                        prop="name"
                        label="课件名称"
                        min-width="180"
                        show-overflow-tooltip="true"
                >
                </el-table-column>
                <el-table-column
                        prop="upload_time"
                        label="上传时间"
                        show-overflow-tooltip="true"
                        width="172"
                >
                </el-table-column>
                <el-table-column
                        prop="uploader_name"
                        label="上传人"
                        show-overflow-tooltip="true"
                >
                </el-table-column>
                <el-table-column
                        prop="size"
                        label="文件大小"
                        show-overflow-tooltip="true"
                        min-width="100"
                >
                </el-table-column>
                <el-table-column
                        inline-template
                        label="对游客可见"
                        show-overflow-tooltip="true"
                        min-width="80"
                >
                    <span>{{row.authority==0?'是':'否'}}</span>
                </el-table-column>
                <el-table-column
                        inline-template
                        label="操作"
                        width="160"
                        fixed="right"
                >
                    <span>
                        <el-button v-show="idenType==2 && currIndex==0" size="small" :plain="true" type="danger" icon="delete" @click="removeResrc($index,row)"></el-button>
                        <el-button v-show="idenType==2 && currIndex==0" class="updateBtn" size="small" :plain="true" type="warning" icon="edit" @click="showEdit($index,row)"></el-button>
                        <a v-show="currIndex==0" :href="resrcList[$index].path" :download="resrcList[$index].name"><el-button type="primary" size="small">下载</el-button></a>
                        <el-button v-show="currIndex==1" type="primary" @click="gotoPost(row)" size="small">前往对应帖子</el-button>
                    </span>
                </el-table-column>
            </el-table>
            <el-dialog title="编辑资源" v-model="showEditResrc" @close="closeEdit">
                <el-form :model="currResrc">
                    <el-form-item label="资源名称" :label-width="formLabelWidth">
                        <el-input v-model="currResrc.name" auto-complete="off"></el-input>
                    </el-form-item>
                    <el-form label="是否对游客可见">游客是否可见：
                        <el-switch
                                v-model="authority"
                                on-text="否"
                                on-color="#ff4949"
                                off-text="是"
                                off-color="#6ECADC"
                        >
                        </el-switch>
                    </el-form>
                    <el-upload
                            action="backend/aboutResource/addResource.php"
                            type="drag"
                            :headers="header"
                            :data="uploadInfo"
                            :multiple="false"
                            :before-upload="checkUpload"
                            :on-remove="removeFile"
                            :on-success="uploadFinish"
                            :default-file-list="fileList"
                    >
                        <i class="el-icon-upload"></i>
                        <div class="el-dragger__text">将文件拖到此处，或<em>点击上传</em></div>
                        <div class="el-upload__tip" slot="tip">文件大小不超过15MB</div>
                    </el-upload>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click.native="closeEdit">取消</el-button>
                    <el-button type="primary" @click.native="uploadResrc" :loading="resrcLoading">确认更新</el-button>
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
    .warning{
        margin-top:-10px;
        margin-bottom:10px;
        font-size:14px;
        color:#8492A6;
    }
    .el-button--success{
        margin-top:-45px;
    }
    .el-input{
        padidng:0px 10px;

    }
    .el-upload{
        margin-top:15px;
    }
</style>
<script>
    import router from "../../../routes";
    import {LS} from "../../../helpers/utils";
    import {mapState} from "vuex";
    export default{
        data(){
            this.$store.dispatch('getResrcList');
            let userInfo=LS.getItem("userInfo");
            return{
                isUpload:true,
                currResrc:{
                    resrcId:'',
                    name:'',
                    path:''
                },
                authority:false,    // 是否可见switch，不能放进表单，因为会发生组件锁住现象
                header:{        //上传文件的请求头
                    "X-Access-Token":userInfo.token
                },
                uploadInfo:{    //上传文件的额外参数
                    uploader_id:userInfo.id,
                    type:0
                },
                idenType:userInfo.type
            }
        },
        computed:{
            resrcList(){
                return this.$store.getters.resrcList;
            },
            fileList(){
                return [this.currResrc]
            },
            ...mapState({
                showEditResrc:state=>state.resource.showEdit,
                currIndex:state=>state.resource.resrcFilter,
                resrcLoading:state=>state.resource.loading
            })
        },
        methods:{
            addResrc(){     //跳转至添加资源页面
                router.push({name:'addResrc'});
            },
            showEdit(index,row){        //显示修改资源对话框
                console.log(row);
                this.$store.dispatch('showEditResrc',true);
                this.currResrc={
                    resrcId:row.resource_id,
                    name:row.name,
                    path:row.path,
                }
                this.authority=row.authority==0?false:true;
            },
            closeEdit(){            //关闭修改资源对话框
                this.$store.dispatch('showEditResrc',false)
            },
            checkUpload(file){      //上传之前检查上传文件个数
                if(this.isUpload) {
                    this.$message({
                        type:'warning',
                        message:'一次只能上传一个文件'
                    })
                    return false;
                }
                console.log(file)
            },
            uploadFinish(response){       //上传完成
                console.log(response);
                this.currResrc.resrcId=response.res.resource_id;
                this.isUpload=true;
            },
            removeFile(file,fileList){      //删除已上传文件
                console.log(file);
                this.$store.dispatch('removeResrc',file);
                this.isUpload=false;
            },
            uploadResrc(){              //提交表单，更新资源
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
                this.currResrc.authority=this.authority?1:0;
                this.$store.dispatch('uploadResrc',this.currResrc);
            },
            resrcFilter(tab){
                this.$store.dispatch('resrcFilter',tab.index)
            },
            removeResrc(index,row){
                this.$confirm('确认要删除该资源吗？','提示',{
                    confirmButtonText:'确认删除',
                    cancelButtonText:'取消',
                    type:'warning'
                }).then(()=>{
                    row.wholeResrc=true;        //如果是删除整个资源，则置为true
                    row.resrcId=row.resource_id;
                    this.$store.dispatch('removeResrc',row);
                }).catch(()=>{});
            },
            gotoPost(row){
                let postId=row.post_id;
                let section='';
                switch(row.section){
                    case '0':
                        section='teacherQA';
                        break;
                    case '1':
                        section='public';
                        break;
                    case '2':
                        section='group';
                        break;
                    default:
                        section='teacherQA';
                        break;
                }
                router.push({name:'post',params:{section:section,pid:postId}});
            }
        }
    }
</script>
