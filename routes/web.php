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

Route::get('/', 'PublicController@index');
Route::get('/search', 'PublicController@searchposts');
Route::get('/posts/{slug}', 'PublicController@viewpost');
Route::get('/categories', 'PublicController@viewcategories');
Route::get('/categories/{title}', 'PublicController@viewcategory');

// Route::get('/', function () {
//     return view('index', ['title' => "Title"]);
// });

Auth::routes();

Route::get('/home/{orderby?}', 'HomeController@index')->name('home');

Route::get('/newpost', 'HomeController@newpost');

Route::post('/newpost', 'HomeController@storepost');

Route::get('/editpost/{post}', 'HomeController@editpost');

Route::get('/editpost/{post}/edit/{action}', 'HomeController@publishpost');

Route::post('/updatepost', "HomeController@updatepost");

Route::post('/publishcomment', 'HomeController@publishcomment');

Route::get('/backend/category', 'HomeController@viewcategory');

Route::post('/backend/addcategory', 'HomeController@addcategory');