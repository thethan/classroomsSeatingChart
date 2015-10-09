var elixir = require('laravel-elixir');

var gulp = require('gulp');
var rename = require('gulp-rename');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


gulp.task("copyfiles", function () {
    gulp.src("bower_components/jquery/dist/jquery.js")
        .pipe(gulp.dest("public/assets/js/"));

    gulp.src("bower_components/bootstrap-sass/assets/javascripts/bootstrap.js")
        .pipe(gulp.dest("public/assets/js/"));

    gulp.src("bower_components/bootstrap-sass/assets/fonts/bootstrap/*")
        .pipe(gulp.dest("resources/assets/fonts/bootstrap"));

    gulp.src("bower_components/bootstrap-sass/assets/stylesheets/")
        .pipe(gulp.dest("resources/assets/sass/bootstrap/"));

    gulp.src("bower_components/bootstrap-sass/assets/stylesheets/bootstrap")
        .pipe(gulp.dest("resources/assets/sass/bootstrap/"));

    // Copy datatables
    var dtDir = "bower_components/datatables-plugins/integration/";
    gulp.src("bower_components/datatables/media/js/jquery.dataTables.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src(dtDir + "/bootstrap/3/dataTables.bootstrap.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src(dtDir + "bootstrap/3/dataTables.bootstrap.css")
        .pipe(rename("__dataTables.bootstrap.scss"))
        .pipe(gulp.dest("resources/assets/sass/"));


});

elixir(function (mix) {
    mix.sass('app.scss')
        .scripts(
        ['jquery.js',
            'bootstrap.js',
            'jquery.datatables.js',
            'dataTables.bootstrap.js'],
            'public/js/app.js')
        .version(['css/app.css']);
});
