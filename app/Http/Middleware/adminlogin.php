<?php

namespace App\Http\Middleware;


use Closure;
use Session;
use Carbon\Carbon;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Redirect;
use Cookie;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Controllers\HelperController;
use App\ComModel;

class adminlogin
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
           
        $currentAction = class_basename(\Route::currentRouteAction());
        $url=HelperController::adminBaseUrl($request);

        if(!empty(Session::has('A_Session'))) {


        }else{
            
        
           // Session::flush();
           
           Session()->forget('A_Session');
            Session::flash('error', 'Your Session has Expired Please login again ');
            return Redirect::to($url);

        }
        return $next($request);

    }
}
