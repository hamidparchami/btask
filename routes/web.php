<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

if (!App::environment('local')) {
    URL::forceSchema('https');
}

Route::get('/', 'SiteController@index');

Auth::routes();

//Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'user.role', 'user.account_status']], function () {
    Route::get('/', function (){
        return redirect('/admin/home');
    });

    Route::get('/home', 'HomeController@index');
    //Category
    Route::get('/category/manage/{parent_id?}', 'Admin\CategoryController@index');
    Route::get('/category/create/{parent_id?}', 'Admin\CategoryController@getCreate');
    Route::post('/category/create/{parent_id?}', 'Admin\CategoryController@postCreate');
    Route::get('/category/edit/id/{id}/{parent_id?}', 'Admin\CategoryController@getEdit');
    Route::post('/category/edit/id/{id}/{parent_id?}', 'Admin\CategoryController@postEdit');
    Route::get('/category/delete/id/{id}/{parent_id?}', 'Admin\CategoryController@getDelete');
    //Attribute
    Route::get('/attribute/manage/{category_id}', 'Admin\AttributeController@index');
    Route::get('/attribute/create/{category_id}', 'Admin\AttributeController@getCreate');
    Route::post('/attribute/create/{category_id}', 'Admin\AttributeController@postCreate');
    Route::get('/attribute/edit/id/{id}/{category_id}', 'Admin\AttributeController@getEdit');
    Route::post('/attribute/edit/id/{id}/{category_id}', 'Admin\AttributeController@postEdit');
    Route::get('/attribute/delete/id/{id}/{category_id}', 'Admin\AttributeController@getDelete');
    //Product
    Route::get('/product/manage', 'Admin\ProductController@index');
    Route::get('/product/create', 'Admin\ProductController@getCreate');
    Route::post('/product/create', 'Admin\ProductController@postCreate');
    Route::get('/product/edit/id/{id}', 'Admin\ProductController@getEdit');
    Route::post('/product/edit/id/{id}', 'Admin\ProductController@postEdit');
    Route::get('/product/delete/id/{id}', 'Admin\ProductController@getDelete');
    //User
    Route::get('/user/manage', 'Admin\UserController@index');
    Route::get('/user/edit/id/{id}', 'Admin\UserController@getEdit');
    Route::post('/user/edit/id/{id}', 'Admin\UserController@postEdit');

});

//Background processes
Route::group(['prefix' => 'background'], function () {
    Route::get('/service/sync', 'BackgroundController@sync');
});

//Frontend Routes
//Catalog
Route::get('product/list', 'ProductController@getProductsList');
Route::get('product/filtered', 'ProductController@getFilteredProducts');