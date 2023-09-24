const path = require( 'path' );
const TerserPlugin = require( 'terser-webpack-plugin' );

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
    entry: {
        index: [
            './assets/js/random-palette.js',
            './assets/js/sticky-header.js',
            './assets/js/search.js'
        ],
        archives: './assets/js/archives.js'
    },
    output: {
        filename: '[name].js',
        path: path.resolve( __dirname, 'assets/dist' ),
    },
    optimization: {
        minimize: true,
        minimizer: [
          new TerserPlugin({
            extractComments: false,
            terserOptions: {
              format: {
                comments: false,
              },
            },
          }),
        ],
      }
};