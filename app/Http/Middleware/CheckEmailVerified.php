<?php

namespace App\Http\Middleware;

use Closure;

class CheckEmailVerified
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
        if ( ! $request->user()->email_verified) {
            // 若是 AJAX 请求，通过 json 返回
            if ($request->expectsJson()) {
                return $response()->json(['msg' => '请先验证邮箱'], 400);
            }
            return redirect(route('email_verify_notice'));
        }
        return $next($request);
    }
}
