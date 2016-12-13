<template>
    <div>
        <div>
            <h3>编辑主题</h3>
            <Editor
                    method="editPost"
                    btn-name="更新"
                    :data="hostPost"
                    :has-upload="true"
                    :upload-info="uploadInfo"
                    :default-file-list="currPost.defaultFile"
            ></Editor>
        </div>
    </div>
</template>
<style>
    
</style>
<script>
    import Editor from "../../Editor/Editor.vue"
    import {LS} from "../../../helpers/utils";
    export default{
        data(){
            let userInfo=LS.getItem("userInfo");
            return{
                uploadInfo:{  //上传文件额外的参数
                    uploader_id:userInfo.id,
                    type:1,
                    post_id:this.$route.params.pid
                }
            }
        },
        computed:{
            currPost(){
                let post=this.$store.state.forum.currPost;
                if(post.defaultFile.length) this.$store.dispatch("isFileUpload",true);
                return this.$store.state.forum.currPost;
            }
        },
        beforeRouteLeave(to,from,next){
            this.$store.dispatch("isFileUpload",false);
        },
        components:{
            Editor
        }
    }
</script>
