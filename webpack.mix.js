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

mix.js('resources/assets/js/app.js', 'public/js').sourceMaps()
   .sass('resources/assets/sass/app.scss', 'public/css')
   .styles([
      'resources/assets/css/light-bootstrap-dashboard.css'
   ], 'public/css/light-bootstrap-dashboard.css')
   .js('resources/assets/js/light-bootstrap-dashboard.js', 'public/js')
   .js('resources/assets/js/plugins/bootstrap-switch.js', 'public/js/plugins')
   .js('resources/assets/js/plugins/chartist.min.js', 'public/js/plugins')
   .js('resources/assets/js/plugins/bootstrap-notify.js', 'public/js/plugins');
