const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
require('laravel-mix-purgecss');


mix.js('resources/js/app.js', 'public/js');

mix.sass('resources/sass/tado.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [tailwindcss('./tailwind.config.js')],
    }).purgeCss();

mix.copyDirectory('node_modules/@fortawesome/fontawesome-pro/webfonts', 'public/webfonts');


mix.version();
//
// if (mix.inProduction()) {
//     mix.version();
// }

return;
