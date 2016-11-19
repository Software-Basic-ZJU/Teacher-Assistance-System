<template>
    <div>
        <div class="resource">
            <div class="header">
                <h2>课程资源</h2>
            </div>
            <el-table :data="resList" border >
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
                        <el-button size="small">更新</el-button>
                        <el-button type="primary" size="small">下载</el-button>
                    </span>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>
<style scoped>
    .resource{
        padding:0px 20px;
    }
    .header>h2{
        color:#475669;
        height:25px;
        margin-top:0px;
    }
    .el-table{
        width:100%;
        max-height:900px;
    }
</style>
<script>
    export default{
        data(){
            return{
                resList:[
                    {
                        resId:1,
                        title:'软工第三章PPT',
                        time:'2016-12-04',
                        uploader:'LowesYang',
                        size:1024
                    }
                ]
            }
        }
    }
</script>
