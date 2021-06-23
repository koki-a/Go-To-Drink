<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
//API
Route::resource('rest','RestappController', ['only' => ['index', 'show', 'create', 'store', 'destroy']]);

//ゲストログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');

//トップ画面表示
Route::get('/','ShopController@index')->name('shops.top');

//詳細画面表示
Route::get('/{shop}','ShopController@show')->name('shops.show');

//上記以外の基本処理
Route::resource('/shops','ShopController',['except' => ['index', 'show']])->middleware('auth');

//いいね処理
Route::prefix('shops')
    ->name('shops.')
    ->middleware('auth')
    ->group(function () {
    Route::put('/{shop}/like', 'ShopController@like')->name('like');
    Route::delete('/{shop}/like', 'ShopController@unlike')->name('unlike');
});

//店舗検索機能
Route::prefix('shops')
    ->name('shops.')
    ->group(function(){
        Route::post('/searched','ShopController@search')->name('searched');
        Route::get('/searched','ShopController@search')->name('searched');
    });

//ユーザーページ表示
Route::prefix('users')
    ->name('users.')
    ->group(function(){
        Route::get('/{name}','UserController@show')->name('show');
    });

//ユーザーページ編集
Route::prefix('users')
    ->name('users.')
    ->middleware('auth')
    ->group(function(){
        Route::get('/{name}/edit','UserController@edit')->name('edit');
        Route::put('/{name}','UserController@update')->name('update');
    });
