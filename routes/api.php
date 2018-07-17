<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOm51bGwsImlzcyI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkvdXNlci9sb2dpbiIsImlhdCI6MTUzMTYzMzc3NCwiZXhwIjoxNTMxNjM3Mzc0LCJuYmYiOjE1MzE2MzM3NzQsImp0aSI6IkZObzI5VkFXbG9sNDgzTjcifQ.WVcerEmjZpKv2SoMZit3aMWcM-skUqHxF9QxIpfrgY4
*/



Route::post('user/register', 'RegisterController@register');
Route::post('user/login', 'LoginController@login');
Route::middleware('jwt.auth')->get('/users', function (Request $request) {
    return auth()->user();
});
Route::middleware('jwt.auth')->group(function(){
    Route::resource('category','api\CategoryService');
});