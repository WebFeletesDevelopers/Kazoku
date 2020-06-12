const path = require('path');

module.exports = {
    entry: path.resolve(__dirname, 'ts/main.ts'),
    output: {
        filename: 'typescript.js',
        path: path.resolve(__dirname, 'tmp')
    },
    watch: false,
    devtool: 'inline-source-map',
    mode: 'development',
    resolve: {
        extensions: ['.ts', '.js']
    },
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                exclude: /(node_modules)/,
                use: [
                    {
                        loader: 'ts-loader'
                    }
                ]
            }
        ]
    }
};
