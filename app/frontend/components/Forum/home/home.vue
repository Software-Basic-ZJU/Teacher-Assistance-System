<template>
    <div>
        <div class="header">
            <h2>讨论区</h2>
        </div>
        <div class="sectionBox">
            <div
                class="section"
                v-for="item in sectionList"
                :key="item.secId"
                @click="goPath(item.to)"
            >
                <h3>{{item.name}}</h3>
                <div class="infoBox">
                    <div>帖子总数：{{item.postNum}}</div>
                    <div>今日新帖：{{item.todayNum}}</div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .header{
        border-bottom:1px solid #D3DCE6;
    }
    .header>h2{
        color:#475669;
        height:25px;
        margin-top:0px;
    }
    .sectionBox{
        margin-top:20px;
        text-align: center;
    }
    .section{
        display:inline-block;
        width:30%;
        text-align: center;
        cursor:pointer;
        margin:0px 10px;
        padding-bottom:20px;
        -webkit-box-shadow: 0 1px 5px 0 rgba(0,34,77,.2);
        -moz-box-shadow: 0 1px 5px 0 rgba(0,34,77,.2);
        box-shadow: 0 1px 5px 0 rgba(0,34,77,.2);
        -webkit-transition: box-shadow 0.5s;
        -moz-transition: box-shadow 0.5s;
        -ms-transition: box-shadow 0.5s;
        -o-transition: box-shadow 0.5s;
        transition: box-shadow 0.5s;
    }
    .section h3{
        color:#475669;
        -webkit-transition: color 0.5s;
        -moz-transition: color 0.5s;
        -ms-transition: color 0.5s;
        -o-transition: color 0.5s;
        transition: color 0.5s;
    }
    .section:hover{
        -webkit-box-shadow:  0 1px 8px  rgba(0,34,77,.4);
        -moz-box-shadow:  0 1px 8px  rgba(0,34,77,.4);
        box-shadow:  0 1px 8px  rgba(0,34,77,.4);
    }
    .section:hover h3{
        color:#6ECADC;
    }
    .infoBox{
        font-size:14px;
        color:#8492A6;
    }
</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            this.$store.dispatch('getForumInfo');
            return{
                identify:1
            }
        },
        computed:{
            sectionList(){
                return this.$store.state.forum.sectionList
            }
        },
        methods:{
            goPath(section){
                if(section=='group' && !!this.identify) {    //如果不是学生
                    this.$message('请在小组名单中选择一个小组进入其讨论区。');
                    router.push({name:'member'});
                }
                else router.push({name:'section',params:{section:section}});
            }
        }
    }
</script>
