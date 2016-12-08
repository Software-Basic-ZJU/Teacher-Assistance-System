<template>
    <div>
        <div>
            <h3>编辑主题</h3>
            <Editor
                    method="editPost"
                    btn-name="更新"
                    :data="hostPost"
                    :has-upload="true"
                    :default-file-list="fileList"
            ></Editor>
        </div>
    </div>
</template>
<style>
    
</style>
<script>
    import Editor from "../../Editor/Editor.vue"
    export default{
        data(){
            return{
                fileList:[
                    {
                        name:'food.jpeg',
                        url:'https://dsfsdds'
                    }
                ]
            }
        },
        computed:{
            hostPost(){
                let pid=this.$route.params.pid;
                let list=this.$store.state.forum.postList;
                for(let i=0;i<list.length;i++){
                    if(list[i].pid==pid){
                        return list[i];
                    }
                }
            }
        },
        components:{
            Editor
        }
    }
</script>
