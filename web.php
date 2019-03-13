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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::namespace('Frontend')->prefix('pages')->group(function () {
    

    // Profile Frontend Route
    Route::get('/profiles', 'ProfilesController@index')->name('profile.frontend.index');
});

Route::namespace('Backend')->prefix('backend')->group(function () {
    Route::get('/login', 'AuthController@getLogin')->name('backend.login.form');
    Route::post('/login', 'AuthController@postLogin')->name('backend.login.post');
    Route::get('/logout', 'AuthController@logout')->name('backend.logout');
});

Route::middleware(['role:admin', 'auth'])->namespace('Backend')->prefix('backend')->group(function () {
    Route::get('/', 'DashboardController@index')->name('backend.dashboard');

    // Profile Route
    Route::get('profiles', 'ProfilesController@index')->name('profile.index');
    Route::get('/profiles/new', 'ProfilesController@form')->name('profile.new');
    Route::get('/profiles/{profile}', 'ProfilesController@form')->name('profile.form');
    Route::post('/profiles/save', 'ProfilesController@post')->name('profile.save');
    Route::post('/profiles/{profile}/delete', 'ProfilesController@delete')->name('profile.delete');
    Route::post('/profiles/{profile}/restore', 'ProfilesController@restore')->name('profile.restore');
    Route::post('/profiles/{profile}/force-delete', 'ProfilesController@forceDelete')->name('profile.force-delete');


    Route::get('/profile', 'AuthController@getProfile')->name('backend.profile');
    Route::post('/profile/save', 'AuthController@postProfile')->name('backend.profile.post');
  //ROUTES
});
// DO NOT EDIT THIS LINE
