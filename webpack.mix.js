let mix = require('laravel-mix');

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

var paths = {
    'bootstrap': './node_modules/bootstrap-sass/assets/'
}

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css', {
        includePaths: [
            paths.bootstrap + 'stylesheets/'
        ]
    }).options({
        processCssUrls: false
    }).copyDirectory( paths.bootstrap + 'fonts/bootstrap/', 'public/fonts/bootstrap' );
