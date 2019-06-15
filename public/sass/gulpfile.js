var gulp = require('gulp');
var sass = require('gulp-sass');
var gutil = require('gulp-util');
uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
//var sourcemaps = require('gulp-sourcemaps');

gulp.task('sass', function() {
    gulp.src('sass/**/*.scss')
        //.pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}))
        .on('error', gutil.log)
        //.pipe(sourcemaps.write('../css/maps'))
        .pipe(gulp.dest('../css'))
});

gulp.task('compress', function() {
    gulp.src('../js/*.js')
        .pipe(minify({
            ext:{
                src:'-debug.js',
                min:'.js'
            },
        }))
        .pipe(gulp.dest('../js/build'))
});

gulp.task('watch', function() {
    gulp.watch('sass/**/*.scss', ['sass']);
});


gulp.task('md-js', ['compress', 'main-js']);