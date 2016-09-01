var gulp = require('gulp');
var gutil = require('gulp-util');
var data = require('gulp-data');
var source = require('vinyl-source-stream');
var pug = require('gulp-pug');
var watchify = require('watchify');
var browserify = require('browserify');
var webserver = require('gulp-webserver');

var bundler = watchify(browserify('./src/App.js', watchify.args));

function bundle() {
  return bundler.bundle()
    // log errors if they happen
    .on('error', gutil.log.bind(gutil, 'Browserify Error'))
    .pipe(source('app.js'))
    .pipe(gulp.dest('./build'));
}

gulp.task('default', function() {
  return gulp.src('./data/**/*.json')
  .pipe(data(function(file){
    console.log(file);
  }));
});

function buildPug() {
  console.log("got here");
  return gulp.src('./templates/**/*.pug')
    .pipe(pug())
    .pipe(gulp.dest('build'));

}

gulp.task('webserver', function() {
  gulp.src('build')
  .pipe(webserver({
    port: 3456,
    livereload: false,
    host: '0.0.0.0',
    directoryListing: false,
    open: false
  }));
});

gulp.task('build-templates', function() {
  return buildPug();
});

gulp.task('default', ['build-templates', 'webserver'], function() {
  bundle();
});

gulp.task('build-dev', ['build-templates'], function() {
  bundle();
});
