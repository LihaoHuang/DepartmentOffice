<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::get('auth/login',['as' => 'google.auth', 'uses' => 'GoogleController@redirectToGoogle']);
Route::get('auth/callback', 'GoogleController@handleGoogleCallback');

Route::group(['middleware' =>'auth'],function(){

    Route::get('/',['as' => 'home', function () {
        return view('pages.index',['mainTitle' => '']);
    }]);

    Route::group(['prefix'=>'vote'],function(){
        Route::get('/',['as' => 'vote', 'uses' => 'TurnoutsController@index']);
        Route::get('/static/{id?}',['as' => 'vote.static', 'uses' => 'TurnoutsController@show']);
        Route::post('/store',['as' => 'vote.store','uses' => 'TurnoutsController@store']);
        Route::patch('/{id?}',['as' => 'vote.update','uses' => 'TurnoutsController@update']);
        Route::delete('/delete/{id?}',['as' => 'vote.delete','uses' => 'TurnoutsController@destroy']);
        Route::get('/download/{filename?}',['as' => 'getFile','uses' => 'TurnoutsController@download']);
    });

    Route::group(['prefix' => 'apply'],function(){
        Route::get('/',['as' => 'apply',  'uses' => 'ApplysController@index']);
        Route::post('/store',['as' => 'apply.store','uses' => 'ApplysController@store']);
        Route::patch('/{id?}',['as' => 'apply.update','uses' => 'ApplysController@update']);
        Route::delete('/delete/{id?}',['as' => 'apply.delete','uses' => 'ApplysController@destroy']);
    });
    
    Route::group(['prefix' => 'manager'],function(){    
        Route::get('/',['as' => 'manager', 'uses' => 'UsersController@index']);
        Route::post('/store',['as' => 'manager.store','uses' => 'UsersController@store']);
        Route::patch('/{id?}',['as' => 'manager.update','uses' => 'UsersController@update']);
        Route::delete('maager/delete/{id?}',['as' => 'manager.delete','uses' => 'UsersController@destroy']); 
    });

    Route::group(['prefix' => 'log'],function(){
        Route::get('/',['as' => 'log', 'uses' => 'LogsController@index']);
        Route::get('login',['as' => 'log.in', 'uses' => 'LogsController@create']);
        Route::post('logout',['as' => 'log.out', 'uses' => 'LogsController@update']);
    });

});


