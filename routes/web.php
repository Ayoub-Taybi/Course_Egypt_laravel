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



###################### BEGIN route of Offer with multi language ar en using package mcamara  ###############################


    Route::group(
        ['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'] ], function(){

            Route::group(['prefix' => 'offers'], function () {

                Route::get('create','OfferController@create');
                Route::post('store','OfferController@store')->name('offers.store');

                Route::get('all','OfferController@index')->name('offers.index');

                Route::get('edit/{offer_id}', 'OfferController@editOffer');
                Route::put('update/{id}', 'OfferController@UpdateOffer')->name('offers.update');

                Route::get('delete/{offer_id}', 'OfferController@delete') -> name('offers.delete');


            });



        });


###################### BEGIN of route youtube using event and listener  ###############################


     Route::get('youtube', 'VideoController@getVideo')->middleware('auth');


###################### END  of route youtube using event and listener  ###############################




###################### END route of Offer with multi language ar en using package mcamara  ###############################






############################## BEGIN routes Offer with ajax #####################

Route::group(['prefix' => 'ajax-offers'],function(){
    Route::get('create','AjaxOfferController@create');
    Route::post('store','AjaxOfferController@store') ->name('ajax.offers.store');
    Route::get('all','AjaxOfferController@index') -> name('ajax.offers.all');
    Route::post('delete','AjaxOfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'AjaxOfferController@edit')->name('ajax.offers.edit');
    Route::put('update', 'AjaxOfferController@Update')->name('ajax.offers.update');

});

###################### End Begin routes Offer with ajax ###############################



###################### BEGIN Authentication && Gaurdes ###############################

Route::group(['namespace'=>'Auth','middleware'=>['CheckAge','auth']],function(){

    Route::get('adults','CustomAuthController@Adult')->name('adult');

});



Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth')-> name('site');



Route::group(['namespace'=>'Auth','prefix'=>'admin'],function(){

    Route::get('', 'CustomAuthController@admin')->middleware('auth:admin')-> name('admin');
    Route::get('login', 'AdminController@adminLogin')->name('admin.login');
    Route::post('login', 'AdminController@checkAdminLogin')->name('save.admin.login');
    Route::post('logout', 'AdminController@logout')->name('admin.logout');

});




Route::get('/notadults', function () {
    return 'You are not adults';
})->name('not.adults');



###################### END Authentication && Gaurdes ###############################













