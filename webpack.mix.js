const mix = require('laravel-mix');

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


// mix.autoload({
//     jquery: ['$', 'window.jQuery']
// });
mix.autoload({
    'jquery': ['jQuery', '$'],
})

mix.sass('resources/sass/login_style.scss','public/css/login_style/app.css')
.js('resources/js/login_script.js','public/js/login_script/app.js')
.js('resources/js/login_script/front.js','public/js/login_script/app.js');
mix.scripts(['node_modules/admin-lte/plugins/jquery/jquery.min.js','resources/js/login_script/custom.js'],'public/js/login_script/custom.js');


mix.js('resources/js/app.js', 'public/js/master/app.js')
.js('resources/js/general_script/custom.js','public/js/master/app.js')
.sass('resources/sass/app.scss', 'public/css/master');

mix.js('resources/js/datatable.js', 'public/js/master/datatable.js')
.js('resources/js/datatable_script/modules.js','public/js/master/datatable.js')
.sass('resources/sass/datatable.scss','public/css/master/datatable.css');


/*mix.scripts(['node_modules/admin-lte/plugins/jquery/jquery.min.js','resources/js/general_script/custom.js'],'public/js/master/custom.js');*/
mix.styles(['resources/sass/general_style/custom.css'],'public/css/master/custom.css');
