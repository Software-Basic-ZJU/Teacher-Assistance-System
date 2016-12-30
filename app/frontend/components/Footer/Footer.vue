<template>
    <div>
        <div class="footer">
            <div class="main">
                <div class="link">
                    <a v-for="item in linkList" :href="item.path" target="_blank">{{item.name}}</a>
                </div>
                <div class="websiteInfo">
                    <div class="copyright fl">
                        Copyright &copy; 2016. SRE G12 All rights reserved.
                    </div>
                    <div class="author fr">Privacy Policy &nbsp;&nbsp;Terms of Use</div>
                    <div class="cl"></div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .footer{
        width:100%;
        height:85px;
        background-color: #2a2a2a;
        font-size:14px;
    }
    .main{
        width:1000px;
        height:85px;
        margin:0px auto;
    }
    .link{
        padding:15px 0px 12px 0px;
        text-align: center;
        border-bottom:1px solid #C3C3C3;
    }
    .link a{
        display: inline-block;
        margin-left:4%;
        margin-right:4%;
        color:#C3C3C3;
        -webkit-transition: color 0.3s;
        -moz-transition: color 0.3s;
        -ms-transition: color 0.3s;
        -o-transition: color 0.3s;
        transition: color 0.3s;
    }
    .link a:hover{
        color:#6ECADC;
    }
    .websiteInfo{
        margin-top:10px;
        color:#C3C3C3;
    }
</style>
<script>
    export default{
        data(){
            return{
                linkList:[
                    {
                        path:"http://www.zju.edu.cn",
                        name:">>浙江大学官网"
                    },
                    {
                        path:"http://jwbinfosys.zju.edu.cn/default2.aspx",
                        name:">>教务网"
                    },
                    {
                        path:"http://www.cs.zju.edu.cn/",
                        name:">>计算机学院"
                    },
                    {
                        path:"http://jwb.zju.edu.cn/",
                        name:">>本科生院"
                    },
                    {
                        path:"http://10.214.0.253/network/",
                        name:">>友情课程"
                    },
                ]
            }
        },
    }
</script>
