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

Route::get('/', function () {
    return view('welcome');
});
// Jacob's admin route
Route::get('/admin', function() {
  return view('admin');
});

Auth::routes();

// Redirects user to the after log in page...
Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@shopping_list');//




// Checks if I'm connected into the direct aisle db.
// DB::Connection
Route::get('/testDB', function(){

	$name = DB::Connection()->getDatabaseName();

	return $name;

});
