<template>
    <div>
        <div class="quesDetail">
            <el-breadcrumb separator="/">
                <el-breadcrumb-item :to="{name:'homework'}">作业列表</el-breadcrumb-item>
                <el-breadcrumb-item :to="{name:'hwDetail',params:{hwId:$route.params.hwId}}">{{hwName}}</el-breadcrumb-item>
                <el-breadcrumb-item>{{question.title}}</el-breadcrumb-item>
            </el-breadcrumb>
            <div class="main" v-loading="loaded">
                <div class="leftBox fl">
                    <div class="title">
                        {{question.title}}
                    </div>
                    <div class="content">
                        {{question.content}}
                    </div>
                    <div class="submitBox">
                        <h3>提交作业</h3>
                        <Editor method="submitHw" btn-name="提交" :has-title="false"></Editor>
                    </div>
                </div>
                <div class="rightBox fl">
                    <div class="stuList">
                        <el-table
                                :data="stuList"
                                border
                        >
                            <el-table-column
                                    prop="sid"
                                    label="学号"
                                    min-width="100"
                                    show-overflow-tooltip="true"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="name"
                                    label="姓名"
                                    min-width="100"
                                    show-overflow-tooltip="true"
                            >
                            </el-table-column>
                            <el-table-column
                                    prop="status"
                                    label="状态"
                                    min-width="80"
                                    show-overflow-tooltip="true"
                            >
                            </el-table-column>
                            <el-table-column
                                    inline-template
                                    :context="_self"
                                    fixed="right"
                                    label="操作"
                                    min-width="80">
                              <span>
                                <el-button @click="checkHw($index,row)" type="text" size="small">查看作业</el-button>
                              </span>
                            </el-table-column>
                        </el-table>
                    </div>
                </div>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .quesDetail{
        padding:0px 20px;
    }
    .main>.leftBox{
        width:54%;
        padding:10px;
        border-right:1px solid #E5E9F2;
    }
    .main .title{
        text-align: center;
        font-size:24px;
    }
    .main .content{
        margin-top:20px;
        font-size:16px;
    }
    .main>.rightBox{
        width:42%;
    }
    .main>.rightBox>.stuList{
        padding:10px;
    }
</style>
<script>
    import Editor from "../../Editor/Editor.vue";

    export default{
        data(){
            return{
                hwName:'第一张作业',
                question:{
                    title:"Java计算器",
                    content:"我是我是我是"
                },
                stuList:[
                    {
                        sid:'111',
                        name:'LowesYang',
                        status:'已交'
                    },
                    {
                        sid:'123',
                        name:'lalala',
                        status:'未交'
                    }
                ]
            }
        },
        methods:{
            checkHw(index,row){
                console.log(index,row.sid);
            }
        },
        components:{
            Editor
        }
    }
</script>
