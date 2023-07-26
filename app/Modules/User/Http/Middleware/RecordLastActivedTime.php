<?php

namespace App\Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class RecordLastActivedTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 如果是登录用户的话
        if (Auth::check()) {
            $user = Auth::user();
            // 记录最后登录时间
            $user->recordLastActivedAt();

            // 如果token失效了，则重新生成并存储
            if (!session()->has('login_token')){
                $token = JWTAuth::fromUser($user);
                // 存储登录会员的token
                session()->put('login_token', $token);
            }
        }

        return $next($request);
    }
}
