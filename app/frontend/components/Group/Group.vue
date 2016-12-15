<template>
    <div>
        <div class="group">
            <div class="btnGroup" v-if="!isInGroup && idenType==1">
                <el-button @click="showGroupAction(0)">创建小组</el-button>
            </div>
            <el-table
                    :data="groupList"
                    style="width: 100%">
                <el-table-column
                        prop="group_id"
                        label="小组id"
                        min-width="30"
                        :show-overflow-tooltip="true"
                >
                </el-table-column>
                <el-table-column
                        prop="group_name"
                        label="小组名称"
                        min-width="30"
                        :show-overflow-tooltip="true"
                >
                </el-table-column>
                <el-table-column
                        inline-template
                        label="小组成员"
                        min-width="60"
                        :show-overflow-tooltip="true"
                >
                    <span
                            v-for="item in row.group_member"
                    >
                        {{item.name}}
                    </span>
                </el-table-column>
                <el-table-column
                        inline-template
                        label="操作"
                        width="120"
                >
                    <span>
                        <el-button @click="goGroupForum($index,row)" size="small" v-if="idenType!=1">进入讨论区</el-button>
                        <el-button
                                type="danger"
                                @click="quitGroup($index,row)"
                                :plain="true"
                                size="small"
                                v-if="idenType==1 && groupId==row.group_id && sid!=row.group_leader"
                        >退出</el-button>
                        <el-button
                                type="danger"
                                @click="deleteGroup($index,row)"
                                :plain="true"
                                size="small"
                                v-if="idenType==1 && sid==row.group_leader"
                        >解散</el-button>
                        <el-button
                                type="primary"
                                size="small"
                                @click="showGroupAction(1,row.group_id)"
                                v-if="(!groupId || groupId==-1) && sid!=row.group_leader"
                        >加入小组</el-button>
                    </span>
                </el-table-column>
            </el-table>
        </div>
        <el-dialog
                :title="dialogTitle"
                v-model="showGroup"
                size="tiny"
                @close="closeAction"
        >
            <el-form :model="group">
                <el-form-item label="小组名称" :label-width="formLabelWidth" v-if="actionType==0">
                    <el-input v-model="group.name" auto-complete="off"></el-input>
                </el-form-item>
                <el-form-item label="小组密码" :label-width="formLabelWidth">
                    <el-input type="password" v-model="group.password" auto-complete="off"></el-input>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click.native="closeAction">取消</el-button>
                <el-button type="primary" @click.native="submitGroup">确定</el-button>
            </div>
        </el-dialog>
    </div>
</template>
<style scoped>
    .group{
        padding:0px 10px;

    }
    .group .el-table{
        margin-top:10px;
    }
</style>
<script>
    import {mapState} from 'vuex';
    import router from "../../routes";
    import {LS} from "../../helpers/utils";
    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            this.$store.dispatch('getGroupList');
            return {
                sid:userInfo.id,          //用户id
                actionType: 0,           //0为创建小组,1为加入小组
                isInGroup: false,
                group: {
                    id:'',
                    name: '',
                    password: ''
                },
                idenType:userInfo.type
            }
        },
        computed: {
            ...mapState({
                groupList:state=>state.group.groupList,
                showGroup:state=>state.group.showGroup,
                actionLoading:state=>state.group.actionLoading,
                groupId:state=>state.userInfo.group_id
            }),
            dialogTitle(){
                if (!this.actionType) return '创建小组';
                else return '加入小组';
            }
        },
        methods: {
            submitGroup(){
                let action = this.actionType ? 'joinGroup' : 'createGroup';
                this.$store.dispatch(action, this.group);
            },
            showGroupAction(type){
                this.actionType = type;
                if(this.actionType){
                    this.group.id=arguments[1];
                }
                this.$store.dispatch('showActionGroup',true);
            },
            closeAction(){
                this.$store.dispatch('showActionGroup',false);
                this.group={
                    id:'',
                    name:'',
                    password:''
                }
            },
            quitGroup(index, row){
                this.$confirm('确认退出该小组吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('quitGroup');
                }).catch(() => {});
            },
            deleteGroup(index,row){
                this.$confirm('确认解散该小组吗？', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    this.$store.dispatch('deleteGroup',row.group_id);
                }).catch(() => {});
            },
            goGroupForum(index, row){
                //TODO groupId存进教师的localstorage的身份信息中
                router.push({name: 'section', params: {section: 'group'}});
            }
        }
    }
</script>
