const gulp = require('gulp');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const cleanCSS = require('gulp-clean-css');
const uglify = require('gulp-uglify');

const paths = {
  styles: {
    src: './resources/sass/*.scss',
    dest: './public/css',
  },
  scripts: {
    src: './resources/js/*.js',
    dest: './public/js',
  },
};

function styles() {
  return gulp.src(paths.styles.src, {
    sourcemaps: true,
  })
    .pipe(sass())
    .pipe(cleanCSS({ debug: true }))
    .pipe(concat('app.min.css'))
    .pipe(gulp.dest(paths.styles.dest));
}

function scripts() {
  return gulp.src([`${paths.scripts.src}/jquery.js`, `${paths.scripts.src}/bootstrap.js`, `${paths.scripts.src}/app.js`], {
    sourcemaps: true,
  })
    .pipe(uglify())
    .pipe(concat('app.min.js'))
    .pipe(gulp.dest(paths.scripts.dest));
}

function watch() {
  gulp.watch(paths.styles.src, styles);
  gulp.watch(paths.scripts.src, scripts);
}

const build = gulp.parallel(styles, scripts, watch);

gulp.task(build);
gulp.task('default', build);
