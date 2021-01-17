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

mix.js('resources/assets/js/app.js', 'public/js')
   .js('resources/assets/js/admin.js', 'public/js')
   .js('resources/assets/js/adminformation.js', 'public/js')
   .js('resources/assets/js/master.js', 'public/js')
   .js('resources/assets/js/news.js', 'public/js')
   .js('resources/assets/js/archivespaginate.js', 'public/js')
   .js('resources/assets/js/archivesleague.js', 'public/js')
   .js('resources/assets/js/archivestournament.js', 'public/js')
   .js('resources/assets/js/archivesranking.js', 'public/js')
   .sass('resources/assets/sass/admin.scss', 'public/css')
   .sass('resources/assets/sass/app.scss', 'public/css');

   //options({processCssUrls: false})

if (mix.inProduction()) {
   mix.version();
}
