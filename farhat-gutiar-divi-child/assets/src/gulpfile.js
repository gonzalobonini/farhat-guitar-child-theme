var gulp = require('gulp');
var sass = require('gulp-sass');
const minify = require('gulp-minify');
var concat = require('gulp-concat');

gulp.task('watch', function(){
  gulp.watch('scss/*.scss', gulp.series('sass'));
  gulp.watch('js/*.js', gulp.series('scripts'));
});


gulp.task('sass', function(){
  return gulp.src('scss/style.scss')
    .pipe(sass({outputStyle: 'compressed'})) // Converts Sass to CSS with gulp-sass
    .pipe(gulp.dest('../../'))
});

gulp.task('scripts', function() {
 return gulp.src(['js/*.js', 'js/*.mjs'])
  .pipe(concat('farhat-all.js'))
  .pipe(minify({
    noSource: true
  }))
  .pipe(gulp.dest('../js'));
  }); 


gulp.task('minjs', function() {
  return gulp.src(['js/*.js', 'js/*.mjs'])
    .pipe(minify({
      noSource: true
    }))
    .pipe(gulp.dest('../js'))
});
