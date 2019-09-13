// Initialize modules
// Importing specific gulp API functions lets us write them below as series() instead of gulp.series()
const { src, dest, watch, series, task, parallel } = require('gulp');
// Importing all the Gulp-related packages we want to use
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const rename = require('gulp-rename');
const replace = require('gulp-replace');
const imagemin = require('gulp-imagemin');
const include = require('gulp-include');
const zip = require('gulp-zip');

// External Files
const config = {
    nodesDir: './node_modules' // Node Modules
}


// File paths
const files = { 
    scssPath: './sass/style.scss',
    jsPath: './node_modules/material-design-lite/material.js',
    imgPath: './images/**/*',
    mdlScss: './node_modules/material-design-lite/src'
}

// As with javascripts this task creates two files, the regular and
// the minified one. It automatically reloads browser as well.
var options = {};
options.sass = {
    errLogToConsole: true,
    sourceMap: 'sass',
    sourceComments: 'map',
    precision: 10,
    includePaths: [ files.mdlScss ]
    //imagePath: 'assets/img',
};
options.autoprefixer = {
    map: true
    //from: 'sass',
    //to: 'asrp.min.css'
};

// Sass task: compiles the style.scss file into style.css
function scssTask(){    
    return src(files.scssPath)
        .pipe(sourcemaps.init()) // initialize sourcemaps first
        .pipe(sass(options.sass)) // compile SCSS to CSS
        .pipe(
            postcss([
                autoprefixer(
                    'last 2 version',
                    'safari 5',
                    'ie 8',
                    'ie 9',
                    'opera 12.1',
                    'ios 6',
                    'android 4',
                    options.autoprefixer
                ),
                cssnano() ])
        ) // PostCSS plugins
        .pipe(dest('.'))
        .pipe(sourcemaps.write('.')) // write sourcemaps file in current directory
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('.')
    ); // put final CSS in dist folder
}

// JS task: concatenates and uglifies JS files to script.js
function jsTask(){
    return src(files.jsPath)
        .pipe(include())
        .pipe(rename({ basename: 'scripts' }))
        .pipe(dest( './js/dist' ) )
        // .pipe(concat('scripts.js'))
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(dest('./js/dist')
    );
}

// Optimize Images
function imgTask(){
    return src(files.imgPath)
        .pipe(imagemin({ progressive: true, svgoPlugins: [{removeViewBox: false}]}))
        .pipe(dest('./images')
    );
}

// Watch task: watch SCSS and JS files for changes
// If any change, run scss and js tasks simultaneously
function watchTask(){
    watch([files.scssPath, files.jsPath], 
        parallel(scssTask, jsTask));    
}

// Export the default Gulp task so it can be run
// Runs the scss and js tasks simultaneously
// then watch task
exports.default = series(
    parallel(scssTask, jsTask),
    watchTask
);