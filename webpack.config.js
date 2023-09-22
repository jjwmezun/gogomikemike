const path = require('path');

module.exports = {
    mode: 'production',
    module: {
        rules: [
            {
                test: /\.(?:js|mjs|cjs)$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env', { targets: "defaults" }]
                        ]
                    }
                }
            }
        ]
    },
    entry: [
        './assets/js/random-palette.js',
        './assets/js/sticky-header.js',
        './assets/js/search.js'
    ],
    output: {
        filename: 'index.js',
        path: path.resolve( __dirname, 'assets/dist' ),
    }
};