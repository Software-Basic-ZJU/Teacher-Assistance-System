<template>
    <div>
        <el-button type="success" class="fr" icon="plus" @click="addArticle" v-if="idenType==2"></el-button>
        <el-input
                placeholder="搜索文章"
                icon="search"
                class="searchBox fr"
                :class="{'offsetRight':idenType==2}"
                v-model="keywords"
                @input="goSearch($event)"
        ></el-input>
        <div class="articleBox">
            <div class="noRes" v-if="articleList.length==0">还没有发表文章~</div>
            <transition-group
                    name="staggered-fade"
                    v-on:before-enter="beforeEnter"
                    v-on:enter="enter"
                    v-on:leave="leave"
            >
                <article-item
                        v-for="item in articleList"
                        :key="item.article_id"
                        :art-id="item.article_id"
                        :title="item.title"
                        :author="item.author"
                        :publish-time="item.time"
                        :content="item.content"
                        :reply-num="item.comment_num"
                        :authority="item.authority"
                >
                </article-item>
            </transition-group>
            <el-pagination
                    small
                    @current-change="changePage"
                    page-size="8"
                    :current-page="currPage"
                    layout="prev,pager,next"
                    :total="articlesNum"
            ></el-pagination>
        </div>
    </div>
</template>
<style scoped>
    .articleBox{
        position: relative;
    }
    .articleBox .noRes{
        padding:20px 0px 10px 0px;
        text-align: center;
    }
    .el-button--success{
        margin-top:-62px;
    }
    .el-pagination{
        margin-top:10px;
    }
    .searchBox{
        margin-top:-62px;
    }
    .offsetRight{
        margin-right:60px;
    }
</style>
<script>
    import articleItem from "./articleItem.vue";
    import router from "../../../routes";
    import {LS} from "../../../helpers/utils";
    import {mapState} from "vuex";
    import Velocity from "velocity-animate";

    export default{
        data(){
            let userInfo=LS.getItem('userInfo');
            this.$store.dispatch('getArticleList');
            return{
                idenType:userInfo.type,
            }
        },
        computed:{
            ...mapState({
                articlesNum:state=>state.info.articleList.length,
                currPage:state=>state.info.articleCurrPage,
                keywords:state=>state.info.keywords
            }),
            articleList(){
                return this.$store.getters.articleList;
            }
        },
        methods:{
            addArticle(){
                router.push({name:'addArticle'});
            },
            changePage(val){
                this.$store.dispatch('changeArtPage',val);
            },
            goSearch(keywords){
                this.$store.dispatch('updateKeywords',keywords);
            },

//          列表过渡效果方法
            beforeEnter: function (el) {
                el.style.opacity = 0
            },
            enter: function (el, done) {
                var delay = el.dataset.index * 100;
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 1, height: el.offsetHeight },
                        { complete: done }
                    )
                }, delay)
            },
            leave: function (el, done) {
                var delay = el.dataset.index * 100;
                setTimeout(function () {
                    Velocity(
                        el,
                        { opacity: 0, height: 0 },
                        { complete: done }
                    )
                }, delay)
            }
        },
        components:{
            articleItem
        },
        head:{
            title(){
                return {
                    inner:'教师文章'
                }
            }
        }
    }
</script>
