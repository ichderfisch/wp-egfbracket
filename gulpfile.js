'use strict';

var gulp = require('gulp');

// CSS & JS
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');

/**
 *
 * Table of Content
 * ----------------
 * sass:build
 * sass:dev
 *
 **/

 gulp.task('sass:dev', function () {
     return gulp.src('./scss/**/*.scss')
     .pipe(sourcemaps.init())
     .pipe(sass().on('error', sass.logError))
     .pipe(autoprefixer({
         browsers: ['last 2 versions', 'ie >= 8', '> 1%'],
         cascade: false
     }))
     .pipe(sourcemaps.write())
     .pipe(gulp.dest('./css/'))
 });

gulp.task('sass:build', function () {
    return gulp.src('./scss/**/*.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(autoprefixer({
        browsers: ['last 2 versions', 'ie >= 8', '> 1%'],
        cascade: false
    }))
    .pipe(gulp.dest('./css/'));
});

