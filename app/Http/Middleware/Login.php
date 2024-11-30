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
use App\Http\Controllers\Auth\HelController;
use App\ComModel;

class Login
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
        $url=HelperController::getBaseUrl($request);
        $basicData=HelController::setimpdata($request);
        $tdetail=$basicData['tdetail'];
        
        if(!empty(Session::has('session'))) {
            
            //return Redirect('dashboard');

        }else{
            
            // $mapidgetlogout = Cookie::get('mapid');
            // $brandid=Cookie::get('brandid');
            //$ip=Cookie::get('ip');
            //DB::table($brandid.'_master_log')->insert(['map_id'=>$mapidgetlogout,'out_time' => now(),'ipaddress'=>$ip]);

            Session::flush();
            Session::flash('error', 'Your Session has Expired Please login again ');
            return Redirect::to($url);

        }
        return $next($request);

    }
}
