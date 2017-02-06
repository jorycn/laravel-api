<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| 对外cors接口
|--------------------------------------------------------------------------
|
*/
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace'=>'App\Http\Api'], function ($api) {
    $api->group(['prefix'=>'bxjk', 'middleware'=>'api.domain'], function($api){
        // 留言
        $api->post('message', 'BxjkController@messageSubmit');
    });
});

/*
|--------------------------------------------------------------------------
| 系统自用路由
|--------------------------------------------------------------------------
|
*/
Route::post('/data/login', 'AuthController@login');   
Route::post('/data/register', 'AuthController@register');   
Route::get('/data/check', 'AuthController@checkAuth');   

Route::group(['middleware'=> 'jwt.auth', 'prefix'=>'data'], function(){
    Route::get('/me', 'AuthController@userInfo');
    Route::get('/category', 'CategoryController@index');
});

# Vue
Route::any('{all}', function () {
    return view('index');
})->where(['all' => '.*']);
