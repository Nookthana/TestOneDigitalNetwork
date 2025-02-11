const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css')
   .styles('resources/css/nav.css', 'public/css/nav.css') 
   .styles('resources/css/card.css', 'public/css/card.css') 
   .styles('resources/css/footer.css', 'public/css/footer.css') 
   .version(); 

mix.js('resources/js/pages/homepage/index.js', 'public/js/pages/homepage');
mix.js('resources/js/pages/product/index.js', 'public/js/pages/product');
