<?php

namespace App\Http\Middleware;


use Closure;
Use Session;
use Carbon\Carbon;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Redirect;
use Cookie;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Http\Controllers\HelperController;
use App\ComModel;

class superlogin
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
        $url=HelperController::getSAdminBaseUrl($request);
      
        
        if(!empty(Session::has('SA_Session'))) {


        }else{
            

           // Session::flush();
           
           Session()->forget('SA_Session');
            Session::flash('error', 'Your Session has Expired Please login again ');
            return Redirect::to($url);

        }
        return $next($request);

    }
}
