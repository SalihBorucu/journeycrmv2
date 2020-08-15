const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/activity-app.js', 'public/js')
    .js('resources/js/reporting-app.js', 'public/js')
    .js('resources/js/create-lead-app.js', 'public/js')
    .js('resources/js/settings-app.js', 'public/js')
    .js('resources/js/admin-app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    .scripts(
        [
            'resources/js/vendor/jquery.min.js',
            'resources/js/vendor/sweetalert.js',
            'resources/js/vendor/bootstrap.bundle.min.js',
            'resources/js/vendor/modernizr.min.js',
            'resources/js/vendor/jquery.slimscroll.js',
            'resources/js/vendor/jquery.nicescroll.js',
            'resources/js/vendor/jquery.scrollTo.min.js',
            'resources/js/vendor/alertify.js',
            'resources/js/vendor/app.js',
            'resources/js/vendor/summernote-bs4.min.js',
        ],
        'public/js/plugins.js'
    );
