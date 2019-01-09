
/**************** gulpfile.js configuration ****************/

'use strict';

const

  // development or production
  devBuild  = ((process.env.NODE_ENV || 'development').trim().toLowerCase() === 'development'),

  // directory locations
  dir = {
    src         : 'src/',
    build       : 'build/',
    img         : '../../uploads/**/*'
  },

  // modules
  gulp          = require('gulp'),
  gutil         = require('gulp-util'),
  noop          = require('gulp-noop'),
  deporder      = require('gulp-deporder'),
  newer         = require('gulp-newer'),
  size          = require('gulp-size'),
  imagemin      = require('gulp-imagemin'),
  sass          = require('gulp-sass'),
  postcss       = require('gulp-postcss'),
  uglify 	      = require('gulp-uglify'),
  concat 	      = require('gulp-concat'),
  rename 	      = require('gulp-rename'),
  stripdebug    = require('gulp-strip-debug'),
  sourcemaps    = devBuild ? require('gulp-sourcemaps') : null;
  // browsersync   = devBuild ? require('browser-sync').create() : null;

console.log('Gulp', devBuild ? 'development' : 'production', 'build');

// Browser-sync
var browsersync = false;


// PHP settings
const php = {
  src           : './*.php',
  build         : dir.build
};

// copy PHP files
gulp.task('php', () => {
  return gulp.src(php.src)
    .pipe(newer(php.build))
    .pipe(gulp.dest(php.build));
});

// image settings
const images = {
  src         : dir.img,
  build       : dir.build + 'images/'
};

// image processing
gulp.task('images', () => {
  return gulp.src(images.src)
    .pipe(newer(images.build))
    .pipe(imagemin())
    .pipe(gulp.dest(images.build));
});

// CSS settings
const css = {
  src         : dir.src + 'sass/style.scss',
  watch       : dir.src + 'sass/**/*',
  build       : './',
  sassOpts: {
    outputStyle     : 'nested',
    imagePath       : images.build,
    precision       : 3,
    errLogToConsole : true
  },
  processors: [
    require('postcss-assets')({
      loadPaths: ['images/'],
      basePath: dir.build,
      baseUrl: '/wp-content/themes/paul-phua/'
    }),
    require('autoprefixer')({
      browsers: ['last 2 versions', '> 2%']
    }),
    require('css-mqpacker'),
    require('cssnano')
  ]
};

// CSS processing
gulp.task('css', () => {
  return gulp.src(css.src)
    .pipe(sass(css.sassOpts))
    .pipe(postcss(css.processors))
    .pipe(gulp.dest(css.build))
    .pipe(browsersync ? browsersync.reload({ stream: true }) : gutil.noop());
});


// JavaScript settings
const js = {
  src         : './js/*',
  build       : dir.build + 'js/',
  filename    : 'scripts.js'
};

// JavaScript processing
gulp.task('js', () => {

  return gulp.src(js.src)
    .pipe(deporder())
    .pipe(concat(js.filename))
    .pipe(stripdebug())
    .pipe(uglify())
    .pipe(gulp.dest(js.build))
    .pipe(browsersync ? browsersync.reload({ stream: true }) : gutil.noop());

});

// Gulp watch syntax
gulp.task('watch', function(){
  gulp.watch(dir.src + 'sass/**/*', gulp.series('css'));
})


// run all tasks
gulp.task('build', gulp.parallel('php', 'css', 'js'));

// default task
gulp.task('default', gulp.series('build'));



