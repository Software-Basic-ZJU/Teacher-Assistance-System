<template>
    <div>
        <div>
            <h3>编辑联系方式</h3>
            <el-form :model="contact" label-position="left" label-width="120px">
                <el-form-item label="Email">
                    <el-input v-model="contact.email"></el-input>
                </el-form-item>
                <el-form-item label="Phone">
                    <el-input v-model="contact.phone"></el-input>
                </el-form-item>
                <el-form-item label="QQ">
                    <el-input v-model="contact.qq"></el-input>
                </el-form-item>
                <el-form-item label="Wechat">
                    <el-input v-model="contact.wechat"></el-input>
                </el-form-item>
                <el-form-item label="其他联系方式">
                    <el-input type="textarea" v-model="contact.otherContact"></el-input>
                </el-form-item>
                <el-button type="primary" @click="submitContact">确认修改</el-button>
                <el-button @click="goBack">取消</el-button>
            </el-form>
        </div>
    </div>
</template>
<style scoped>
    h3{
        margin-top:0px;
    }
    .el-input,.el-textarea{
        width:400px;
    }
</style>
<script>
    import Editor from "../../Editor/Editor.vue";
    import router from "../../../routes";
    export default{
        data(){
            return{
            }
        },
        computed:{
            contact(){
                return this.$store.state.info.contact;
            }
        },
        methods:{
            submitContact(){
                this.$store.dispatch('editContact',this.contact);
            },
            goBack(){
                router.go(-1);
            }
        },
        components:{
            Editor
        }
    }
</script>
