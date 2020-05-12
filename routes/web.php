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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes(['verify' => true]);


Route::get('login/{provider}', 'Auth\SocialeAccountController@redirect');
Route::get('login/callback/{provider}', 'Auth\SocialeAccountController@callback');


Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

    Route::group(['namespace'=>'Front','prefix'=>'Front'],function(){

        Route::get('UserController', 'UserController@a')->name('test');

    });




    Route::group(
        ['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'] ], function(){ 

            Route::group(['prefix' => 'offers'], function () {
                
                Route::get('create','OfferController@create')->name('offers.create');
                Route::post('store','OfferController@store')->name('offers.store');
        
            });
            
        });


       


  





