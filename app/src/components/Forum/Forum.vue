<template>
    <div>
        <div class="forum">
            <div class="header">
                <h2>讨论区</h2>
            </div>
            <div class="section">
                <el-button
                        type="text"
                        v-for="item in sections"
                        :key="item.secId"
                >
                    <router-link :to="{name:item.to}">{{item.name}}</router-link>
                </el-button>
            </div>
            <div>
                <transition name="fade">
                    <router-view></router-view>
                </transition>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .forum{
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
    .el-card{
        margin-top:20px;
    }

</style>
<script>
    export default{
        data(){
            return{
                sections:[
                    {
                        secId:1,
                        to:'teacherQA',
                        name:'教师答疑区'
                    },
                    {
                        secId:2,
                        to:'publicForum',
                        name:'公共讨论区'
                    },
                    {
                        secId:3,
                        to:'groupForum',
                        name:'小组讨论区'
                    }
                ]
            }
        }
    }
</script>
