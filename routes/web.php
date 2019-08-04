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
Route::get('/test', 'Testcontroller@index');

Route::namespace('Frontend')->prefix('pages')->group(function () {
    

    // FoodHistory Frontend Route
    Route::get('/foodHistories', 'FoodHistoriesController@index')->name('foodHistory.frontend.index');


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

    // FoodHistory Route
    Route::get('foodHistories', 'FoodHistoriesController@index')->name('foodHistory.index');
    Route::get('/foodHistories/new', 'FoodHistoriesController@form')->name('foodHistory.new');
    Route::get('/foodHistories/{foodHistory}', 'FoodHistoriesController@form')->name('foodHistory.form');
    Route::post('/foodHistories/save', 'FoodHistoriesController@post')->name('foodHistory.save');
    Route::post('/foodHistories/{foodHistory}/delete', 'FoodHistoriesController@delete')->name('foodHistory.delete');
    Route::post('/foodHistories/{foodHistory}/restore', 'FoodHistoriesController@restore')->name('foodHistory.restore');
    Route::post('/foodHistories/{foodHistory}/force-delete', 'FoodHistoriesController@forceDelete')->name('foodHistory.force-delete');


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


Route::get("/index", "LogController@getHome")->name("home");
Route::get("/login", "LogController@loginForm")->name("login");
Route::get("/logout", "LogController@logout")->name("logout");
Route::post("/login", "LogController@postLogin")->name("login.post");

Route::get("/register", "LogController@registrationForm")->name("register");
Route::post("/register", "LogController@postRegistration")->name("register.post");

Route::middleware("auth")->group(function ()
{
    Route::get("/home", "ProfilesController@home")->name("profiles.home");
    Route::get("/profile/new", "ProfilesController@form")->name("profiles.new");
    Route::get("/report", "FoodController@reportForm")->name("report.form");
    Route::get("/report/show", "FoodController@reportPost")->name("report.show");
    Route::post("/profile/save", "ProfilesController@post")->name("profiles.save");

    Route::get('/food/add', 'FoodController@getIndex')->name('food.add');
    Route::post('/food/add', 'FoodController@postFood')->name('food.post');

    Route::get('/food-catalogue', 'FoodController@getFoodCatalogue')->name('food.catalogue');
    Route::get('/food/nutrition-details/{product}', 'FoodController@getNutritionDetails')->name('food.nutrition_details');

    Route::post('/food/consume', 'FoodController@postConsumeFood')->name('food.consume.post');
});



