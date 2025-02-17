<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentOfficerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->usertype != '2'){ 
           Auth::logout();
           return redirect(route('student_login'))->with('error', 'Unrecognized Credentials!');
        }
        if (!Auth::check()){
            return redirect(route('student_login'))->with('error', 'Please enter Valif Credentials!');
        }
        return $next($request);    
    }
}
