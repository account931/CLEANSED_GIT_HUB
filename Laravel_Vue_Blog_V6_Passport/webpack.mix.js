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

mix.js('resources/assets/js/app.js',                           'public/js')  //Vue.js; Source-> Destination
 //.js('resources/assets/js/login/login.js',                   'public/js/login')  //used for password eye toggle, reassigned to /subcomponents/logged.vue
   .js('resources/assets/js/WpBlog_Vue/wpblog-vue-start.js',   'public/js/Wpress_Vue_JS')  //Vue.js; Source-> Destination
   
   //Admin Part
   .js('resources/assets/js/WpBlog_Admin_Part/wpblog-admin-part-start.js',   'public/js/WpBlog_Admin_Part')
   
   //Vue Auth Part (login/register)
   .js('resources/assets/js/Wp_Login_Register_Rest/auth-start.js',   'public/js/Wp_Login_Register_Rest')
   
    //Vue Menu for One Item (login/logged)(component used in Menu in /views/layouts/app.php)
   .js('resources/assets/js/Menu_One_Item/one_menu_item_login_logged_start.js',   'public/js/Menu_One_Item')
   
   //.sass('resources/assets/sass/app.scss', 'public/css') //SAAS
   .styles([                                      //for pure CSS
        'resources/assets/css/my_css.css',
        //'public/css/vendor/videojs.css'
    ], 'public/css/my_css.css') ;   //final output to folder 
