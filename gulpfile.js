const gulp = require("gulp");
const { parallel, series } = require("gulp");

const imagemin = require("gulp-imagemin");
const htmlmin = require("gulp-htmlmin");
const uglify = require("gulp-uglify");
const sass = require("gulp-sass");
const concat = require("gulp-concat");
const browserSync = require("browser-sync").create(); //https://browsersync.io/docs/gulp#page-top
const autoprefixer = require('gulp-autoprefixer');
const babel = require('gulp-babel');

const filePath = {
    baseDir: "dist/",
    js: "src/scripts/**/*.js",
    html: "src/**/*.html",
    scss: "src/styles/**/*.scss",
    images: "src/assets/images/**/*",
    dist: {
        js: "dist/scripts",
        html: "dist",
        scss: "dist/styles",
        images: "dist/images",
    }
}

// Optimise Images
function imageMin(cb) {
    gulp.src(filePath.images)
        .pipe(imagemin())
        .pipe(gulp.dest(filePath.dist.images));
    cb();
}

// Scripts
function js(cb) {
    gulp.src(filePath.js)
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(concat("index.js"))
        .pipe(uglify())
        .pipe(gulp.dest(filePath.dist.js));
    cb();
}

// Compile Sass
function css(cb) {
    gulp.src(filePath.scss)
        .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
        .pipe(autoprefixer({
            browserlist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest(filePath.dist.scss))
        // Stream changes to all browsers
        .pipe(browserSync.stream());
    cb();
}

// Process Nunjucks
function nunjucks(cb) {
    gulp.src(filePath.html)
        .pipe(gulp.dest(filePath.dist.html));
    cb();
}

function nunjucksMinify(cb) {
    gulp.src(filePath.html)
        .pipe(
            htmlmin({
                collapseWhitespace: true
            })
        )
        .pipe(gulp.dest(filePath.dist.html));
    cb();
}

// Watch Files
function watch_files() {
    browserSync.init({
        server: {
            baseDir: filePath.baseDir
        }
    });
    gulp.watch(filePath.scss, css);
    gulp.watch(filePath.js, js).on("change", browserSync.reload);
    gulp.watch(filePath.html, nunjucks).on("change", browserSync.reload);
}

// Default 'gulp' command with start local server and watch files for changes.
exports.default = series(nunjucks, css, js, imageMin, watch_files);

// 'gulp build' will build all assets but not run on a local server.
exports.build = parallel(nunjucksMinify, css, js, imageMin);