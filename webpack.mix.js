const mix = require('laravel-mix');

// JavaScriptのコンパイル
mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/chat.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

