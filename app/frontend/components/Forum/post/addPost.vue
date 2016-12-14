<template>
    <div>
        <div>
            <h3>发布主题</h3>
            <Editor method="addPost" btn-name="发布" :has-upload="true" :default-file-list="defaultFileList" :upload-info="uploadInfo" :data="cacheResrc"></Editor>
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
                uploadInfo:{
                    uploader_id:userInfo.id,
                    type:1
                },
                defaultFileList:[]
            }
        },
        computed:{
            cacheResrc(){       //从缓存中获取已上传的文件
                let resource=LS.getItem("resource");
                let cache={
                    title:'',
                    content:''
                };
                if(resource){
                    cache.resrcId=resource.resource_id;
                    this.defaultFileList.push({
                        name:resource.name,
                        path:resource.path
                    })
                }
                return cache;
            }
        },
        components:{
            Editor
        }
    }
</script>
