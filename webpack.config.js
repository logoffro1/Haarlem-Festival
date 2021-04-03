const path = require('path');
const webpack = require('webpack');


module.exports = ({
    mode: 'development',
    entry: path.join(__dirname, '/src/assets/scripts/'),
    output: {
        filename: 'index.js'
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                use: 'babel-loader',
                exclude: /node_modules/,
            },
        ],
    },
});
