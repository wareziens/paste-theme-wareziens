var gulp = require('gulp')
  , concat = require('gulp-concat')
  , uglify = require('gulp-uglify')
  , rename = require('gulp-rename')
  , minifyCSS = require('gulp-minify-css')
  , ngAnnotate = require('gulp-ng-annotate')
  , bower = require('gulp-bower-files')
  , filter = require('gulp-filter')
  , sass = require('gulp-sass')
  , debug = require('gulp-debug')
  , add = require('gulp-add-src')

var paths = {
	scripts: ['./src/js/**/*.js', './src/js/*.js'],
	styles: ['./src/scss/*.scss', './src/scss/**/*.scss']
}

gulp.task('bower', function() {
  bower()

		// .pipe(debug({verbose: true}))
		.pipe(filter(function (file) {
			return require('path').extname(file.path) === '.js'
		}))
		// .pipe(add('bower_components/modernizr/modernizr.js'))
		.pipe(concat('vendor.js'))
		// .pipe(uglify())
    .pipe(gulp.dest('./dist/js'))
})

gulp.task('bootstrap', function() {
	gulp.src('bower_components/bootstrap-sass/lib/*')
	.pipe(gulp.dest('./src/scss/bootstrap'))
	gulp.src('bower_components/bootstrap-sass/dist/fonts/*')
	.pipe(gulp.dest('./dist/fonts'))
	gulp.src('bower_components/ng-table/ng-table.css')
	.pipe(rename('_ng-table.scss'))
	.pipe(gulp.dest('./src/scss'))
})

gulp.task('scripts', function() {
	gulp.src(paths.scripts)
		.pipe(concat('main.js'))
		.pipe(ngAnnotate())
		.pipe(gulp.dest('./dist/js'))
		.pipe(uglify({mangle: false}))
		.pipe(rename('main.min.js'))
		.pipe(gulp.dest('./dist/js'))	
})

gulp.task('styles', function() {
  gulp.src('./src/scss/app.scss')
  .pipe(sass())
  .pipe(concat('main.css'))
  .pipe(gulp.dest('./dist/css'))
  .pipe(minifyCSS())
  .pipe(rename('main.min.css'))
  .pipe(gulp.dest('./dist/css'));

})

gulp.task('highlight', function() {
	gulp.src('./bower_components/highlight.js/src/styles/*.css')
		.pipe(minifyCSS())
		.pipe(gulp.dest('./dist/css/highlight'))
})

gulp.task('default', ['bootstrap', 'bower', 'highlight', 'scripts', 'styles'])
gulp.task('watch', function() { 
	gulp.watch(paths.scripts, ['scripts']) 
	gulp.watch(paths.styles, [ 'styles']) 
})
