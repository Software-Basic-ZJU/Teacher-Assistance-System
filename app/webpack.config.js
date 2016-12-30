var webpack=require("webpack");
var HtmlWebpackPlugin=require("html-webpack-plugin");
var debug=false;         //debug switch

module.exports={
    entry: {
        index:'./frontend/index',
        vendor:['vue','vuex','vue-router']
    },
    output:{
        path:'./build',
        filename:debug?'[name].min.js':'[name].[chunkhash:5].js',
        publicPath:debug?'/build/':'',
        chunkFilename:'[id].[chunkhash:5].chunk.js'
    },
    module:{
        loaders:[
            {
                test:/\.js[x]?$/,
                loader:'babel',
                exclude:/node_modules/,
                plugins:['transform-time']
            },
            {
                test:/\.css$/,
                loader:'style!css'
            },
            {
                test:/\.(eot|svg|ttf|woff|woff2)(\?\S*)$/,
                loader:'file-loader'
            },
            {
                test:/\.(png|jpe?g|svg|gif)(\?\S*)?$/,
                loader:'file-loader',
                query:{
                    name:'[name].[ext]?[hash]'
                }
            },
            {
                test:/\.vue$/,
                loader:'vue'
            }
        ]
    },
    resolve:{
        extensions:['','.js','.jsx'],
        alias:{
            'vue$':'vue/dist/vue.min.js'
        }
    },
    plugins:[
        new webpack.optimize.CommonsChunkPlugin('vendor',debug?'commons.js':'commons.[chunkhash:5].js'),
        new HtmlWebpackPlugin({
            template:'index.html',
            inject:'body'
        })
    ]
}