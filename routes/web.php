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

// Group the route for lang middleware

Route::get('/', function () {
    return view('welcome');
});


// Events routes
Route::get('/explore', 'EventController@index')->name('explore');
Route::get('/event/{id}', 'EventController@show')->name('event');
Route::get('/create', 'EventController@create')->name('event.create');
Route::post('/create', 'EventController@store')->name('event.store');
// Search
Route::get('/search', 'EventController@search')->name('search');

// Comments
Route::post('/comment/create', 'CommentController@store')->name('comment.store');



// Changing languages
Route::get('/lang/{lang}', function ($lang) {


    $langs = ['ar', 'en'];

    if (in_array($lang, $langs)) {
        Session::put('locale', $lang);
    }

    return back();
})->name('lang');
