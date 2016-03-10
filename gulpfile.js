

var gulp   = require('gulp'),
	sass   = require('gulp-sass'),
	minify = require('gulp-minify-css'),
	concat = require('gulp-concat'),
	rename = require('gulp-rename'),
	uglify = require('gulp-uglify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
var path = {

	'resources':{
		'sass': './resources/assets/sass'
	},
	'public': {
		'css': './public/assets/css'
	},
	'sass': './resources/assets/sass/**/*.scss'
};

// knass compilation
gulp.task('knacss', function() {
	return gulp.src(path.resources.sass+'/knacss/sass/knacss.scss')
		.pipe(sass({
			onError: console.error.bind(console, 'SASS ERROR')
		}))
		.pipe(minify())
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(gulp.dest(path.public.css))
});

gulp.task('app', function() {
	return gulp.src(path.resources.sass+'/app.scss')
		.pipe(sass({
			onError: console.error.bind(console, 'SASS ERROR')
		}))
		.pipe(minify())
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(gulp.dest(path.public.css))
});

// watch
gulp.task('watch', function() {
	gulp.watch(path.sass, ['knacss', 'app']);
});

gulp.task('default', ['watch']);
