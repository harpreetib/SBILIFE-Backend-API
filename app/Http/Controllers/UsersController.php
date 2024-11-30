<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\UsersModel;

use App\Http\Controllers\Auth\HelController;
use Validator;
Use Session;
Use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use App\Http\Controllers\HelperController;
use Cookie;

class UsersController extends Controller
{
	protected $request;
	protected $brandData;
	protected $tdetail;
	protected $eventDetails;

	public function __construct(Request $request) {
		date_default_timezone_set("Asia/Calcutta");
        $this->request = $request;
		$this->basicData=HelController::setimpdata($request);
	}

###-----------------------------------------------------------------------------------###
	
    function welcome(Request $request){
		
        $url="";
        $url=HelperController::exhibitorBaseUrl($request);
    
        ## Set Action URL ##
        $action_url =$url;
        $action_url .="/loginattempt";
		return view('sessions.signIn', ['prefix_url' => $url, 'action_url' => $action_url]);
    }

    function forgetPassword(Request $request) {
        $url="";
        $url=HelperController::exhibitorBaseUrl($request);
    
        ## Set Action URL ##
        $action_url =$url;
        $action_url .="/loginattempt";
		return view('sessions.forgetPassword', ['prefix_url' => $url, 'action_url' => $action_url]);
    }

