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
*/

Route::get("/v1/user",function(Request $request){
	return json_encode("test api");
})->middleware('jwt.auth');

Route::get('/v1/auth/login',[
	'uses' => 'ApiAuthController@login'
]);

Route::post('/v1/auth/register',[
	'uses' => 'ApiAuthController@register'
]);