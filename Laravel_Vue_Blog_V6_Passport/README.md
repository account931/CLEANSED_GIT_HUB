## This project is so much like {CLEANSED_GIT_HUB/Laravel_Vue_Blog}, but the main differences:
- <p> This project uses Laravel version 6, while {CLEANSED_GIT_HUB/Laravel_Vue_Blog} uses version 5.4. </p>
- <p> This project uses api auth via Passport, while {CLEANSED_GIT_HUB/Laravel_Vue_Blog} uses api auth via token sent in headers in ajax (in vue). Token is a column {api_token} in DB {Users}  </p>
- <p> As long as this project is on Laravel version 6, it can not use Entrust Rbac like {CLEANSED_GIT_HUB/Laravel_Vue_Blog} do, so it uses Spatie Laravel permission RBAC </p>
- <p> This project uses in {/config/auth.php}  'guards' => [ 'api' => [ 'driver'   => 'passport' ] ], while {CLEANSED_GIT_HUB/Laravel_Vue_Blog} uses 'guards' => [ 'api' => [ 'driver'   => 'token' ] ] </p>
- <p>This project uses auth soleley on token(including login/register), while {CLEANSED_GIT_HUB/Laravel_Vue_Blog} uses login/register via regular http sessions, and only while requesting REST API resources uses token,
     So, this project for Login uses \App\Http\Controllers\Auth_API\UserAuthController and in Login form (/views/auth/login.blade.php) uses api route action="{{ route('passport_login') }}, {CLEANSED_GIT_HUB/Laravel_Vue_Blog} uses route action="{{ route('login') }}
  </p>
  - <p>Additionally, we disabled middleware('auth') {Route::get()->middleware('auth')} in routes/web.ph, and disabled checking in Ctrl { if(auth()->user()->api_token == null) }</p>
  
- <p> History of this project: firstly it was developed within {Laravel+Yii2_comment_widget}, then was carved as separated {CLEANSED_GIT_HUB/Laravel_Vue_Blog} and finally carved to account931 for Passport and Spatie testing. </p>

## Main features  (same for both projects):
- <p> Api routes use 'middleware' => ['auth:api', 'myJsonForce'] </p>
- <p> Users can view posts and load new, Admin can view, edit and delete </p>
- <p> Users's ability to view posts is implemented in JS in              => /resources/assets/js/WpBlog_Vue/components/pages/blog_2021.vue   </p>
- <p> Users's ability to load new posts is implemented in JS in          => /resources/assets/js/WpBlog_Vue/components/pages/loadnew.vue     </p>
- <p> Admin's ability to view posts with Edit/Delete option is implemented in JS in   =>  /resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue</p>
- <p> Admin's ability to edit posts is implemented in JS in                           => /resources/assets/js/WpBlog_Admin_Part/components/pages/editItem.vue</p>
- <p> Admin's ability to delete posts is implemented in JS in                         =>  /resources/assets/js/WpBlog_Admin_Part/components/pages/list_all.vue</p>
- <p> Back-end is implemented in  =>  /Controllers/WpBlog_Rest_API_Contoller.php and  /Controllers/WpBlog_Admin_Part/WpBlog_Admin_Rest_API_Contoller.php</p>


## Below is copy from {CLEANSED_GIT_HUB/Laravel_Vue_Blog} =>

## Laravel Rest Api Blog on Vue + Vuex Store + Vue Router + Bearer token Header Authentication (middleware 'auth:api'). Token is User's table 'api_token' field. Uses UI Toolkit Element-UI, Vue 2.0 based component library
- <p>To run the application on <b>http://localhost</b>, copy the repository code and run <b>composer install</b> to load all dependencies. </p>
- <p>Create root file <b>.env</b> with your DB seetings based on  <b>.env.example</b>.</p>
- <p>Run <b> php artisan key:generate </b> </p>
- <p>Use <b> php artisan migrate </b> to migrate databases</p>
- <p>If Entrust migration did not run automatically, run additional command  <b> php artisan entrust:migration </b> to generate the Entrust migration</p>
- <p>When the migration is completed, run the seeding command <b> php artisan db:seed </b> to seed the dummy data, after you may login using login: <b>test@gmail.com</b>, password: <b>testtest</b>. </p>
- <p>Js assets are minified and concatenated with Laravel Mix, source code is in <b>/resources/assets</b>, 
    to manage JS dependencies run <b>npm install</b>, 
    to minify js files run <b>npm run production</b>, to automate your build when there is any change use <b>npm run watch </b></p>
- <p>If encounter error <b> cross-env not found </b> , firstly run command <b>npm i cross-env --save</b> </p>

## Brief overview of the application

## Blog front page

![Screenshot](public/images/Screenshots/9.png)

![Screenshot](public/images/Screenshots/6.png)

![Screenshot](public/images/Screenshots/1.png)

## View in modal

![Screenshot](public/images/Screenshots/2.png)

## View in router

![Screenshot](public/images/Screenshots/3.png)

## Create new article

![Screenshot](public/images/Screenshots/4.png)

## Unauthenticated request. Bearer token is missing/incorrect

![Screenshot](public/images/Screenshots/5.png)

![Screenshot](public/images/Screenshots/5.1.png)


## Token section

![Screenshot](public/images/Screenshots/7.png)

## Token section

![Screenshot](public/images/Screenshots/8.png)

## Admin Part with option to Edit/Delete

![Screenshot](public/images/Screenshots/10.png)

## Admin Part -> Edit a Post

![Screenshot](public/images/Screenshots/10.1.png)

![Screenshot](public/images/Screenshots/11.png)

## Client-side validation

![Screenshot](public/images/Screenshots/11.1.png)

## Server-side validation

![Screenshot](public/images/Screenshots/12.png)

![Screenshot](public/images/Screenshots/13.png)

## Admin Part -> Validation OK

![Screenshot](public/images/Screenshots/14.png)

## Admin Part ->  Delete a Post

![Screenshot](public/images/Screenshots/15.png)

![Screenshot](public/images/Screenshots/16.png)

[Watch video presentation on Youtube](  )
 
## Admin Part is protected with Zizaco/Entrust JSON middleware and available for users with Admin rights only


![Screenshot](public/images/Screenshots/16.png)


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
