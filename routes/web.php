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

Route::view('/', 'landing');

Auth::routes();

Route::group(['middleware' => 'auth'], function()
{
    Route::match(['get', 'post'], '/dashboard', function(){
        return view('dashboard');
    });

    Route::get('/links', 'LinkController@index');
    Route::view('/links/create', 'links.create');

    Route::view('/domains', 'domains.index');
    Route::view('/domains/create', 'domains.create');

    Route::view('/account', 'pages.account');
});
