<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyJWTToken
{
    public function handle($request, Closure $next)
    {
        try{
            $user = JWTAuth::toUser(request()->token);
        }catch (JWTException $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json('token_expired', $e->getStatusCode(),[], JSON_UNESCAPED_UNICODE);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json('token_invalid', $e->getStatusCode(),[], JSON_UNESCAPED_UNICODE);
            }else{
                return response()->json('token_invalid', 400,[], JSON_UNESCAPED_UNICODE);
            }
        }
       return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Max-Age', '1000')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
    }
}
