<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cookie;
use Closure;

class CheckLogin
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
        //判断用户是否登录
        $adminuser=session('adminInfo');
        $cookie=Cookie::get('names');
        if(!$adminuser){
            if($cookie){
                session(['adminInfo'=>unserialize($cookie)]);
            }else{
                return redirect('/login');
            }
        }
        
        
            
        
        return $next($request);
    }
}
