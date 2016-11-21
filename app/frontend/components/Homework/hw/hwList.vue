<template>
    <div>
        <div class="homework">
            <div class="header">
                <h2>作业列表</h2>
                <el-button type="success" class="fr" @click.navtive="showAddHw">添加作业</el-button>
            </div>
            <hw-item
                    v-for="item in hwList"
                    :key="item.hwId"
                    :hw-id="item.hwId"
                    :title="item.title"
                    :publish-time="item.publishTime"
                    :deadline="item.deadline"
                    :identify="identify"
            ></hw-item>
            <el-dialog title="添加作业" v-model="showAdd" size="tiny" @close="closeAddHw">
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
                    <el-button @click.native="closeAddHw">取消</el-button>
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
    import {mapActions,mapState} from "vuex";
    export default{
        data(){
            return{
                identify:1,
                newHw:{
                    title:"",
                    deadline:""
                }
            }
        },
        computed:mapState({
            showAdd:state=>state.homework.showAdd,
            hwList:state=>state.homework.hwList
        }),
        methods:{
            addHw(){
                this.$store.dispatch('addHw',this.newHw);
            },
            ...mapActions([
                'showAddHw',
                'closeAddHw'
            ])
        },
        components:{
            hwItem
        }
    }
</script>
