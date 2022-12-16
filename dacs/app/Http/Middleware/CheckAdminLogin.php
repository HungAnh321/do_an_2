<?php

namespace App\Http\Middleware;

use App\Utilities\Constant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //Neu chx dawng nhap: chuyen huowg den trang dang nhap
        if(Auth::guest()){
            return  redirect()->guest('admin/login');
        }

        //Neu da dang nhap nhuwng sai mk level thi dang nhap lai
        if(Auth::user()->level != Constant::user_level_host &&Auth::user()->level != Constant::user_level_admin){
            Auth::logout();

            return redirect()->guest('admin/login');

        }


        return $next($request);
    }
}
