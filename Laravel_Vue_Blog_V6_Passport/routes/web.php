<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//default page
/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/',     'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

//Wpress Blog on Vue Framework
Route::get('/wpBlogVueFrameWork',   'WpBlog_VueContoller@index')  ->name('wpBlogVueFrameWork');//->middleware('auth');  //WpPress on Vue Framework Blog index route

//Get Token Section
Route::get('/getToken',       'GetTokenContoller@index')   ->name('getToken')     ->middleware('auth');  //Displays current token or button to generate
Route::get('/generateToken',  'GetTokenContoller@generate')->name('generateToken')->middleware('auth');  //Generates token

//Admin Part
Route::get('/adminStart',     'WpBlog_Admin_Part\WpBlog_AdminContoller@index')->name('adminStart')   ->middleware('auth');  // Controller is in Subfolder "/WpBlog_Admin_Part"



/*
Route::group(['middleware' => 'auth', 'prefix' => 'post'], function () { //url must contain /post/, i.e /post/get_all
    Route::get ('get_all',         'WpBlog_Rest_API_Contoller@getAllPosts')->name('fetch_all');       //REST API endpoint to /GET all posts
    Route::post('create_post_vue', 'WpBlog_Rest_API_Contoller@createPost') ->name('create_post_vue'); //REST API endpoint to /POST (create) a new blog
});
*/

Route::get('/404', function () {
    return abort(404);
});


