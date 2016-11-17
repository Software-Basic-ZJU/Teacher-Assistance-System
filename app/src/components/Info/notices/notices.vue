<template>
    <div>
        <div class="noticeBox">
            <div class="noteItem" v-for="item in noticeList" :key="$index" @click.stop="goDetail(item.nid)">
                <i class="iconfont fl" :class="{'icon-tongzhi1':item.level==0,'icon-icon15 serious':item.level==1}"></i>
                <div class="title fl">{{item.title}}</div>
                <div class="time fr">{{item.time}}</div>
                <div class="cl"></div>
            </div>
        </div>
    </div>
</template>
<style>
    .noticeBox{
    }
    .noteItem{
        width:100%;
        height:30px;
        border-bottom:1px solid #E5E9F2;
        margin-bottom: 20px;
        cursor:pointer;
        -webkit-transition: border-color 0.3s;
        -moz-transition: border-color 0.3s;
        -ms-transition: border-color 0.3s;
        -o-transition: border-color 0.3s;
        transition: border-color 0.3s;
    }
    .noteItem:hover{
        border-color:#58B7FF;
    }
    .noteItem .iconfont{
        font-size:20px;
        margin-top:-2px;
    }
    .noteItem .serious{
        color:#FF4949;
    }
    .noteItem .title{
        margin-left: 10px;
    }
    .noteItem .time{
        margin-right:10px;
    }

</style>
<script>
    import router from "../../../routes";
    export default{
        data(){
            return{
                noticeList:[
                    {
                        nid:"111",
                        title:'hello',
                        time:'2016-11-02',
                        level:1
                    },
                    {
                        nid:"1112",
                        title:'lowesyang',
                        time:'2016-11-13',
                        level:0
                    }
                ]
            }
        },
        methods:{
            goDetail(nid){
                router.push({name:'notice',params:{nid:nid}});
            }
        }
    }
</script>
