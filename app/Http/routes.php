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
Route::get('/', function () {
    // return view('welcome');
    echo 'Hi, Welcome to Api Server . ';
});

// API 路由接管
$api = app('api.router');
// V1 版本，公有接口
$api->version('v1', function ($api) {
    // 用户注册
    $api->post('auth/register', 'App\Http\Controllers\Api\V1\AuthenticateController@register');
    // 用户登录验证并返回 Token
    $api->post('auth/login', 'App\Http\Controllers\Api\V1\AuthenticateController@authenticate');
    // 获取用户手机验证码
    $api->get('auth/getRandKey', 'App\Http\Controllers\Api\V1\AuthenticateController@getRandKey');
    // 重置用户密码，并发送随机密码到短信
    $api->get('auth/getRandPassword', 'App\Http\Controllers\Api\V1\AuthenticateController@getRandPassword');
});

// 私有接口
$api->version('v1', ['protected' => true], function ($api) {

    // 更新用户 token
    $api->get('upToken', 'App\Http\Controllers\Api\V1\AuthenticateController@upToken');

    // 【用户】
    // 获取当前用户信息
    $api->get('me', 'App\Http\Controllers\Api\V1\UserController@me');
    // 修改当前用户信息
    $api->post('me', 'App\Http\Controllers\Api\V1\UserController@up');
});

// END V1 版本
