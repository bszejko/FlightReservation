const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.js('resources/js/app.js', 'public/build/js')
   .postCss('resources/css/app.css', 'public/build/css', [
       tailwindcss,
   ])
   .setPublicPath('public'); // Set public path to public for manifest.json

if (mix.inProduction()) {
    mix.version();
}
