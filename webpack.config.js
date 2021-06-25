const webpack = require("webpack"),
			path = require("path"),
			env = require("yargs").argv.env,
			version = require("./package.json").version,
			autoprefixer = require("autoprefixer"),
			MiniCssExtractPlugin = require("mini-css-extract-plugin"),
			OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin"),
			FileManagerPlugin = require('filemanager-webpack-plugin');

const config = {
	mode: env === "build" ? "production" : "development",
	entry: [
		__dirname + "/src/script.js",
		__dirname + "/src/style.scss"
	],
	devtool: "source-map",
	output: {
		path: path.resolve(__dirname + "/assets"),
		filename: env === "build" ? "script.min.js" : "script.js",
		library: "nychvs",
		libraryTarget: "umd",
		umdNamedDefine: true,
	},
	module: {
		rules: [
			{
				test: /(\.jsx|\.js)$/,
				loader: "babel-loader",
				exclude: /(node_modules|bower_components)/
			},
			{
				test: /(\.jsx|\.js)$/,
				loader: "eslint-loader",
				exclude: /node_modules/
			},
			{
				test: /(\.scss|\.sass)$/,
				use: [
					{
						loader: MiniCssExtractPlugin.loader
					},
					{
						loader: "css-loader",
						options: {
							sourceMap: true,
						}
					},
					// {
					// 	loader: "postcss-loader",
					// 	options: {
					// 		sourceMap: true,
					// 	}
					// },
					{
						loader: "sass-loader",
						options: {
							sourceMap: true
						}
					}
				],
			},
			{
				test: /\.(woff|woff2|ttf|eot)(\?v=\d+\.\d+\.\d+)?$/,
				loader: "file-loader"
			},
			{
				test: /\.svg/,
				use: [
					{
						loader: "svg-url-loader"
					}
				]
			}
		]
	},
	resolve: {
		modules: [path.resolve("./node_modules"), path.resolve("./src")],
		extensions: [".json", ".js"]
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: env === "build" ? "style.min.css" : "style.css",
			chunkFilename: "[id].css"
		}),
		new FileManagerPlugin( env === "build" ? {
			events: {
				onEnd: {
					delete: [__dirname + "/dist", __dirname + "/*.zip"],
					copy: [
						{
							source: __dirname + "/*.php",
							destination: __dirname + "/dist"
						},
						{
							source: __dirname + "/parts/*.php",
							destination: __dirname + "/dist/parts"
						},
						{
							source: __dirname + "/*.css",
							destination: __dirname + "/dist"
						},
						{
							source: __dirname + "/assets",
							destination: __dirname + "/dist/assets"
						},
					],
					archive: [
						{
							source: __dirname + "/dist",
							destination: __dirname + "/coi-v2.zip"
						},
					],
				},
			},
			runTasksInSeries: true,
		} : {}),
	],
	optimization: {
		minimize: env === "build" ? true : false,
		minimizer: [
			new OptimizeCSSAssetsPlugin({}),
		]
	}
};

module.exports = config;