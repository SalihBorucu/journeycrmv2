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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version()
    .scripts(
        [
            'resources/js/vendor/jquery.min.js',
            'resources/js/vendor/bootstrap.bundle.min.js',
            'resources/js/vendor/modernizr.min.js',
            // "resources/js/vendor/detect.js",
            // "resources/js/vendor/fastclick.js",
            'resources/js/vendor/jquery.slimscroll.js',
            // "resources/js/vendor/jquery.blockUI.js",
            // "resources/js/vendor/waves.js",
            'resources/js/vendor/jquery.nicescroll.js',
            'resources/js/vendor/jquery.scrollTo.min.js',
            'resources/js/vendor/alertify.js',
            'resources/js/vendor/app.js',
        ],
        'public/js/plugins.js'
    );