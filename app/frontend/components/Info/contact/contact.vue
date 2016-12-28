<template>
    <div>
        <div>
            <el-button type="success" class="fr" icon="edit" @click="editContact" v-if="idenType==2"></el-button>
            <div class="content">
                <div class="contactItem" v-for="(item,index) in contact">
                    <span class="title">{{index=='other_contact'?'其他联系方式':index}}：</span>
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
        font-size:16px;
    }
    .contactItem .title{
        font-weight: bold;
        margin-right:20px;
    }
</style>
<script>
    import router from "../../../routes";
    import {LS} from "../../../helpers/utils";
    import {mapState} from "vuex";

    export default{
        data(){
            this.$store.dispatch('getContact');
            return{
            }
        },
        computed:{
            ...mapState({
                contact:state=>state.info.contact,
                idenType:state=>state.userInfo.type
            })
        },
        methods:{
            editContact(){
                router.push({name:'editContact'})
            }
        },
        head:{
            title(){
                return {
                    inner:'教师联系方式'
                }
            }
        }
    }
</script>
