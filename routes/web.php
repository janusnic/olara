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

//Route::get('/', 'IndexController@index');
Route::get('/', 'BlogController@index');

Route::get('/blog','BlogApiController@index');

Route::get ( '/cat', function () {
	return view ( 'welcome' );
} );


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');


// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', 'HomeController@index')->name('home.index');
    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    //Route::resource('categories', 'CategoryController');
    Route::get ( '/cat', 'CategoryController@index')->name('categories.index');
    Route::post ( '/categories', 'CategoryController@store' );
    Route::get ( '/categories', 'CategoryController@readItems' );
    Route::post ( '/categories/{id}', 'CategoryController@destroy' );
	Route::resource('articles', 'ArticlesController');
	Route::post('articles_mass_destroy', ['uses' => 'ArticlesController@massDestroy', 'as' => 'articles.mass_destroy']);

});


Route::get ( '/searchfor', function () {
    return view ( 'search.index' );
} );


Route::get('search', 'SearchController@search')->name('api.search');

//Route::resource('home', 'HomeController');
Route::get('/cats', 'CategoryController@list');
Route::get('/cats/{id}', 'CategoryController@show');
//Route::resource('blog', 'ArticlesController');

// Categories
//Route::resource('categories', 'CategoryController');
Route::resource('tags', 'TagController');


// Categories
//Route::resource('categories', 'CategoryController', ['except' => ['create']]);
//Route::resource('tags', 'TagController', ['except' => ['create']]);

Route::get('posts/tag', 'IndexController@tag');
Route::resource('posts', 'IndexController', ['except' => ['create']]);

Route::post('favorite/{article}', 'ArticlesController@favoriteArticle');
Route::post('unfavorite/{article}', 'ArticlesController@unFavoriteArticle');

Route::get('my_favorites', 'UsersController@myFavorites')->middleware('auth');
