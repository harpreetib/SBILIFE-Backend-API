<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Auth;


class SuperadminLoginController extends Controller
{

    
    protected $request;
	
	public function __construct(Request $request) {
		date_default_timezone_set("Asia/Kolkata");
        $this->request = $request;
       
	}
	
	
	 function welcome(Request $request){
        $url="";
        $url=HelperController::SadminBaseUrl($request);
    
        ## Set Action URL ##
        $action_url =$url;
      #  $action_url .="";
         $action_url .="/loginattempt";
		return view('sessions.signIn', ['prefix_url' => $url, 'action_url' => $action_url]);
    }
    
    
     public function CheckLogin(Request $request)
    {
    
        
        $url=HelperController::getSAdminBaseUrl($request);
        // $validator = Validator::make(Request::all(), [
          
        // ]);
        
        
        $validator = $request->validate([
          'email' => 'required',
          'password' => 'required'
        ]);
 
        
        

        // if ($validator->fails() && empty(Session('SA_Session'))) {
        //     return redirect::back()->with(['errors' => $validator->errors()]);
        // } else
        
        
        if (empty(Session('SA_Session'))) {

            $brandData = DB::table('access_mappings as am')
                        ->leftjoin('brand_organizer_master as bm', 'bm.bm_id','am.bm_id')
                        ->select('*')
                        ->where('am.login_id', '=', request('email'))
                        ->where('am.password', '=', request('password'))
                        ->where('am.status', 'active')
                        ->whereIn('am.at_id', array(1))
                        ->first();
                        
            if (isset($brandData->map_id) && !empty($brandData->map_id)) {
               
                Session()->put('SA_Session', $brandData);
                Session()->put('bm_id', $brandData->bm_id);
               

                ## Exhibitor Details ##
                $evntDetail=array();
            
                ## Current : Event Detail #
                $evntDetail = DB::table('1_event_master')
                ->where('aem_status', '!=', 'inactivate')
                   ->orderBy('aem_orderby', 'asc')
                ->get();
                Session()->put('SAprofileDetail', $brandData);
                Session()->put('evntDetail', $evntDetail);
                Session()->put('selectedEvent', $evntDetail[0]);
                return Redirect::to($url.'/dashboard');

            }else {
                
                Session()->flash('error', "Username & Password do not match");
                return Redirect::to($url.'/');
                
            }
        }

        // attempt to do the login
        if (!empty(Session('SA_Session'))) {
            return Redirect::to($url.'/dashboard');
        } else {
            Session()->flash('error', "Username & Password do not match");
            return Redirect::to($url.'/');
        }

    }

    function logout(Request $request)
    {
            date_default_timezone_set("Asia/Calcutta");
            $url=HelperController::getSAdminBaseUrl($request);
		//	session()->flush(); // log the user out of our application
              Session()->forget('SA_Session');
            Session()->flash('logout', 'You successfully Logout');
          //  Auth::logout();
			
			\Cookie::queue(\Cookie::forget('cookie_lmid'));
			return Redirect::to($url); // redirect the user to the login screen
    }
    
    	public function checkuser(Request $request)
	{
	    dd('chekkk11');
	}

	
    
    
    
    
    
    
	
}
