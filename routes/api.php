<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function (){

    Route::group(['namespace' => 'Admin\Login'], function () {

        Route::post('login','LoginController@login');//登录

        Route::post('logout','LoginController@logout');//登出

        Route::group(['middleware' => 'jwt.auth'], function () {
            Route::get('info','LoginController@info');//获取后台登陆信息     
            
            Route::resource('user', 'UserController');
             
        });
    });

    Route::group(['namespace' => 'Admin\User'], function () {

        Route::group(['middleware' => 'jwt.auth'], function () {    
            
            Route::resource('user', 'UserController');
             
        });
    });

});
