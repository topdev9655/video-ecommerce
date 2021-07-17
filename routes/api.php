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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'api\UserController@login');
Route::post('register', 'api\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user/detail', 'api\UserController@details');

    Route::post('logout', 'api\UserController@logout');

    Route::resource('wallet','api\WalletController', ['except'=>['create','edit']]);
});


