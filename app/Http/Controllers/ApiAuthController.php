<?php

namespace App\Http\Controllers;

use App\User;
use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function login()
    {

    	$token = null;
    	$credentials = request()->only('UserName','StoredPassword');
    	$user = User::where('UserName','=', request()->UserName)->first();
    	
    	if(!$user){
    		return response()->json(['Логин: '. request()->UserName.' не найден'], 422,[], JSON_UNESCAPED_UNICODE);
    	}

    	if (!Hash::check(request()->StoredPassword, $user->StoredPassword))  {
		  return response()->json(['Ошибка пароля'], 422,[], JSON_UNESCAPED_UNICODE);
		}
        
        
        try {
           if (!$token = JWTAuth::fromUser($user)) {
            	return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }

    public function register()
    {

    	$user = User::create([
          'Oid' => "abcd-test".rand(0,100),
          'UserName' => request()->UserName,
          'StoredPassword' => bcrypt(request()->StoredPassword)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token'=>$token],200);
    }
}
