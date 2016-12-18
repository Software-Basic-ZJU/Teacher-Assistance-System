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
        margin:20px 0px 10px 0px;
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
    import {LS} from "../../../helpers/utils";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            this.$store.dispatch('getForumInfo');
            this.$store.dispatch('changePostPage',1);   //重置各版块至第一页
            return{
                idenType:userInfo.type
            }
        },
        beforeRouteEnter(to,from,next){
            let userInfo=LS.getItem('userInfo');
            if(userInfo.type!=1){
                userInfo.group_id=null;
                LS.setItem('userInfo',userInfo);
            }
            next();
        },
        computed:{
            sectionList(){
                return this.$store.state.forum.sectionList
            }
        },
        methods:{
            goPath(section){
                router.push({name:'section',params:{section:section}});
            }
        }
    }
</script>
