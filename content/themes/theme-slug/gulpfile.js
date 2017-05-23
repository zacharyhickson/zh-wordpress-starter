var gulp      = require( 'gulp' ),
    autoprefixer = require ( 'gulp-autoprefixer' ),
    minifycss   = require( 'gulp-clean-css' ),
    watch       = require( 'gulp-watch' ),
    uglify      = require( 'gulp-uglify' ),
    bower       = require( 'gulp-bower' ),
    sass        = require( 'gulp-sass' ),
    plumber     = require( 'gulp-plumber' ),
    browserSync = require( 'browser-sync' ),
    jshint      = require( 'gulp-jshint' ),
    stylish     = require( 'jshint-stylish' ),
    reload      = browserSync.reload;


// We need to set up an error handler (which gulp-plumber calls).
// Otherwise, Gulp will exit if an error occurs, which is what we don't want.
var onError = function( err ) {
  console.log( 'An error occured:', err );
  this.emit( 'end' );
}

// Config Paths
var config = {
     sassPath: './sass',
     nodeDir: './node_modules' 
}


// Our development server that serves all the assets and reloads the browser
// when any of them change (hence the watch calls in it)
gulp.task( 'server', function() {
  browserSync.init({
    // change 'playground' to whatever your local Nginx/Apache vhost is set
    // most commonly 'http://localhost/' or 'http://127.0.0.1/'
    // See http://www.browsersync.io/docs/options/ for more information
    proxy: 'http://wordpress.dev/'
  });

  // Reload the browser if any .php file changes within this directory
  watch( './**/*.php', reload);

  // Recompile sass into CSS whenever we update any of the source files
  watch( './sass/**/*.scss', function() {
    gulp.start( 'scss' );
  });
});


// Processes SASS and reloads browser.
gulp.task( 'scss', function() {
  return gulp.src( './sass/style.scss' )
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe(sass({
        outputStyle: 'compressed',
        includePaths: [
            './sass',
            config.nodeDir + '/bootstrap/scss']
        }))
    .pipe( autoprefixer( {
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe( gulp.dest( '.' ) )
    .pipe( reload( { stream: true } ) );
} );


// Jshint outputs any kind of javascript problems you might have
// Only checks javascript files inside /js directory
gulp.task( 'jshint', function() {
  return gulp.src( './js/**/*.js' )
    .pipe( jshint( '.jshintrc' ) )
    .pipe( jshint.reporter( stylish ) )
    .pipe( jshint.reporter( 'fail' ) );
});

// The default task. When developing just run 'gulp' and this is what will be ran.
// Note the second parameter, those are dependency tasks which need to be done
// before the main function (third parameter) is called.
gulp.task( 'default', [ 'scss', 'server' ], function() {
  console.log('done');
} );
