const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');


const {
    prod_Path,
    src_Path
} = require('./path');
const {
    selectedPreprocessor
} = require('./loader');

module.exports = {
    entry: {
        main: './' + src_Path + '/index.js'
    },
    output: {
        path: path.resolve(__dirname, prod_Path),
        filename: '[name].js'
    },
    devtool: 'source-map',
    devServer: {
        open: true,
    },
    module: {
        rules: [{
            test: selectedPreprocessor.fileRegexp,
            use: [{
                loader: MiniCssExtractPlugin.loader
            },
                {
                    loader: 'css-loader',
                    options: {
                        modules: false,
                        sourceMap: true
                    }
                },
                {
                    loader: 'postcss-loader',
                    options: {
                        sourceMap: true
                    }
                },
                {
                    loader: selectedPreprocessor.loaderName,
                    options: {
                        sourceMap: true
                    }
                },
            ]
        },
            {
                test: /\.(png|jpg|gif|svg)$/,
                use: [{
                    loader: 'file-loader',
                }],
            },

            {
                test: /\.pug$/,
                use: ["pug-loader"]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'styles.css',
        }),
        new HtmlWebpackPlugin({
            inject: false,
            // hash: false,
            template: './' + src_Path + '/index.pug',
            filename: 'index.html'
        }),
        new HtmlWebpackPlugin({
            inject: false,
            // hash: false,
            template: './' + src_Path + '/follow.pug',
            filename: 'follow.html'
        }),
        new HtmlWebpackPlugin({
            inject: false,
            // hash: false,
            template: './' + src_Path + '/create-post.pug',
            filename: 'create-post.html'
        }),
        new HtmlWebpackPlugin({
            inject: false,
            // hash: false,
            template: './' + src_Path + '/login.pug',
            filename: 'login.html'
        }),
        new HtmlWebpackPlugin({
            inject: false,
            // hash: false,
            template: './' + src_Path + '/statistics.pug',
            filename: 'statistics.html'
        }),
    ]
};
