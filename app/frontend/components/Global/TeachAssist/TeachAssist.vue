<template>
    <div>
        <div v-loading.body="taLoading">
            <el-button type="success" @click="showAddTA(true)">添加助教</el-button>
            <el-table
                    :data="TAlist"
                    height="340"
            >
                <el-table-column
                        prop="assist_id"
                        label="助教ID"
                        min-width="100"
                >
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="助教"
                        min-width="150"
                ></el-table-column>
                <el-table-column
                        prop="class_name"
                        label="负责班级"
                        min-width="150"
                ></el-table-column>
                <el-table-column
                        inline-template
                        label="操作"
                        width="80"
                >
                    <span>
                        <el-button size="small" type="danger" icon="delete" @click="removeTA($index,row)" :plain="true"></el-button>
                    </span>
                </el-table-column>
            </el-table>
            <el-dialog title="添加助教" v-model="isShowAddTA" :modal="false" @close="showAddTA(false)">
                <el-form ref="TAform" :rules="rules" :model="TAform" label-width="90px">
                    <el-form-item label="负责班级" prop="classId">
                        <el-select v-model="TAform.classId" placeholder="负责班级">
                            <el-option
                                    v-for="item in classList"
                                    :key="item.class_id"
                                    :label="item.class_name"
                                    :value="item.class_id"
                            ></el-option>
                        </el-select>
                    </el-form-item >
                    <el-form-item label="助教ID" prop="taId">
                        <el-input v-model="TAform.taId"></el-input>
                    </el-form-item>
                    <el-form-item label="助教姓名" prop="taName">
                        <el-input v-model="TAform.taName"></el-input>
                    </el-form-item>
                    <el-form-item label="助教密码" prop="password">
                        <el-input v-model="TAform.password"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="addTA" :loading="formLoading">添加助教</el-button>
                    </el-form-item>
                </el-form>
            </el-dialog>
        </div>
    </div>
</template>
<style scoped>
    .el-table{
        width:100%;
        margin-top:10px;
    }
    .el-pagination{
        margin-top:10px;
    }
    .el-form{
        height:260px;
    }
</style>
<script>
    import {mapState} from "vuex";
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            return{
                taLoading:false,        //获取助教列表loading
                formLoading:false,      //提交表单Loading
                TAform:{
                    taId:'',
                    password:'',
                    classId:'',
                    taName:''
                },
                classList:userInfo.class_id,
                rules:{
                    taId:[
                        {
                            required:true,
                            message:'请输入助教ID',
                            trigger:'blur'
                        },
                        {
                            max:20,
                            message:'请不要超过20个字符',
                            trigger:'blur'
                        }
                    ],
                    taName:[
                        {
                            required:true,
                            message:'请输入助教姓名',
                            trigger:'blur'
                        },
                        {
                            max:20,
                            message:'请不要超过20个字符',
                            trigger:'blur'
                        }
                    ],
                    password:[
                        {
                            required:true,
                            message:'请输入密码',
                            trigger:'blur'
                        },
                        {
                            min:6,
                            max:20,
                            message:'长度须在6到20个字符',
                            trigger:'blur'
                        }
                    ],
                    classId:[
                        {
                            required:true,
                            message:'请选择负责的班级',
                            trigger:'change'
                        }
                    ]
                }
            }
        },
        created(){
            this.taLoading=true;
            this.$store.dispatch('getTAlist').then(()=>{
                this.taLoading=false;
            });
        },
        computed:{
            ...mapState({
                TAlist:state=>state.TAmanage.TAlist,
                isShowAddTA:state=>state.TAmanage.showAddTA
            })
        },
        methods:{
            showAddTA(signal){
                this.$store.dispatch('showAddTA',signal);
            },
            addTA(){
                this.$refs.TAform.validate((valid)=>{
                    if(valid){
                        this.formLoading=true;
                        this.$store.dispatch('addTA',this.TAform).then(()=>{
                            this.formLoading=false;
                        })
                    }
                })
            },
            removeTA(index,row){
                this.$confirm('确认是否删除该助教？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('removeTA',row.assist_id);
                }).catch(() => {});
            }
        }
    }
</script>
