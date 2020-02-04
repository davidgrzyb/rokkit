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

    Route::get('/domains', 'DomainController@index');
    Route::get('/domains/create', 'DomainController@create');
    Route::post('/domains/store', 'DomainController@store');
    Route::post('/domains/delete', 'DomainController@delete');

    Route::get('/account', 'AccountController@index');
    Route::post('/account/update', 'AccountController@update');
    Route::post('/account/upgrade', 'AccountController@upgrade');
});

Route::get('/{slug}', 'LinkController@redirect');

Route::group(['domain' => '{domain}'], function() {

});