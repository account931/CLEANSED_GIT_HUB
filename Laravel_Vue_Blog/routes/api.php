<?php

use Illuminate\Http\Request;
use Http\Controllers\WpBlog_Rest_API_Contoller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Following routes are protected ty Bearer token (to be sent in Headers)
//middleware' => ['sendTokenMy', 'checkX', 'auth:api'] // middleware' => 'auth', 'auth:api' //By default auth:api middleware requires each user to have a field in the database called api_token,
Route::group(['middleware' => ['auth:api'/*, 'sendTokenMyX'*/, 'myJsonForce'],  'prefix' => 'post'], function () { //url must contain /post/, i.e /post/get_all
    
    Route::get ('get_all',         'WpBlog_Rest_API_Contoller@getAllPosts')     ->name('fetch_all');       //REST API to /GET all posts
    Route::post('create_post_vue', 'WpBlog_Rest_API_Contoller@createPost')      ->name('create_post_vue'); //REST API to /POST (create) a new blog
    Route::get ('get_categories',  'WpBlog_Rest_API_Contoller@getAllCategories')->name('get_categories');  //REST API to /GET all DB table categories (to build <select> in loadnew.vue)

    
    
    //Admin Part routes
    Route::get ('admin_get_all_blog',      'WpBlog_Admin_Part\WpBlog_Admin_Rest_API_Contoller@getAllAdminPosts')->name('admin_get_all_blog');  //REST API to /GET all posts for Admin Part. Controller is in Subfolder "/WpBlog_Admin_Part"
    Route::get ('admin_get_one_blog/{id}', 'WpBlog_Admin_Part\WpBlog_Admin_Rest_API_Contoller@getAllAdminOneItem')->name('admin_get_one_blog');  //REST API to /GET One post/item (by ID) for Admin Part. Controller is in Subfolder "/WpBlog_Admin_Part"
    
    //CHANGE TO DELETE!!!!
    Route::post('admin_delete_item/{id}',  'WpBlog_Admin_Part\WpBlog_Admin_Rest_API_Contoller@deleteOneItem')     ->name('admin_delete_item');   //REST API to /POST Delete one item
    
    //ADD PUT
   
    
});  