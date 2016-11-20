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

/*
Route::get('/', function () {
    return view('welcome');
});
*/



/*Route::group(['prefix' => 'categories'], function ($router) {
    $router->get('/', ['as' => 'categories.index', 'uses' => 'CategoriesController@index']);
    $router->get('/create', ['as' => 'categories.create', 'uses' => 'CategoriesController@create']);
    $router->post('/', ['as' => 'categories.store', 'uses' => 'CategoriesController@store']);
    $router->get('/{id}/edit', ['as' => 'categories.edit', 'uses' => 'CategoriesController@edit']);
    $router->put('/{id}', ['as' => 'categories.update', 'uses' => 'CategoriesController@update']);
    $router->delete('/{id}', ['as' => 'categories.destroy', 'uses' => 'CategoriesController@destroy']);
});*/
//Route::resource('books', 'BooksController', ['except' => ['show']]);

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware'=>'auth.role'], function(){
    Route::resource('categories', 'CategoriesController', ['except' => ['show']]);
    Route::resource('books', 'BooksController');
});


Route::group(['prefix' => '/'], function ($router){
    $router->get('/', ['as' => 'home', 'uses' => 'BooksController@home']);
    $router->get('addfavorite/{id}', ['as' => 'addfavorite', 'uses' => 'BooksController@addToFavorite']);
    $router->get('myfavorite', ['as' => 'myfavorite', 'uses' => 'BooksController@myFavorite']);
    $router->get('removefavorite/{id}', ['as' => 'removefavorite', 'uses' => 'BooksController@removeFavorite']);

});




