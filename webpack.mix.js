const mix = require('laravel-mix');

// Cambiar la configuración para usar solo Sass y Bootstrap
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
