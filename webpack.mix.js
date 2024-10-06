<<<<<<< HEAD
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

 mix.js('resources/js/app.js', 'public/js')
 .vue()
 .styles([
     'node_modules/@fortawesome/fontawesome-free/css/all.css'
 ], 'public/css/fontawesome.css'); // Correct way to bundle Font Awesome CSS



=======
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

 mix.js('resources/js/app.js', 'public/js')
 .vue()
 .styles([
     'node_modules/@fortawesome/fontawesome-free/css/all.css'
 ], 'public/css/fontawesome.css'); // Correct way to bundle Font Awesome CSS



>>>>>>> c3136925c866957ba2da82a96feeb9370711e9fe
