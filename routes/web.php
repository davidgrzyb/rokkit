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

Auth::routes();

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/links', 'LinkController@index')->name('links.index');
    Route::get('/links/create', 'LinkController@create')->name('links.create');
    Route::get('/links/{id}', 'LinkController@view')->name('links.view');
    Route::post('/links/store', 'LinkController@store');
    Route::post('/links/update', 'LinkController@update');

    Route::get('/domains', 'DomainController@index');
    Route::get('/domains/create', 'DomainController@create');
    Route::post('/domains/store', 'DomainController@store');
    Route::post('/domains/delete', 'DomainController@delete');

    Route::get('/account', 'AccountController@index');
    Route::post('/account/update', 'AccountController@update');
    Route::post('/account/upgrade', 'AccountController@upgrade');
    Route::post('/account/downgrade', 'AccountController@downgrade');
});

Route::group(['middleware' => 'check.redirect', 'domain' => '{domain}'], function() {
    Route::get('/ad/{id}', 'LinkController@redirectToAdvertisement');
    Route::get('/{slug}', 'LinkController@redirect');
});