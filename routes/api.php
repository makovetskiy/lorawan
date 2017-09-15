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

Route::get('v1/radiomodules/all',[
	'uses' => 'RadioModuleController@getAllRadiomodules'
])->middleware('cors');;
Route::get('v1/radiomodules/type/all',[
	'uses' => 'RadioModuleController@getAllRadiomodulesTypes'
]);
Route::get('v1/radiomodules/type/all',[
	'uses' => 'RadioModuleController@getAllRadiomodulesTypes'
]);
Route::post('v1/radiomodules/type/save',[
	'uses' => 'RadioModuleController@saveRadiomoduleType'
]);
Route::post('v1/radiomodules/type/delete',[
	'uses' => 'RadioModuleController@deleteRadiomoduleType'
]);
Route::get('v1/radiomodules/type/{id}',[
	'uses' => 'RadioModuleController@showRadiomoduleTypeById'
]);

Route::get('v1/application/all',[
	'uses' => 'ApplicationController@getAllApication'
]);
Route::post('v1/application/create',[
	'uses' => 'ApplicationController@createNewApplication'
]);
Route::post('v1/application/delete',[
	'uses' => 'ApplicationController@deleteApplication'
]);

Route::get('v1/address/region/get/all',[
	'uses' => 'AddressController@getAllRegion'
]);
Route::get('v1/address/regiontype/get/all',[
	'uses' => 'AddressController@getAllRegionTypes'
]);
Route::get('v1/address/city/get/all',[
	'uses' => 'AddressController@getAllCity'
]);
Route::get('v1/address/citytype/get/all',[
	'uses' => 'AddressController@getAllCityTypes'
]);
Route::get('v1/address/streettype/get/all',[
	'uses' => 'AddressController@getAllStreetTypes'
]);
Route::get('v1/address/street/get/all',[
	'uses' => 'AddressController@getAllStreets'
]);
Route::get('v1/address/home/type/get/all',[
	'uses' => 'AddressController@getAllHomeTypes'
]);
Route::get('v1/address/get/all',[
	'uses' => 'AddressController@getAllAddreses'
]);

Route::get('v1/abonent/all',[
	'uses' => 'AbonentController@getAllAbonent'
]);
Route::post('v1/abonent/delete',[
	'uses' => 'AbonentController@deleteAbonent'
]);
Route::get('v1/abonent/test',[
	'uses' => 'AbonentController@testSql'
]);

Route::post('v1/abonent/save',[
	'uses' => 'AbonentController@saveAbonent'
]);
Route::get('v1/abonent/type/get/all',[
	'uses' => 'AbonentController@getAllAbonentTypes'
]);

Route::post('/v1/auth/login',[
	'uses' => 'ApiAuthController@login'
]);

Route::post('/v1/auth/register',[
	'uses' => 'ApiAuthController@register'
]);