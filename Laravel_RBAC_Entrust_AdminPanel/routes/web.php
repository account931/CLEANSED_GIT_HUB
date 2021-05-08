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
Route::get('/home', 'RbacController@index')->name('rbac');

Auth::routes();

//multilanguage
Route::get('/multilanguage', 'MultiLanguage@index')->name('multilanguage'); 


//RBAC
Route::get('/rbac',           'RbacController@index')->name('rbac'); //display RBAC table Control Panel
Route::get('/createtwoRoles', 'RbacController@createRoles')->name('createtwoRoles');  //route to method to create 2 roles
Route::post('/assignRole',    'RbacController@assignRole')->name('/assignRole');  //route to method to assignRole from RBAC Table Control Panel, send via POST form
Route::post('/detachRole',    'RbacController@detachRole')->name('/detachRole');  //route to method to detach a certain role from certain user from RBAC Table Control Panel, send via POST form
Route::post('/addNewRole',    'RbacController@storeNewRole')->name('/addNewRole');  //route to method to add a new role to Db table Role, send via POST form

Route::get('/404', function () {
    return abort(404);
});


