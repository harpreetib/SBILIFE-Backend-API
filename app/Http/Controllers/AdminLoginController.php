<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{

    
    protected $request;
	
	public function __construct(Request $request) {
		date_default_timezone_set("Asia/Kolkata");
        $this->request = $request;
       
	}
	
	
	 function welcome(Request $request){
        $url="";
        $url=HelperController::adminBaseUrl($request);
    
        ## Set Action URL ##
        $action_url =$url;
      #  $action_url .="";
         $action_url .="/loginattempt";
         
		return view('sessions.signIn', ['prefix_url' => $url, 'action_url' => $action_url]);
    }
    
    
     public function CheckLogin(Request $request)
    {
        $url=HelperController::adminBaseUrl($request);

        $validator = Validator::make(['email' => request('email'),'password' => request('password')],[
                        'email' => 'required|email',
                        'password' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            Session()->flash('error', "Username & Password do not match");
            return Redirect::to($url.'/');
        }
        else
        {
        
            if(empty(Session('A_Session'))) {
            // dd(request('brand'));  
                $brandData = DB::table('access_mappings as am')
                            ->join('brand_organizer_master as bm', 'bm.bm_id','am.bm_id')
                            ->select('*')
                            ->where('am.login_id', '=', request('email'))
                            ->where('am.password', '=', request('password'))
                            ->where('bm.bm_nickname',request('brand'))
                            ->where('am.status', 'active')
                            ->whereIn('am.at_id', array(2))
                            ->first();
                        //  dd($brandData);    
                           
                if (isset($brandData->map_id) && !empty($brandData->map_id)) {
                   
                    Session()->put('A_Session', $brandData);
                    Session()->put('bm_id', $brandData->bm_id);
                    
                    
                    $featureData = DB::table('setting_mappings as sm')
                                    ->join('1_app_feature_master as afm','afm.afm_id','sm.afm_id')
                                    ->select('afm.afm_internal_used_name as feature','sm.sm_status as fstatus')
                                    ->where('sm.bm_id',$brandData->bm_id)
                                    ->where('afm.afm_status','active')
                                    ->get();
                    $fdata=[];
                    foreach($featureData as $feature){
                        $fdata[$feature->feature]=$feature->fstatus;
                    }
                    Session()->put('featurelist', $fdata);
    
                    ## Exhibitor Details ##
                    $evntDetail=array();
                
                    ## Current : Event Detail #
                    $evntDetail = DB::table('1_event_master')
                                    ->where('aem_status', '!=', 'inactivate')
                                    ->where('bm_id',$brandData->bm_id)// by sonu 28-feb-2022
                                    ->orderBy('aem_orderby', 'asc')
                                    ->get();
                
                    //dd($evntDetail);
                    Session()->put('AprofileDetail', $brandData);
                    Session()->put('evntDetail', $evntDetail);
                    
                    if(empty($evntDetail[0])){
                        Session()->put('selectedEvent',[]);//sonu-15-december
                    }else{
                        Session()->put('selectedEvent',$evntDetail[0]);//sonu-15-december
                    }
                  
                    return Redirect::to($url.'/dashboard');
    
                }else {
                    Session()->flash('error', "Username & Password do not match");
                    return Redirect::to($url.'/');
                }
            }
    
            // attempt to do the login
            if (!empty(Session('A_Session'))) {
                  return Redirect::to($url.'/dashboard');
            } else {
                Session()->flash('error', "Username & Password do not match");
                return Redirect::to($url.'/');
            }
        }
    }

    function logout(Request $request)
    {
            date_default_timezone_set("Asia/Calcutta");
            $url=HelperController::adminBaseUrl($request);
		//	session()->flush(); // log the user out of our application
              Session()->forget('A_Session');
            Session()->flash('logout', 'You successfully Logout');
          //  Auth::logout();
			
			\Cookie::queue(\Cookie::forget('cookie_lmid'));
			return Redirect::to($url); // redirect the user to the login screen
    }

	
    
    public function AutoCustomerLogin(Request $request)
    {
        $url=HelperController::autoadminBaseUrl($request);
        
        $email = base64_decode(request('email'));
        $password = base64_decode(request('password'));
        $brand = base64_decode(request('brand'));
        
        $validator = Validator::make(['email' => $email,'password' => $password,'brand'=>$brand],[
                        'email' => 'required|email',
                        'password' => 'required',
                        'brand'=>'required'
                    ]);
                    
        if($validator->fails())
        {
            Session()->flash('error', "Username & Password do not match");
            return Redirect::to($url.'/');
        }
        else
        {
        
            if(empty(Session('A_Session'))) {
            // dd(request('brand'));  
                $brandData = DB::table('access_mappings as am')
                            ->join('brand_organizer_master as bm', 'bm.bm_id','am.bm_id')
                            ->select('*')
                            ->where('am.login_id', '=', $email)
                            ->where('am.password', '=', $password)
                            ->where('bm.bm_nickname',$brand)
                            ->where('am.status', 'active')
                            ->whereIn('am.at_id', array(2))
                            ->first();
                        //  dd($brandData);    
                           
                if (isset($brandData->map_id) && !empty($brandData->map_id)) {
                    
                    $projDir = "../".$brand;
                                    
                    if(!is_dir($projDir)) {
                        mkdir($projDir);
                        
                        //copy main file to new folder
                        $source = "../ibmt/main.php";
                        $destination = "../".$brand."/index.php";
                        File::copy($source,$destination);
                    }
                   
                    Session()->put('A_Session', $brandData);
                    Session()->put('bm_id', $brandData->bm_id);
                   
    
                    ## Exhibitor Details ##
                    $evntDetail=array();
                
                    ## Current : Event Detail #
                    $evntDetail = DB::table('1_event_master')
                    ->where('aem_status', '!=', 'inactivate')
                    ->where('bm_id',$brandData->bm_id)// by sonu 28-feb-2022
                       ->orderBy('aem_orderby', 'asc')
                    ->get();
                //   dd($evntDetail);
                    Session()->put('AprofileDetail', $brandData);
                    Session()->put('evntDetail', $evntDetail);
                    
                    if(empty($evntDetail[0])){
                        // dd("no");
                        Session()->put('selectedEvent',[]);//sonu-15-december
                    }else{
                        // dd("yes");
                        Session()->put('selectedEvent',$evntDetail[0]);//sonu-15-december
                    }
                //   dd("sdf");
                  
                  
                    return Redirect::to($url.'/dashboard');
    
                }else {
                    
                    Session()->flash('error', "Username & Password do not match");
                    return Redirect::to($url.'/');
                    
                }
            }
    
            // attempt to do the login
            if (!empty(Session('A_Session'))) {
                  return Redirect::to($url.'/dashboard');
            } else {
                Session()->flash('error', "Username & Password do not match");
                return Redirect::to($url.'/');
            }
        
        }

    }
    
    
    
    
	
}
