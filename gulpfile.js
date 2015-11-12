var elixir = require('laravel-elixir');

var gulp = require('gulp');
var rename = require('gulp-rename');
var svgSprite = require('gulp-svg-sprite'),

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

    config                  = {
        shape               : {
            dimension       : {         // Set maximum dimensions
                maxWidth    : 32,
                maxHeight   : 32
            },
            spacing         : {         // Add padding
                padding     : 10
            },
            dest            : 'out/intermediate-svg'    // Keep the intermediate files
        },
        mode                : {
            view            : {         // Activate the «view» mode
                bust        : false,
                render      : {
                    scss    : true      // Activate Sass output (with default options)
                }
            },
            symbol          : true      // Activate the «symbol» mode
        }
    };




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

    gulp.src("bower_components/angular/angular.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("bower_components/angular-animate/angular-animate.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("bower_components/angular-aria/angular-aria.js")
        .pipe(gulp.dest("resources/assets/js/"));

    gulp.src("bower_components/angular-material/*")
        .pipe(gulp.dest("resources/assets/vendor/angular-material/"));

});


gulp.task("svgsprite", function () {
    console.log(config);
    gulp.src('material-design-icons/svg/production/**/*_48px.svg', {cwd: 'public/assets'})
        .pipe(svgSprite(config))
        .pipe(gulp.dest(''));

});




elixir(function (mix) {
    mix.sass(
        'app.scss')
        .scripts(
        ['jquery.js',
            'bootstrap.js',
            'jquery.datatables.js',
            'dataTables.bootstrap.js'],
            'public/js/app.js')
        .sass([
            'classroom.scss',
            '../vendor/angular-material/angular-material.layouts.css',
            '../vendor/angular-material/angular-material.css',
        ],
        'public/css/classroom.css')
        .scripts(
        [
            'jquery.js',
            'angular.js',
            'angular-animate.js',
            'angular-aria.js',
            '../vendor/angular-material/angular-material.js',

            'jquery.datatables.js',
            'dataTables.bootstrap.js'],
        'public/js/classroom.js')
        .version(['css/app.css','css/classroom.css']);
});
