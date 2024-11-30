<?php

namespace App\Http\Middleware;


use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Cookie;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

use App\Models\ApiModel;

class validatetoken
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
        $user_id = request('user_id');
        $lemmId = Crypt::decrypt($user_id);
        
        $token_id = request('token_id');
        $token_id = Crypt::decrypt($token_id);
        
        $isExist = ApiModel::GetLeadDataByLemmId($lemmId, $token_id);
        if($isExist) {
            return $next($request);
        }
        else{
            return response()->json(['code' => 404,'msg'=>'Parameter missing or invalid']);
        }
    }
}
