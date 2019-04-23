<?php

use Illuminate\Http\Request;

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

// Redprint Auth Route
// You can implement your own Auth endpoint and method
Route::post(
    'permissible/auth/token',
    '\Shahnewaz\Permissible\Http\Controllers\API\AuthController@postAuthenticate'
)->name('permissible.auth.token');

// API Routes
// Access them like: /api/v1/route
Route::middleware(['jwt.auth', 'role:admin'])->namespace('Backend\API')->prefix('v1/backend')->group(function () {
    //ROUTES

    // Profile Route
    Route::get('profiles', 'ProfilesController@index')->name('api.profile.index');
    Route::get('/profiles/{profile}', 'ProfilesController@form')->name('api.profile.form');
    Route::post('/profiles/save', 'ProfilesController@post')->name('api.profile.save');
    Route::post('/profiles/{profile}/delete', 'ProfilesController@delete')->name('api.profile.delete');
    Route::post('/profiles/{profile}/restore', 'ProfilesController@restore')->name('api.profile.restore');
    Route::post('/profiles/{profile}/force-delete', 'ProfilesController@forceDelete')->name('api.profile.force-delete');
});
