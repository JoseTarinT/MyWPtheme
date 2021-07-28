/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your application. See https://github.com/JeffreyWay/laravel-mix.
 |
 */
 const mix = require('laravel-mix');

 /*
  |--------------------------------------------------------------------------
  | Configuration
  |--------------------------------------------------------------------------
  */
 mix
   .setPublicPath('theme')
   .disableNotifications()
   .webpackConfig({devtool: 'inline-source-map'})
   .options({
     processCssUrls: false
   });
 
 /*
  |--------------------------------------------------------------------------
  | SASS
  |--------------------------------------------------------------------------
  */
 mix
   .sass('theme/scss/style.scss', '');
 
 /*
  |--------------------------------------------------------------------------
  | JS
  |--------------------------------------------------------------------------
  */
 mix
   .ts('theme/ts/theme.ts', 'js')
   .sourceMaps();
 