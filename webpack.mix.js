const mix = require('laravel-mix');
require('laravel-vue-lang/mix');
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

mix.js('vue/seller/app.js', 'public/js/seller')
   .js('vue/accountant/app.js', 'public/js/accountant')
   .js('vue/operation/app.js', 'public/js/operation')
   .js('vue/admin/app.js', 'public/js/admin')
   .js('vue/customer-service/app.js', 'public/js/customer-service')
   .js('vue/auth/register.js', 'public/js/auth')
   .js('vue/auth/login.js', 'public/js/auth')
   .js('vue/auth/notice.js', 'public/js/auth')
   .js('vue/auth/password/password-reset.js', 'public/js/auth/password')
   .sass('resources/sass/reset.scss', 'public/css')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/cuts.scss', 'public/css')
   .vue()
   .lang();
