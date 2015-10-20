var gulp = require('gulp');
var compass = require('gulp-compass');
var shell = require('gulp-shell');
var premailer = require('gulp-premailer');
var livereload = require('gulp-livereload');

var file = 'template/normal/template.html';
var xlsx_file = "xlsx/xlsx.xlsx";
var email_dir = "html/";
var key_code = "file-name";

gulp.task('compass', function() {
  gulp.src('src/css/sass/*.scss')
    .pipe(compass({
      css: 'src/css',
      sass: 'src/css/sass'
    }))
    .pipe(gulp.dest('src/css'))
    .pipe(livereload());
});
gulp.task('inline', function() {
  gulp.src(file)
  .pipe(shell('ruby inlinecss.rb '+file))
  .pipe(shell('php xlsx2email.php '+ file + ' ' + xlsx_file + ' ' + email_dir + ' ' +key_code))
  .pipe(livereload());
});
gulp.task('inline-gulp', function() {
  gulp.src(file)
  .pipe(premailer())
  .pipe(gulp.dest('template/inline/'));
});
gulp.task('watch', function () {
  livereload.listen();
  gulp.watch('src/css/sass/*.scss', ['compass','inline']);
  gulp.watch([file], ['inline']);
});

livereload({ start: true });
gulp.task('default', ['watch', 'compass','inline']);