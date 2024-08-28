const path = require('path');

module.exports = {
  entry: {
    main: path.resolve(__dirname, 'assets/src/js/main.js'),
  },
  output: {
    filename: '[name].min.js',
    path: path.resolve(__dirname, 'assets/dist/js'),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
        options: {
          presets: ['@babel/preset-env'],
        },
      },
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        vendors: {
          test: /[\\/]node_modules[\\/]/,
          chunks: 'initial',
          filename: 'vendor.min.js',
          priority: 1,
          maxInitialRequests: 2, // create only one vendor file
          minChunks: 1,
        },
      },
    },
  },
  mode: process.env.NODE_ENV == 'production' ? 'production' : 'development',
};
