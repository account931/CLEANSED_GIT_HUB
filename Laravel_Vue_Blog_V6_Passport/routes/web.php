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

Route::get('/',     'HomeController@index');
Route::get('/home', 'HomeController@index');
Auth::routes();

//Wpress Blog on Vue Framework
Route::get('/wpBlogVueFrameWork',   'WpBlog_VueContoller@index')  ->name('wpBlogVueFrameWork');  //WpPress on Vue Framework Blog index route

//Admin Part
Route::get('/adminStart',     'WpBlog_Admin_Part\WpBlog_AdminContoller@index')->name('adminStart'); ; // Controller is in Subfolder "/WpBlog_Admin_Part"

Route::get('/404', function () {
    return abort(404);
});


