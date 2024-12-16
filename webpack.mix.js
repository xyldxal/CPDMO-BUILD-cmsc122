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

//  mix.js('resources/js/app.js', 'public/js')
//  .postCss('resources/css/app.css', 'public/css', [
//      // Add Font Awesome CSS
//      require('@fortawesome/fontawesome-free/css/all.css')
//  ]);

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('autoprefixer'),
   ])
   .copy('node_modules/@fortawesome/fontawesome-free/css/all.css', 'public/css/fontawesome.css')
   .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');