    function changePassword(Request $request) {
        
        $url=HelperController::getBaseUrl($request);
        $email = request('email');
        $password = request('password');
         $otp = request('OTP');
         
         $validator = Validator::make(['email' => request('email'),'password' => request('password'),'otp'=>request('OTP')],[
                        'email' => 'required|email',
                        'password' => 'required',
                        'otp'=>'required'
                    ]);
                    
        if($validator->fails())
        {
            Session::flash('error', "Email Address does not exists");
            return Redirect::to($url.'/forgot-password');
        }
        else
        {
        
            $check =  DB::table('1_exhibitor_boothstaff')
            ->where('ebm_login_user', $email)
            ->first();
    
    
            if (!empty($check) && $otp==$check->otp ){
                $update =  	DB::table('1_exhibitor_boothstaff')
                        ->where('ebm_login_user', $email)
                        ->update([
                        'ebm_login_pwd'=>$password           
                    ]);
                    
                     $mailFromEmail='info@mymedex.com.my';
                 $mailFrom='MyMEDEX 2021 Secretariat';
                 $mailsendpp=$email;
                 $subject="Password has been changed successfully";
                 $otp=rand(100000, 999999);
                
                \Mail::send('sucess_template', ['user' => $subject, 'name' => $check->ebsm_name], function ($mail) use ($subject,$mailFromEmail,$mailFrom,$mailsendpp) {
    
                    $mail->from($mailFromEmail, $mailFrom);
                    $mail->to($mailsendpp)
                        ->subject($subject);
                });
                        
                Session::flash('success', "Password has been changed successfully!");
                    return Redirect::to($url.'/forgot-password');
        
            }else{
                Session::flash('error', "Email Address does not exists");
                    return Redirect::to($url.'/forgot-password');
            }
        }
    }
    
    
    function sendotp(Request $request) {
        
        $url=HelperController::getBaseUrl($request);
        $email = request('email');
        
        $validator = Validator::make(['email' => $email],[
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $otp='';
            $check =  DB::table('1_exhibitor_boothstaff')
            ->where('ebm_login_user', $email)
            ->first();
    
           
            if (!empty($check)){
               $mailFromEmail='invitation@smartevents.in';
                 $mailFrom='Wipro';
                 $mailsendpp=$email;
                 $subject="OTP FOR Reset Password";
                 $otp=rand(100000, 999999);
                
                \Mail::send('mail_template', ['user' => $otp, 'name' => $check->ebsm_name], function ($mail) use ($subject,$mailFromEmail,$mailFrom,$mailsendpp) {
    
                    $mail->from($mailFromEmail, $mailFrom);
                    $mail->to($mailsendpp)
                        ->subject($subject);
                });
                 DB::table('1_exhibitor_boothstaff')
            ->where('ebm_login_user', $email)
            ->update(['otp'=>$otp]);
           // dd($otp);
               return base64_encode($otp);
        
            }else{
                
                    return $otp;
            }
        }
    }
    
    public function CheckLogin(Request $request)
    {
    
        //$data=request::all();
        $data=$request->all();
        $url=HelperController::getBaseUrl($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails() && empty(Session('session'))) {
            return redirect::back()->with(['errors' => $validator->errors()]);
        } else if (empty(Session('session'))) {

            $basicData=$this->basicData;
            $tdetail=$basicData['tdetail'];
            $eventdetail=$basicData['event'];
            $branddetail=$basicData['brand'];

            $brandData = DB::table('1_exhibitor_boothstaff as eb')
                        ->join('1_exhibitor_master as em', 'em.exhim_id','eb.exhim_id')
                         ->join('1_exhibitor_event_mapping as eem', 'eem.exhim_id','eb.exhim_id')
                        ->select('*','eb.ebsm_name as user_name', 'eem.ppm_id as ppmId')
                        ->where('eb.ebm_login_user', '=', request('email'))
                       // ->where('eb.otp', '=', request('password'))
                       ->where('eb.ebm_login_pwd', '=', request('password'))
                        ->where('em.exhim_status', '=', 'active')
                        ->where('eb.ebsm_statu', '=', 'active')
                        ->where('eem.eem_status','active')
                        ->first();
       
            if (isset($brandData->exhim_id) && !empty($branddetail->bm_id)) {
               
                $authData[0]=$brandData;
                $authData[0]->bm_id=$branddetail->bm_id;
                   $authData[0]->bm_logo=$branddetail->bm_logo;
                $authData[0]->bm_banner=$branddetail->bm_banner;
                 $authData[0]->bm_theme=$branddetail->bm_theme;
                Session::put('session', $authData);
                Session::put('bm_id', $branddetail->bm_id);
                
                Session::put('brand', $branddetail->bm_nickname);
                
                Session::put('u_type', 'exhib');
               
                $tablesName = collect([
                                ## Lead Part ##
                                'lead_master'=> $branddetail->bm_id.'_'.'lead_master',
                                'event_master'=>$branddetail->bm_id.'_'.'event_master',
                                  'inquiry_data'=>$branddetail->bm_id.'_'.'inquiry_data',
                                   'lead_event_master_mapping_attendance'=>$branddetail->bm_id.'_'.'lead_event_master_mapping_attendance',

                                ## Exhibitor ##
                                'exhibitor_master'=>$branddetail->bm_id.'_'.'exhibitor_master',
                                'exhibitor_gallery'=>$branddetail->bm_id.'_'.'exhibitor_gallery',
                                'exhibitor_highlights_mapping'=>$branddetail->bm_id.'_'.'exhibitor_highlights_mapping',
                                'exhibitor_product_mapping'=>$branddetail->bm_id.'_'.'exhibitor_product_mapping',
                                'exhibitor_product_master'=>$branddetail->bm_id.'_'.'exhibitor_product_master',
                                'exhibitor_boothstaff'=>$branddetail->bm_id.'_'.'exhibitor_boothstaff',
                                'exhibitor_event_mapping'=>$branddetail->bm_id.'_'.'exhibitor_event_mapping',
                                'exhibitor_city_master'=>$branddetail->bm_id.'_'.'exhibitor_city_master',
                                'exhibitor_event_with_boothstaff_mapping'=>$branddetail->bm_id.'_'.'exhibitor_event_with_boothstaff_mapping',
                                ## Masters ##
                                'master_lead_source'=>$branddetail->bm_id.'_'.'master_lead_source',
                                'organization_type'=>$branddetail->bm_id.'_'.'organization_type',
                                'parent_product_master'=>$branddetail->bm_id.'_'.'parent_product_master',
                                'product_master'=>$branddetail->bm_id.'_'.'product_master',
                                'qualification_master'=>$branddetail->bm_id.'_'.'qualification_master',
                                'master_city'=>'master_city',
                                'master_state'=>'master_state',
                                'master_country'=>'master_country',

                                'lead_event_master_mapping'=>$branddetail->bm_id.'_'.'lead_event_master_mapping',
                                'lead_event_exhibitor_mapping'=>$branddetail->bm_id.'_'.'lead_event_exhibitor_mapping',
                                'lead_categorization'=>$branddetail->bm_id.'_'.'lead_categorization',
                                'lead_event_exhibitor_mapping_remark'=>$branddetail->bm_id.'_'.'lead_event_exhibitor_mapping_remark',
                                'lead_event_exhibitor_mapping_activity'=>$branddetail->bm_id.'_'.'lead_event_exhibitor_mapping_activity',
                                'activity_master'=>$branddetail->bm_id.'_'.'activity_master',
                                 ## Plan Subscription ##
                                'participation_plans_subscription_mapping'=>$branddetail->bm_id.'_'.'participation_plans_subscription_mapping',
                                'participation_plans_master'=>$branddetail->bm_id.'_'.'participation_plans_master',
                                'participation_plans_subscription'=>$branddetail->bm_id.'_'.'participation_plans_subscription',
 #### Meeting Table ####
                                
 'byer_meet_slot_mapping'=>$branddetail->bm_id.'_'.'byer_meet_slot_mapping',
 'meetings_data'=>$branddetail->bm_id.'_'.'meetings_data',
 'meeting_slot_master'=>$branddetail->bm_id.'_'.'meeting_slot_master',
 
          #### Meeting Table ####
 
 'byer_meet_slot_mapping'=>$branddetail->bm_id.'_'.'byer_meet_slot_mapping',
 'meetings_data'=>$branddetail->bm_id.'_'.'meetings_data',
 'meeting_slot_master'=>$branddetail->bm_id.'_'.'meeting_slot_master',
 'exhibitor_cart'=>$branddetail->bm_id.'_'.'exhibitor_cart',
                                
                            ]);

                Session::put('tdetail', $tablesName);
                $tdetail=Session('tdetail');
        
                $evntDetail=array();
                $currentEventDetail=array();
                ## Exhibitor Details ##
                
                if($brandData->at_id=='2'){
                   
                     ## Current : Event Detail #
                         $evntSQL = DB::table('1_event_master')
                         ->where('aem_status', '!=', 'inactivate')
                         ->where('aem_viewinlist', '=', 'Y')
                         ->orderBy('aem_orderby', 'asc');
                         
                        $evntSQL->where('aem_status', '!=', 'old');
                        $evntDetail=$evntSQL->get();
                        
                        ## Current Event ## 
                        $evntSQL->where('aem_status', '=', 'current');
                        $currentEventDetail=$evntSQL->first();
                     
                }else{

                    if(isset($brandData->exhim_id)){
                        ## Current : Event Detail #
                        $evntSQL = DB::table('1_event_master as em' )
                        ->join('1_exhibitor_event_mapping as eem', 'eem.aem_id','em.aem_id')
                        ->select('em.*','eem.eem_id')
                        ->where('em.aem_status', '!=', 'inactivate')->where('em.aem_status', '!=', 'old')
                        ->where('eem.eem_status', '=', 'active')
                        ->where('em.aem_viewinlist', '=', 'Y')
                        ->where('eem.exhim_id', '=', $brandData->exhim_id)
                        ->orderBy('em.aem_orderby', 'asc');
                         ## All Active Event: List #
                        $evntDetail=$evntSQL->get();
                        
                        ## Current Event ## 
                        $evntSQL->where('em.aem_status', '=', 'current');
                        $currentEventDetail=$evntSQL->first();
                
                
                    }

                }
                
                
                Session::put('profileDetail', $brandData);
                Session::put('evntDetail', $evntDetail);
                Session::put('selectedEvent', $currentEventDetail);
                Session::put('livestatus', $brandData->ebsm_livestatus);
           
               
                if ($brandData->at_id=='8'){
                    //return Redirect::to($url.'/meetings');
                    return Redirect::to($url.'/my-leads');
                    
                }else{
                    return Redirect::to($url.'/my-leads');
                }
           

            }else {
                
                Session::flash('error', "Username & Password do not match");
                return Redirect::to($url.'/');
                
            }
        }

        // attempt to do the login
        if (!empty(Session('session'))) {
              return Redirect::to($url.'/my-leads');
        } else {
            Session::flash('error', "Username & Password do not match");
            return Redirect::to($url.'/');
        }

    }

    function logout(Request $request)
    {
            date_default_timezone_set("Asia/Calcutta");
            $url=HelperController::getBaseUrl($request);
			session()->flush(); // log the user out of our application
            
            Session::flash('logout', 'You successfully Logout');
            Auth::logout();
			
			\Cookie::queue(\Cookie::forget('cookie_lmid'));
			return Redirect::to($url); // redirect the user to the login screen
    }

	function sendotpexhibitor(){
	    
	       $basicData=$this->basicData;
            $tdetail=$basicData['tdetail'];
            $eventdetail=$basicData['event'];
            $branddetail=$basicData['brand'];
	     $email = request('email');
	     
	    $validator = Validator::make(['email' => $email],[
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            return "failed";
        }
        else
        {
            $otp='';
            $check =  DB::table($tdetail['exhibitor_boothstaff'].' as eb')
                            ->join($tdetail['exhibitor_master'].' as em', 'em.exhim_id','eb.exhim_id')
                             ->join($tdetail['exhibitor_event_mapping'].' as eem', 'eem.exhim_id','eb.exhim_id')
                            ->select('*','eb.ebsm_name as user_name', 'eem.ppm_id as ppmId')
                            ->where('eb.ebm_login_user', '=', request('email'))
                            ->where('em.exhim_status', '=', 'active')
                            ->where('eb.ebsm_statu', '=', 'active')
                            ->where('eem.eem_status','active')
                            ->first();
                    
    
           
            if (!empty($check)){
               $mailFromEmail='invitation@smartevents.in';
                 $mailFrom='Wipro';
                 $mailsendpp=$email;
                 $subject="OTP FOR Login";
                 $otp=rand(100000, 999999);
                
                \Mail::send('mail_template', ['user' => $otp, 'name' =>request('email') ], function ($mail) use ($subject,$mailFromEmail,$mailFrom,$mailsendpp) {
    
                    $mail->from($mailFromEmail, $mailFrom);
                    $mail->to($mailsendpp)
                        ->subject($subject);
                });
                 DB::table('1_exhibitor_boothstaff')
            ->where('ebm_login_user', request('email'))
            ->update(['otp'=>$otp]);
           // dd($otp);
               return "success";
        
            }else{
                
                    return "failed";
            }
        }
	    
	}
	
	
	public function AutoLoginAttempt(Request $request)
    {
    
        //$data=request::all();
        $data=$request->all();
        $url=HelperController::getBaseUrl($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'pwd' => 'required'
        ]);

        if ($validator->fails() && empty(Session('session'))) {
            return redirect::back()->with(['errors' => $validator->errors()]);
        } else if (empty(Session('session'))) {

            $basicData=$this->basicData;
            $tdetail=$basicData['tdetail'];
            $eventdetail=$basicData['event'];
            $branddetail=$basicData['brand'];

            $brandData = DB::table('1_exhibitor_boothstaff as eb')
                        ->join('1_exhibitor_master as em', 'em.exhim_id','eb.exhim_id')
                         ->join('1_exhibitor_event_mapping as eem', 'eem.exhim_id','eb.exhim_id')
                        ->select('*','eb.ebsm_name as user_name', 'eem.ppm_id as ppmId')
                        ->where('eb.ebm_login_user', '=', request('email'))
                       // ->where('eb.otp', '=', request('password'))
                       ->where('eb.ebm_login_pwd', '=', base64_decode(request('pwd')))
                        ->where('em.exhim_status', '=', 'active')
                        ->where('eb.ebsm_statu', '=', 'active')
                        ->where('eem.eem_status','active')
                        ->first();
       
            if (isset($brandData->exhim_id) && !empty($branddetail->bm_id)) {
               
                $authData[0]=$brandData;
                $authData[0]->bm_id=$branddetail->bm_id;
                   $authData[0]->bm_logo=$branddetail->bm_logo;
                $authData[0]->bm_banner=$branddetail->bm_banner;
                 $authData[0]->bm_theme=$branddetail->bm_theme;
                Session::put('session', $authData);
                Session::put('bm_id', $branddetail->bm_id);
                
                Session::put('brand', $branddetail->bm_nickname);
                
                Session::put('u_type', 'exhib');
               
                $tablesName = collect([
                                ## Lead Part ##
                                'lead_master'=> $branddetail->bm_id.'_'.'lead_master',
                                'event_master'=>$branddetail->bm_id.'_'.'event_master',
                                  'inquiry_data'=>$branddetail->bm_id.'_'.'inquiry_data',
                                   'lead_event_master_mapping_attendance'=>$branddetail->bm_id.'_'.'lead_event_master_mapping_attendance',

                                ## Exhibitor ##
                                'exhibitor_master'=>$branddetail->bm_id.'_'.'exhibitor_master',
                                'exhibitor_gallery'=>$branddetail->bm_id.'_'.'exhibitor_gallery',
                                'exhibitor_highlights_mapping'=>$branddetail->bm_id.'_'.'exhibitor_highlights_mapping',
                                'exhibitor_product_mapping'=>$branddetail->bm_id.'_'.'exhibitor_product_mapping',
                                'exhibitor_product_master'=>$branddetail->bm_id.'_'.'exhibitor_product_master',
                                'exhibitor_boothstaff'=>$branddetail->bm_id.'_'.'exhibitor_boothstaff',
                                'exhibitor_event_mapping'=>$branddetail->bm_id.'_'.'exhibitor_event_mapping',
                                'exhibitor_city_master'=>$branddetail->bm_id.'_'.'exhibitor_city_master',
                                'exhibitor_event_with_boothstaff_mapping'=>$branddetail->bm_id.'_'.'exhibitor_event_with_boothstaff_mapping',
                                ## Masters ##
                                'master_lead_source'=>$branddetail->bm_id.'_'.'master_lead_source',
                                'organization_type'=>$branddetail->bm_id.'_'.'organization_type',
                                'parent_product_master'=>$branddetail->bm_id.'_'.'parent_product_master',
                                'product_master'=>$branddetail->bm_id.'_'.'product_master',
                                'qualification_master'=>$branddetail->bm_id.'_'.'qualification_master',
                                'master_city'=>'master_city',
                                'master_state'=>'master_state',
                                'master_country'=>'master_country',

                                'lead_event_master_mapping'=>$branddetail->bm_id.'_'.'lead_event_master_mapping',
                                'lead_event_exhibitor_mapping'=>$branddetail->bm_id.'_'.'lead_event_exhibitor_mapping',
                                'lead_categorization'=>$branddetail->bm_id.'_'.'lead_categorization',
                                'lead_event_exhibitor_mapping_remark'=>$branddetail->bm_id.'_'.'lead_event_exhibitor_mapping_remark',
                                'lead_event_exhibitor_mapping_activity'=>$branddetail->bm_id.'_'.'lead_event_exhibitor_mapping_activity',
                                'activity_master'=>$branddetail->bm_id.'_'.'activity_master',
                                 ## Plan Subscription ##
                                'participation_plans_subscription_mapping'=>$branddetail->bm_id.'_'.'participation_plans_subscription_mapping',
                                'participation_plans_master'=>$branddetail->bm_id.'_'.'participation_plans_master',
                                'participation_plans_subscription'=>$branddetail->bm_id.'_'.'participation_plans_subscription',
 #### Meeting Table ####
                                
 'byer_meet_slot_mapping'=>$branddetail->bm_id.'_'.'byer_meet_slot_mapping',
 'meetings_data'=>$branddetail->bm_id.'_'.'meetings_data',
 'meeting_slot_master'=>$branddetail->bm_id.'_'.'meeting_slot_master',
 
          #### Meeting Table ####
 
 'byer_meet_slot_mapping'=>$branddetail->bm_id.'_'.'byer_meet_slot_mapping',
 'meetings_data'=>$branddetail->bm_id.'_'.'meetings_data',
 'meeting_slot_master'=>$branddetail->bm_id.'_'.'meeting_slot_master',
 'exhibitor_cart'=>$branddetail->bm_id.'_'.'exhibitor_cart',
                                
                            ]);

                Session::put('tdetail', $tablesName);
                $tdetail=Session('tdetail');
        
                $evntDetail=array();
                $currentEventDetail=array();
                ## Exhibitor Details ##
                
                if($brandData->at_id=='2'){
                   
                     ## Current : Event Detail #
                         $evntSQL = DB::table('1_event_master')
                         ->where('aem_status', '!=', 'inactivate')
                         ->where('aem_viewinlist', '=', 'Y')
                         ->orderBy('aem_orderby', 'asc');
                         
                        $evntSQL->where('aem_status', '!=', 'old');
                        $evntDetail=$evntSQL->get();
                        
                        ## Current Event ## 
                        $evntSQL->where('aem_status', '=', 'current');
                        $currentEventDetail=$evntSQL->first();
                     
                }else{

                    if(isset($brandData->exhim_id)){
                        ## Current : Event Detail #
                        $evntSQL = DB::table('1_event_master as em' )
                        ->join('1_exhibitor_event_mapping as eem', 'eem.aem_id','em.aem_id')
                        ->select('em.*','eem.eem_id')
                        ->where('em.aem_status', '!=', 'inactivate')->where('em.aem_status', '!=', 'old')
                        ->where('eem.eem_status', '=', 'active')
                        ->where('em.aem_viewinlist', '=', 'Y')
                        ->where('eem.exhim_id', '=', $brandData->exhim_id)
                        ->orderBy('em.aem_orderby', 'asc');
                         ## All Active Event: List #
                        $evntDetail=$evntSQL->get();
                        
                        ## Current Event ## 
                        $evntSQL->where('em.aem_status', '=', 'current');
                        $currentEventDetail=$evntSQL->first();
                
                
                    }

                }
                
                
                Session::put('profileDetail', $brandData);
                Session::put('evntDetail', $evntDetail);
                Session::put('selectedEvent', $currentEventDetail);
                Session::put('livestatus', $brandData->ebsm_livestatus);
           
               
                if ($brandData->at_id=='8'){
                    //return Redirect::to($url.'/meetings');
                    return Redirect::to($url.'/my-leads');
                    
                }else{
                    return Redirect::to($url.'/my-leads');
                }
           

            }else {
                
                Session::flash('error', "Username & Password do not match");
                return Redirect::to($url.'/');
                
            }
        }

        // attempt to do the login
        if (!empty(Session('session'))) {
              return Redirect::to($url.'/my-leads');
        } else {
            Session::flash('error', "Username & Password do not match");
            return Redirect::to($url.'/');
        }

    }


}

?>
