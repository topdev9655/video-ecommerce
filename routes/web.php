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
Auth::routes();

// Route::get('video', 'PageController@video')->name('video');

Route::get('/', 'PageController@index')->name('home');

Route::get('movies/{filter?}', 'PageController@movies')->name('movies');

Route::get('movies/{id}/detail', 'PageController@movieDetail')->name('movie.detail');

Route::get('movies/search/{keyword}/{filter?}', 'PageController@searchMovie')->name('movie.search');

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['admin']], function () {

        Route::get('dashboard', 'AdminController@index')->name('dashboard');

        Route::resource('movie', 'MovieController');
        
        Route::resource('user', 'UserController');
        
        Route::resource('wallet', 'WalletController')->only('index');
        
        Route::resource('category', 'CategoryController')->except('show');
        
        Route::resource('genre', 'GenreController')->except('show');
        
        Route::resource('language', 'LanguageController')->except('show');
        
        Route::fallback(function() {
            return view('errors/404');
        });

    });
    
    Route::group(['middleware' => ['user']], function () {
        
        Route::get('profile', 'PageController@profile')->name('profile');

        Route::put('profile/{id}', 'UserController@update')->name('profile.update');

        Route::get('movies/{id}/watch', 'PageController@watchMovie')->name('movie.watch');
        
        Route::fallback(function() {
            return view('404');
        });
    
    });

});

