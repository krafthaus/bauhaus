var gulp     = require('gulp'),
	watch    = require('gulp-watch'),
	sass     = require('gulp-sass'),
	uglify   = require('gulp-uglify'),
	concat   = require('gulp-concat'),
	prefixer = require('gulp-autoprefixer'),
	imagemin = require('gulp-imagemin');

var paths = {
	stylesheets: 'assets/stylesheets/**/*.scss',
	javascripts: [
		'assets/javascripts/**/*.js',
		'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js',
		'bower_components/prismjs/prism.js',
		'bower_components/prismjs/components/prism-php.js'
	],
	images: 'assets/images/**/*.{gif,png,jpg}'
};

gulp.task('sass', function() {
	return gulp.src(paths.stylesheets)
		.pipe(sass({
			outputStyle: 'compressed'
		}))
		.pipe(prefixer('last 10 versions'))
		.pipe(gulp.dest('static/stylesheets'));
});

gulp.task('uglify', function () {
	return gulp.src(paths.javascripts)
		.pipe(concat('application.js'))
		.pipe(uglify())
		.pipe(gulp.dest('static/javascripts'));
});

gulp.task('image', function () {
	return gulp.src(paths.images)
		.pipe(imagemin({
			progressive: true
		}))
		.pipe(gulp.dest('static/images'));
});

gulp.task('watch', function () {
	gulp.watch(paths.stylesheets, ['sass']);
	gulp.watch(paths.javascripts, ['uglify']);
	gulp.watch(paths.images,      ['image']);
});

gulp.task('default', ['sass', 'uglify', 'image']);