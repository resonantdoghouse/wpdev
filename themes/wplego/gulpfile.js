var gulp = require('gulp'),
    watch = require('gulp-watch'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    cssvars = require('postcss-simple-vars'),
    nested = require('postcss-nested'),
    cssImport = require('postcss-import');

gulp.task('default', function() {
    console.log('default task has run');
});

gulp.task('php', function() {
    console.log('php task has run');
});

gulp.task('styles', function() {
    return gulp.src('./assets/css/styles.css')
        .pipe(postcss([cssImport, cssvars, nested, autoprefixer]))
        .pipe(gulp.dest('./assets/build/styles'));
});

gulp.task('watch', function() {

    watch('./**/*.php', function() {
        gulp.start('php');
    });

    watch('./assets/css/**/*.css', function() {
        gulp.start('styles');
    });

});
