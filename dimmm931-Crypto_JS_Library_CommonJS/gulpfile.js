var gulp = require('gulp');
var browserSync = require('browser-sync'); // Browser Sync
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var uglify = require('gulp-uglifyjs'); // gulp-uglifyjs (JS concat)
//var watch = require('gulp-watch');


gulp.task('mytask', function() {
    console.log('Hello, I am task one!');
});



//The only working Gulp task, it packs all modules in one & uglify it.
gulp.task('browserifyX', function() {
  return browserify('./js/my_crypto_main_js_file.js')
    .bundle()
    .pipe(source('bundle_js.js')) // gives streaming vinyl file object
    .pipe(buffer()) // <----- convert from streaming to buffered vinyl file object
    .pipe(uglify()) // now gulp-uglify works 
    .pipe(gulp.dest('./dist/js/'));
});






//won't work
gulp.task("watch", function() {
    //watch({glob: "js/**/*.js"}, function() {
   return watch('js/**/*.js', { ignoreInitial: false })
        //.pipe(gulp.dest('build'));
		gulp.run(['mytask', 'browserify']);
});

 


gulp.task('scripts', function() {
    return gulp.src([ // gets libs
        'app/js/jquery/dist/jquery.min.js', // Берем jQuery
        //'app/libs/magnific-popup/dist/jquery.magnific-popup.min.js' // Берем Magnific Popup
        ])
        .pipe(concat('libs.min.js')) // Собираем их в кучу в новом файле libs.min.js
        .pipe(uglify()) // Сжимаем JS файл
        .pipe(gulp.dest('dist/js')); // Выгружаем в папку app/js
});


