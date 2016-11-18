<template>
    <div>
        <div class="homework">
            <div class="header">
                <h2>作业列表</h2>
            </div>
            <hw-item
                    v-for="item in hwList"
                    :key="item.hwId"
                    :hwId="item.hwId"
                    :title="item.title"
                    :update-time="item.updateTime"
                    :deadline="item.deadline"
                    :identify="identify"
            ></hw-item>
        </div>
    </div>
</template>
<style scoped>
    .homework{
        padding:0px 20px;
    }
    .header{
        border-bottom:1px solid #D3DCE6;
    }
    .header>h2{
        color:#475669;
        height:25px;
        margin-top:0px;
    }
</style>
<script>
    import hwItem from "./hwItem.vue";
    export default{
        data(){
            return{
                hwList:[
                    {
                        hwId:1,
                        title:'第一章作业',
                        updateTime:"2016-11-03",
                        deadline:"2016-12-03"
                    },
                    {
                        hwId:2,
                        title:'第二章作业',
                        updateTime:"2016-11-03",
                        deadline:"2016-12-03"
                    }
                ],
                identify:1
            }
        },
        components:{
            hwItem
        }
    }
</script>
