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

mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/foundation-sites/dist/js/foundation.js'
], 'public/js/vendor.js').js('resources/js/app.js', 'public/js/app.js').js('resources/js/graph.js', 'public/js/graph.js')
    .styles(['resources/css/foundation.min.css'],'public/css/foundation.min.css').copy('resources/images','public/images').sass('resources/scss/style.scss', 'public/css');
