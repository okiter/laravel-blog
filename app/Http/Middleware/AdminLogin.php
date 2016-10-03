<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        $admin =  session("admin");
        if(!$admin){
           return  redirect("admin/login");  //没有登录转向登录页面
        }
        return $next($request);
    }
}
