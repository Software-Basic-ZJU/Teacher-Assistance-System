<template>
    <div>
        <div class="detail">
            <div class="title">{{title}}</div>
            <div class="content">{{content}}</div>
        </div>
    </div>
</template>
<style>
    .detail{

    }
</style>
<script>
    export default{
        data(){
            console.log(this.$route.params.nid)
            return{
                title:"Hello",
                content:"I'm LowesYang"
            }
        }
    }
</script>
