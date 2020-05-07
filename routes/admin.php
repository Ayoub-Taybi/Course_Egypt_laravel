<?php




    Route::group(['prefix'=>'Admin','namespace'=>'Admin'],function(){

        Route::get('/UserController', 'UserController@a')->name('test');

    });


