var gulp = require('gulp');
var data = require('gulp-data');

gulp.task('default', function() {
  return gulp.src('./data/**/*.json')
  .pipe(data(function(file){
    console.log(file);
  }));
});
