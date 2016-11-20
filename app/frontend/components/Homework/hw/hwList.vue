<template>
    <div>
        <div class="homework">
            <div class="header">
                <h2>作业列表</h2>
                <el-button type="success" class="fr" @click.navtive="showAddPost = true">添加作业</el-button>
            </div>
            <hw-item
                    v-for="item in hwList"
                    :key="item.hwId"
                    :hwId="item.hwId"
                    :title="item.title"
                    :publish-time="item.updateTime"
                    :deadline="item.deadline"
                    :identify="identify"
            ></hw-item>
            <el-dialog title="添加作业" v-model="showAddPost" size="tiny">
                <el-form :model="newHw">
                    <el-form-item label="作业标题" :label-width="formLabelWidth">
                        <el-input v-model="newHw.title" auto-complete="off" class="title"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-date-picker
                                v-model="newHw.deadline"
                                type="datetime"
                                placeholder="选择截止日期"
                        ></el-date-picker>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click.native="showAddPost = false">取消</el-button>
                    <el-button type="primary" @click.native="addHw">确认添加</el-button>
                </div>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .homework{
        padding:0px 20px;
    }
    .header{
        border-bottom:1px solid #D3DCE6;
    }
    .header>h2{
        color:#475669;
        height:25px;
        margin-top:0px;
    }
    .el-button--success{
        margin-top:-45px;
    }
</style>
<script>
    import hwItem from "./hwItem.vue";
    export default{
        data(){
            return{
                hwList:[
                    {
                        hwId:1,
                        title:'第一章作业',
                        publishTime:"2016-11-03",
                        deadline:"2016-12-03"
                    },
                    {
                        hwId:2,
                        title:'第二章作业',
                        publishTime:"2016-11-03",
                        deadline:"2016-12-03"
                    }
                ],
                identify:1,
                showAddPost:false,
                newHw:{
                    title:"",
                    publishTime:"",
                    deadline:""
                }
            }
        },
        methods:{
            addHw(){
                //todo add post
                this.showAddPost=false;
            }
        },
        components:{
            hwItem
        }
    }
</script>
