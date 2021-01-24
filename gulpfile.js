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

// 
// TOP LEVEL FUNCTIONS
//     gulp.task = Define tasks
//     gulp.src = Point to files to use
//     gulp.dest = Points to the folder to output
//     gulp.watch = Watch files and folders for changes
//

// Optimise Images
function imageMin(cb) {
    gulp.src("src/assets/images/*")
        .pipe(imagemin())
        .pipe(gulp.dest("dist/images"));
    cb();
}

// Copy all HTML files to Dist
function copyHTML(cb) {
    gulp.src("src/*.html").pipe(gulp.dest("dist"));
    cb();
}

// Minify HTML
function minifyHTML(cb) {
    gulp.src("src/*.html")
        .pipe(gulp.dest("dist"))
        .pipe(
            htmlmin({
                collapseWhitespace: true
            })
        )
        .pipe(gulp.dest("dist"));
    cb();
}

// Scripts
function js(cb) {
    gulp.src("src/scripts/*js")
        .pipe(babel({
            presets: ['@babel/preset-env']
        }))
        .pipe(concat("index.js"))
        .pipe(uglify())
        .pipe(gulp.dest("dist/scripts"));
    cb();
}

// Compile Sass
function css(cb) {
    gulp.src("src/styles/*.scss")
        .pipe(sass({ outputStyle: "compressed" }).on("error", sass.logError))
        .pipe(autoprefixer({
            browserlist: ['last 2 versions'],
            cascade: false
        }))
        .pipe(gulp.dest("dist/styles"))
        // Stream changes to all browsers
        .pipe(browserSync.stream());
    cb();
}

// Process Nunjucks
function nunjucks(cb) {
    gulp.src("src/**/*.html")
        .pipe(gulp.dest("dist"));
    cb();
}

function nunjucksMinify(cb) {
    gulp.src("src/**/*.html")
        .pipe(
            htmlmin({
                collapseWhitespace: true
            })
        )
        .pipe(gulp.dest("dist"));
    cb();
}

// Watch Files
function watch_files() {
    browserSync.init({
        server: {
            baseDir: "dist/"
        }
    });
    gulp.watch("src/styles/**/*.scss", css);
    gulp.watch("src/scripts/*.js", js).on("change", browserSync.reload);
    gulp.watch("src/**/*.html", nunjucks).on("change", browserSync.reload);
}

// Default 'gulp' command with start local server and watch files for changes.
exports.default = series(nunjucks, css, js, imageMin, watch_files);

// 'gulp build' will build all assets but not run on a local server.
exports.build = parallel(nunjucksMinify, css, js, imageMin);