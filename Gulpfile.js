var gulp   = require('gulp'),
	watch  = require('gulp-watch'),
	sass   = require('gulp-sass'),
	uglify = require('gulp-uglifyjs'),
	rename = require('gulp-rename');

var paths = {
	stylesheets: [
		'assets/stylesheets/**/*.scss',
		'bower_components/bootstrap-sass-official/vendor/assets/stylesheets/**/*.scss'
	],
	javascripts: [
		'bower_components/jquery/dist/jquery.min.js',
		'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap.js',
		'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/alert.js',
		'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js',
		'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js',
		'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tab.js',
		'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/modal.js',
		'bower_components/bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js',
		'bower_components/tinymce/tinymce.js',
		'assets/javascripts/**/*.js'
	]
};

gulp.task('sass', function() {
	return gulp.src(paths.stylesheets)
		.pipe(sass())
		.pipe(gulp.dest('public/stylesheets'));
});

gulp.task('uglify', function () {
	return gulp.src(paths.javascripts)
		.pipe(uglify({
			mangle: false
		}))
		.pipe(rename('application.min.js'))
		.pipe(gulp.dest('public/javascripts'));
});

gulp.task('watch', function () {
	gulp.watch(paths.stylesheets, ['sass']);
	gulp.watch(paths.javascripts, ['uglify']);
});
