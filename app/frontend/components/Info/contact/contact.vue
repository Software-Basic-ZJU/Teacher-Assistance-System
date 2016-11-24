<template>
    <div>
        <div>
            <el-button type="success" class="fr" icon="edit" @click="editContact"></el-button>
            <div class="content">
                <div class="contactItem" v-for="(item,index) in contact">
                    <span class="title">{{index=='ohterContact'?'其他联系方式':index}}：</span>
                    <span class="content" v-html="item"></span>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .el-button{
        margin-top:-62px;
    }
    .content{
        padding:0px;
    }
    .contactItem{
        margin-bottom:20px;
        font-size:18px;
    }
    .contactItem .title{
        font-weight: bold;
        margin-right:20px;
    }
</style>
<script>
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
            editContact(){
                router.push({name:'editContact'})
            }
        }
    }
</script>
