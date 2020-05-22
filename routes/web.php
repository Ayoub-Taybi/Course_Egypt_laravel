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


                Route::get('image/{id}', 'OfferController@openImageBrowser') -> name('open-image-browser');


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



###################### BEGIN routes Authentication && Gaurdes ###############################

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


###################### END routes Authentication && Gaurdes ###############################




###################################### BEGIN routes relations   ##########################################

Route::group(['namespace'=>'Relations','prefix'=>'Relations'],function(){


    ################################ BEGIN routes relations One To One  #####################################

    Route::get('has-one', 'RelationsController@hasOneRelation');
    Route::get('has-one-reverse', 'RelationsController@hasOneRelationReverse');
    Route::get('get-user-has-phone', 'RelationsController@getUserHasPhone');
    Route::get('get-user-has-phone-with-condition', 'RelationsController@getUserHastPhoneCondition');
    Route::get('get-user-has-not-phone', 'RelationsController@getUserHasNotPhone');

    ############################### END routes relations One To One  #####################################



    ################################ BEGIN routes relations One To Many  #####################################

    Route::get('hospital-has-many', 'RelationsController@getHospitalDoctors');
    Route::get('hospitals/all', 'RelationsController@getAllHospitals');
    Route::get('hospital/{id}/doctors', 'RelationsController@getAllDoctorsHospital')->name('hospital.doctors');
    Route::get('get-hospitals-has-doctors', 'RelationsController@getHospitalsHasDoctors');
    Route::get('get-hospitals-has-not-doctors', 'RelationsController@getHospitalsHasNotDoctors');
    Route::get('get-hospitals-has-doctors-male', 'RelationsController@getHospitalsHasDoctorsMale');
    Route::get('get-hospitals-has-doctors-not-male', 'RelationsController@getHospitalsHasDoctorsNotMale');
    Route::get('hospital/delete/{id}', 'RelationsController@deleteHospitalWithHisDoctors')->name('hospital.delete');

    ############################# END routes relations One To Many  #####################################


    ################################ BEGIN routes relations Meny To Many  #####################################


    Route::get('doctor/services', 'RelationsController@getDoctorServices');
    Route::get('services/doctor', 'RelationsController@getServiceDoctors');
    Route::get('doctor/{doctor_id}/services', 'RelationsController@getDoctorServicesById')->name('doctors.services');
    Route::put('saveServices-to-doctor', 'RelationsController@saveServicesToDoctors')->name('save.doctors.services');


    ############################# END routes relations Many To Many  #####################################

    
    
});


######################################### END routes relations   ##########################################














