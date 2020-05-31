const gulp = require('gulp');

const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const webpack = require('webpack-stream');
const webpackDev = require('./webpack.dev.js');
const webpackProd = require('./webpack.prod.js');

const sass = require('gulp-sass');

const sourcemaps = require('gulp-sourcemaps');
const concat = require('gulp-concat');
const path = require('path');
const rimraf = require('rimraf');

const jsFiles = [
    'js/jquery-3.5.1.js',
    'js/bootstrap.min.js',
    'js/Chart.js',
    'js/bs-init.js',
    'js/jquery.easing.js',
    'js/theme.js',
    'js/scripts.js',
];

/******* DEV *******/

gulp.task('ts-dev', () => {
    return gulp.src('./ts/main.ts')
        .pipe(webpack(webpackDev))
        .pipe(gulp.dest('./tmp'));
});

gulp.task('styles-dev', () => {
    const result = gulp.src('./scss/main.scss')
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('../public/css'));
    rimraf.sync(path.resolve(__dirname, 'tmp'));
    return result;
});

gulp.task('scripts-dev', () => {
    return gulp.src([
        ...jsFiles,
        './tmp/typescript.js'
    ]).pipe(sourcemaps.init())
    .pipe(babel())
    .pipe(concat('main.js'))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('../public/js'));
});

gulp.task('build-dev', gulp.series('ts-dev', 'scripts-dev', 'styles-dev'));

gulp.task('watch', () => {
    gulp.watch('./ts/**/*.ts', gulp.series('ts-dev', 'scripts-dev'));
    gulp.watch('./scss/**/*.scss', gulp.series('styles-dev'));
})

/******* PROD *******/

gulp.task('ts', () => {
    return gulp.src('./ts/main.ts')
        .pipe(webpack(webpackProd))
        .pipe(gulp.dest('./tmp'));
});

gulp.task('styles', () => {
    const result = gulp.src('./scss/main.scss')
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(gulp.dest('../public/css'));
    rimraf.sync(path.resolve(__dirname, 'tmp'));
    return result;
});

gulp.task('scripts', () => {
    return gulp.src([
        ...jsFiles,
        './tmp/typescript.js'
    ]).pipe(babel())
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest('../public/js'));
});

gulp.task('build', gulp.series('ts', 'scripts', 'styles'));
