<template>
    <div>
        <div>
            <el-button type="success" icon="edit" @click="editHome"></el-button>
            <div class="content" v-html="homeInfo.content"></div>
        </div>
    </div>
</template>
<style scoped>
    .content{
        padding:0px;
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
            homeInfo(){
                return this.$store.state.info.homeInfo;
            }
        },
        methods:{
            editHome(){
                router.push({name:'editHome'})
            }
        }
    }
</script>
