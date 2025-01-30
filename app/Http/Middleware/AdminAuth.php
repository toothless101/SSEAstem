<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //if user trying to login and not an admin
        if(Auth::check() && Auth::user()->usertype != '1'){
            Auth::logout();
            return redirect (route('admin_login'))->with('error', 'Only Admin can Access this Page!');
        }

        if(!Auth::check()){
            return redirect(route('admin_login'))->with('error', 'Please enter Valid Credentials!');
        }
        return $next($request);
    }
}
