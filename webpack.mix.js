const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/sass/layout.scss', 'public/assets/compiled').options({
    // processCssUrls: false,
});

mix.js('resources/js/app.js', 'public/assets/compiled');
mix.js('resources/js/app.readings.js', 'public/assets/compiled');
mix.js('resources/js/app.symptoms-start.js', 'public/assets/compiled');
