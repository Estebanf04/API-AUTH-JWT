<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class jwtmiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }
        catch(Exception $e)
        {
            if($e instanceof TokenInvalidException){
                return response()->json(['message' => 'Token is invalid']);
            }
            else if($e instanceof TokenExpiredException){
                return response()->json(['message' => 'Token is expired']);
            }
            else{
                return response()->json(['message' => 'Access Token not found']);
            }
        }
        return $next($request);
    }
}
