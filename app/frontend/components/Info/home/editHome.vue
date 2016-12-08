<template>
    <div>
        <div>
            <h3>编辑首页</h3>
            <Editor
                btn-name="确认更改"
                method="editHome"
                :has-title="false"
                :data="homeInfo"
            >

            </Editor>
        </div>
    </div>
</template>
<style scoped>
    h3{
        margin-top:0px;
    }
</style>
<script>
    import Editor from "../../Editor/Editor.vue";
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
        components:{
            Editor
        }
    }
</script>
