var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss');


    mix.copy('resources/assets/vendor/jquery/dist/jquery.min.js', 'public/js/jquery.min.js');
    mix.copy('resources/assets/vendor/angular/', 'public/js/angular/');
    mix.copy('resources/assets/vendor/webfontkit/', 'public/webfontkit');
    mix.copy('resources/assets/vendor/img/', 'public/img');
    mix.copy('resources/assets/vendor/angular-i18n/', 'public/js/angular-i18n/');
    mix.copy('resources/assets/vendor/angular-dropzone/lib/angular-dropzone.js', 'public/js/angular/angular-dropzone.js');
    
    mix.copy('resources/assets/vendor/angular-bootstrap/ui-bootstrap-tpls.js', 'public/js/angular/ui-bootstrap-tpls.js');
    mix.copy('resources/assets/vendor/fullcalendar/dist', 'public/js/calendar/');
    mix.copy('resources/assets/vendor/moment/src/moment.js', 'public/js/');
    mix.copy('resources/assets/vendor/moment/', 'public/js/moment');

	mix.copy('resources/assets/vendor/app/', 'public/js/');

    mix.copy('resources/assets/vendor/bootstrap/', 'public/css/bootstrap/');
	

    mix.copy('resources/assets/vendor/css/', 'public/css/');
});
