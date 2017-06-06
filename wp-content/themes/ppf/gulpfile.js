'use strict';

// Load plugins
var gulp = require('gulp');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var minifyJS = require('gulp-uglify');
var minifyCSS = require('gulp-minify-css');
var watcher = require('gulp-watch');
var gutil = require('gulp-util');
var rename = require('gulp-rename');
var plumber = require('gulp-plumber');

/**
* Compile SCSS files
*/
gulp.task('styles', function() {
	gulp.src( 'scss/theme.scss' )
	  .pipe( plumber() )
	  .pipe( sass().on('error', sass.logError) )
	  .pipe( rename({suffix: '.min'}))
	  .pipe( gulp.dest('css') );
});

// Scripts
gulp.task('scripts', function() {
  //return gulp.src('js/**/*.js')
	//  .pipe( plumber() )
	//  .pipe( sass().on('error', sass.logError ))
	//  .pipe( rename( {suffix: '.min'} ) )
});

gulp.task('default', ['styles'] );


/**
* Watcher task.
*/
gulp.task('watch', function() {
	gulp.watch( 'scss/**/*.scss', ['styles'] );
	//gulp.watch( 'js/**/*.js', ['scripts'] );
});



