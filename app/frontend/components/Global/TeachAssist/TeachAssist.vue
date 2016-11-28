<template>
    <div>
        <div>
            <el-button type="success" @click="showAddTA = true">添加助教</el-button>
            <el-table
                    :data="TAlist"
                    height="315"
            >
                <el-table-column
                        prop="taId"
                        label="助教ID"
                        min-width="100"
                >
                </el-table-column>
                <el-table-column
                        prop="taName"
                        label="助教"
                        min-width="150"
                ></el-table-column>
                <el-table-column
                        prop="className"
                        label="负责班级"
                        min-width="150"
                ></el-table-column>
                <el-table-column
                        inline-template
                        label="操作"
                        width="80"
                >
                    <span>
                        <el-button size="small" type="danger" icon="delete" @click="deleteTA($index,row)"></el-button>
                    </span>
                </el-table-column>
            </el-table>
            <el-dialog title="添加助教" v-model="showAddTA" :modal="false">
                <el-form ref="TAform" :rules="rules" :model="TAform" label-width="90px">
                    <el-form-item label="负责班级" prop="classId">
                        <el-select v-model="TAform.classId" placeholder="负责班级">
                            <el-option
                                    v-for="item in classList"
                                    :key="item.classId"
                                    :label="item.className"
                                    :value="item.classId"
                            ></el-option>
                        </el-select>
                    </el-form-item >
                    <el-form-item label="助教ID" prop="taId">
                        <el-input v-model="TAform.taId"></el-input>
                    </el-form-item>
                    <el-form-item label="助教密码" prop="password">
                        <el-input v-model="TAform.password"></el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="addTA">添加助教</el-button>
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
</style>
<script>
    import {mapState} from "vuex";
    export default{
        data(){
            return{
                showAddTA:false,
                TAform:{
                    taId:'',
                    password:'',
                    classId:''
                },
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
                    password:[
                        {
                            required:true,
                            message:'请输入密码',
                            trigger:'blur'
                        },
                        {
                            min:6,
                            max:30,
                            message:'长度须在6到30个字符',
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
        computed:{
            ...mapState({
                TAlist:state=>state.TAmanage.TAlist,
                classList:state=>state.TAmanage.classList
            })
        },
        methods:{
            addTA(){
                this.$refs.TAform.validate((valid)=>{
                    if(valid){
                        console.log(this.TAform)
                    }
                })
            },
            deleteTA(){

            }
        }
    }
</script>
