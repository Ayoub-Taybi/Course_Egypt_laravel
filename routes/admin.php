<?php




    Route::group(['prefix'=>'Admin','namespace'=>'Admin','middleware'=>'auth'],function(){

        Route::get('/UserController', 'UserController@a')->name('test');

    });


