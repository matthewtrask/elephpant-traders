<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        dd('login middleware');
        try
        {
            if (! $user = JWTAuth::parseToken()->authenticate() )
            {
                return response()->json([
                    'code'   => 101, // means auth error in the api,
                   'response' => null // nothing to show
                 ]);
            }
        }
        catch (TokenExpiredException $e)
        {
            // If the token is expired, then it will be refreshed and added to the headers
            try
            {
                $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                $user = JWTAuth::setToken($refreshed)->toUser();
                header('Authorization: Bearer ' . $refreshed);
            }
            catch (JWTException $e)
            {
                return response()->json([
                    'code'   => 103, // means not refreshable
                   'response' => null // nothing to show
                 ]);
            }
        }
        catch (JWTException $e)
        {
            return response()->json([
                'code'   => 101, // means auth error in the api,
                'response' => null // nothing to show
            ]);
        }

        // Login the user instance for global usage
        Auth::login($user, false);

        return  $next($request);
    }
}
