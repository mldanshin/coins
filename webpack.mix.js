const mix = require("laravel-mix");
const fs = require("fs");

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

mix.sass("resources/sass/front.scss", "public/style/front.css")
    .options({ processCssUrls: false })
    .version();
mix.sass("resources/sass/admin.scss", "public/style/admin.css")
    .options({ processCssUrls: false })
    .version();

mix.js('resources/js/app.js', 'public/js')
    .version();
