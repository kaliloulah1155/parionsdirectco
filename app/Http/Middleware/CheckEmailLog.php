<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckEmailLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request,Closure $next)
    {

      if(Auth::guest()){
          if($request->ajax()||$request->wantsJson()){
               return response('Unauthorized',401);
            }else{
             return redirect()->guest('/login');
          }
      }
     
      return $next($request);

      return $response->header('Cache-Control','nocache,no-store,max-age=0,must-revalidate')
      ->header('Pragma','no-cache')
      ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');


    }
}