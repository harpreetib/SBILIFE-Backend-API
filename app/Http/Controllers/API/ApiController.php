<?php

namespace App\Http\Controllers\API;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Auth;

use App\Models\ApiModel;
use App\Models\TreasureGameMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Session;
use Redirect;
Use Exception;

class ApiController extends Controller
{
    
    public function __construct(Request $request) {
        
      $this->baseurl = 'https://'.request()->getHost().config('app.rootFolder').'/admin/';
    }
    
    
    //Before Login Functions
	public function registerUser(Request $request)
	{
	    $res = array();
	    $data = array();
	   
	    $username = request('username');
        $emailId = request('email');
        $mobile = request('mobile');
        $captchacode = request('ccode');
        $client_ip = request()->ip();
	    $bm_id = 83;
	    
	    $validator = Validator::make(['Name' => $username,'Email' => $emailId,'Mobile' => $mobile,'client_ip'=>$client_ip,'bm_id' => $bm_id,'Captcha'=>$captchacode],[
                        'Name' => 'required|min:3|max:16|unique:1_lead_master,lm_fullname',
                        'Email' => 'required|email|unique:1_lead_master,lm_email',
                        'Mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:1_lead_master,lm_mobile',
                        'Captcha' => 'required',
                        'client_ip'=> 'required|unique:1_lead_master,lm_ip',
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] = 'failed';
            $errors = json_decode($validator->messages(),true);
            
            if(array_key_exists('Name',$errors))
            {
                $res['msg'] = $errors['Name'][0];
            }
            else if(array_key_exists('Email',$errors))
            {
                $res['msg'] = $errors['Email'][0];
            }
            else if(array_key_exists('Mobile',$errors))
            {
                $res['msg'] = $errors['Mobile'][0];
            }
            else if(array_key_exists('Captcha',$errors))
            {
                $res['msg'] = 'Fill captcha code to continue.';
            }
            else if(array_key_exists('client_ip',$errors))
            {
                $res['msg'] = 'Try using a different device';
            }
            else
            {
                $res['msg'] = 'Parameter missing or invalid!';
            }
        }
        else
        {
            if(Session('captcha_code')!=$captchacode)
            {
                $res['status'] = 'failed';
                $res['msg'] = 'Please enter valid captcha code';
                return $res;
            }
            else {
                Session::put('captcha_code','');
            }
	    
            $eventData = array();
            $eventData['curevent'] = 'v1';
            $basicData = ApiModel::getEventDetails($eventData);
            $aem_id = 1;
            
            if((isset($username) && !empty($username)) && (isset($emailId) && !empty($emailId)) && (isset($mobile) && !empty($mobile)))
            {
                
                $leadData = DB::table('1_lead_master as lm')
        	        ->select('lemm.*','lm.*')
        	        ->leftJoin('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
        	        ->where('lm.lm_email',$emailId)
        	        ->where('lemm.aem_id',$aem_id)
        	        ->where('lemm.bm_id',$bm_id)
        	        ->first();
        	        
        	    if($leadData)
            	{
            	    $res['msg'] = 'User Already Exist!';
                    $res['status'] = 'failed';
            	 }
            	 else
            	 {  
            	     $unique_id = base64_encode(openssl_random_pseudo_bytes(30));
            	     $lmId = DB::table('1_lead_master')->insertGetId([
        	                'lm_fullname' => $username,
        	                'lm_email' => $emailId,
        	                'lm_mobile' => $mobile,
        	                'lm_unique_id'=>$unique_id,
        	                'lm_ip'=>$client_ip,
        	                'lm_notes' => 'Added By User'
        	            ]);
        	            
            	     $lemmId = DB::table('1_lead_event_master_mapping')->insertGetId([
            	            'lm_id' => $lmId,
            	            'aem_id' => $aem_id,
            	            'bm_id' => $bm_id,
            	            'lemm_disclaimer'=>'N'
            	        ]);
            	        
            	     $attMap = ApiModel::interAttadenceMapping($lmId,$bm_id,$basicData);
            	     
            	     $res['msg'] = 'User Registered Successfully!';   
                     $res['status'] = 'success';
                     $res['emailid'] = $emailId;
                     $res['id'] = Crypt::encrypt($unique_id);
                     
                     $data['exhid'] = 100;
    	             $data['username'] = $emailId;
    	             $data['activeId'] = 4; //Registration
    	             $data['lemm_id'] = $lemmId;
            	     ApiModel::ActivityHere($data);
            	     
            	    $otpStatus = ApiModel::isOTPEnabled($bm_id);
                    if($otpStatus != 'active')
                    {
                        ApiModel::SendMailOTPVerify($emailId);
                        $res['ostatus'] = 'yes';
                    }
            	     
            	    $UserVerificationService = ApiModel::IsServiceEnable('is-user-verify',$bm_id);
                    if($UserVerificationService == 'active')
                    {
                        ApiModel::SendRegisterApprovalMail($emailId);
                    }
            	 }
            }
            else
            {
                $res['msg'] = 'Parameter missing!';
                $res['status'] = 'failed'; 
            }
        }
    	
    	 return $res;
	}
	
	
	public function getCountryCodeList(Request $request)
    {
        
        $countryList = DB::table('master_country')
                        ->Select('counm_code',DB::raw("CONCAT(counm_iso_code, ' (+', counm_code, ')') AS country_name"))
                        ->Where('counm_id','101')
                        ->get();
        return $countryList;
    }
    
    public function sendOTPMail($email)
    {
        
        $response = array();
        
        $validator = Validator::make(['email'=>$email], 
	                [
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            $response['status'] ='failed';
            $response['msg'] ='Parameter missing or invalid';
            return $response;
        }
        else
        {
        
            $listDetail = DB::table('1_lead_master as lm')
                        ->Join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                        ->Select('lm.lm_fullname','lm.lm_email','lm.lm_id')
                        ->where('lm.lm_email',$email)
                        ->first();
                        
            $otp = rand(100000,999999);
            
            if($listDetail)
            {
            
                $email_to = $listDetail->lm_email;
                $mailer_logo = 'https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/mailer-logo.jpg';
                
                try{
                     
                     $response = Mail::send('emailer.otp_verify', ['data' => $listDetail,'otp'=>$otp, 'mailer_logo'=>$mailer_logo], function ($m) use ($email_to) {
                         $m->from('invitation@smartevents.in', 'Induction');
                         $m->to($email_to)->subject("OTP: Login Verification");
                        }); 
                        
                    //echo '<pre>';print_r($response);
                    
                    DB::table('1_lead_master')->where('lm_id',$listDetail->lm_id)->update(['lm_otp'=>$otp]);
                   
                } catch(\Exception $e){
                    echo $e;
                }
            }
        }
    }
    
    public function SendOTPEmailVerify(Request $request)
    {
        $response = array();
        $email = request('email');
        $validator = Validator::make(['email'=>$email],[
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            $response['code'] = 404;
            return $response;
        }
        else
        {
            $resData = ApiModel::SendMailOTPVerify($email);
            $res['code'] = $resData['code'];
        }
        
        return $res;
    }
    
    
    
    public function SetCaptchaCode(Request $request)
    {
        $captchacode = request('ccode');
        Session::put('captcha_code',$captchacode);
        $res['code']=200;
        return $res;
    }
    
    public function verifyOTP(Request $request)
    {
        $res = array();
        $otp = request('otp');
        $email = request('email');
        $bm_id= 83;
        
        $validator = Validator::make(['otp' => $otp,'email' => $email,'bm_id'=>$bm_id],[
                        'otp' => 'required',
                        'email' => 'required|email',
                        'bm_id' => 'required|numeric'
                    ]);
        if($validator->fails())
        {
            $res['status'] ='failed';
            $res['msg'] = 'Parameter missing or invalid';
        }
        else
        {
            $uniqueId = base64_encode(openssl_random_pseudo_bytes(30));
            $detail = DB::table('1_lead_master as lm')
                        ->Join('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
                        ->select('lm.lm_id')
                        ->where('lm.lm_email',$email)
                        ->where('lm.lm_otp',$otp)
                        ->where('lemm.bm_id',$bm_id)
                        ->first();
            
            if($detail)
            {
                $res['status'] = 'success';
                $res['uniq'] = Crypt::encrypt($uniqueId);
                DB::table('1_lead_master')->where('lm_id',$detail->lm_id)->update(['lm_unique_id'=>$uniqueId,'lm_otp'=>null]);
            }
            else
            {
               $res['status'] = 'failed'; 
               $res['msg'] = 'Invalid email or otp!';
            }
        }
        
        return $res;
    }
    
    
    //Validate Brand Id
    public function ValidateBrandId(Request $request)
	{
	    $res = array();
	    $bm_nickname = request('tmp_name');
	    
	    $validator = Validator::make(['tmp_name' => $bm_nickname], [
            'tmp_name' => 'required'
        ]);
        
        if ($validator->fails()) {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid';
        }
        else {
            //Run query
        
    	    $detail = DB::table('brand_organizer_master as bm')
    	                ->Join('customer_data as cd','cd.bm_id','bm.bm_id')
    	                ->Join('1_environment_template_master as etm','etm.etm_id','cd.etm_id')
    	                ->select('cd.etm_id','cd.bm_id','etm.etm_main_scene','cd.cd_color_code','bm.bm_name','cd.ftm_id')
    	                ->where('bm.bm_nickname',str_replace('#','',$bm_nickname))
    	                ->first();
    	    if($detail)
    	    {
    	        $meta_name = $detail->bm_name;
    	        
    	        $featureList = ApiModel::CheckAppFeatureSetting($detail->bm_id);
    	        
    	        $settingData = DB::table('1_homepage_setting')
    	                        ->select('hs_metaverse_name')
    	                        ->where('bm_id',$detail->bm_id)
    	                        ->first();
    	        if($settingData)
    	        {
    	            $meta_name = $settingData->hs_metaverse_name;
    	        }
    	        
    	        $res['bm_id']=Crypt::encrypt($detail->bm_id);
    	        $res['temp_id']=$detail->etm_id;
    	        $res['main_scene']=$detail->etm_main_scene;
    	        $res['color_code']=$detail->cd_color_code;
    	        $res['meta_name']=$meta_name;
    	        $res['feature_list'] = $featureList;
    	        $res['code']=200;
    	    }
    	    else{
    	        $res['code']=404;
    	        $res['code']='Parameter missing or invalid';
    	    }
        }
	    return $res;
	}
    
    //After Login Functions
	public function loginUser(Request $request)
	{
	    $res = array();
        $unique_id = request('email');
        $client_ip = request()->ip();
        $bm_id = 83;
        
        $validator = Validator::make(['unique_id' => $unique_id,'bm_id' => $bm_id],[
                        'unique_id' => 'required',
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid';
        }
        else
        {
            $unique_id = Crypt::decrypt($unique_id);
            $eventData = array();
            $eventData['curevent'] = 'v1';
            $basicData = ApiModel::getEventDetails($eventData);
            $aem_id = 1;
            
            try{
            
    	        $leadData = DB::table('1_lead_master as lm')
        	            ->leftJoin('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
        	            ->leftJoin('1_registration_type_event_master as rtem','lemm.rtem_id','rtem.rtem_id')
        	            ->leftJoin('1_registration_type_master as rtm','rtm.rtm_id','rtem.rtm_id')
        	            ->select('lemm.*','lm.*','rtm.rtm_name')
            	        ->where('lm.lm_unique_id',$unique_id)
            	        ->where('lemm.aem_id',$aem_id)
            	        ->where('lemm.bm_id',$bm_id)
            	        ->first();
            	        
            	if($leadData)
        	    {
        	        $upData = array();
        	        $current_date = date('Y-m-d');
        	        $upData['lm_login_date'] = $current_date;
        	        if(!empty($leadData->lm_ip) && $leadData->lm_ip == $client_ip) {
        	            
        	            if($current_date==$leadData->lm_login_date) {
        	                if($leadData->lm_login_attempts < 5) {
        	                    $upData['lm_login_attempts'] = intval($leadData->lm_login_attempts)+1;
        	                }
        	                else {
        	                    $res['code'] = 404;
        	                    $res['msg'] = 'Max 5 times login allowed per day, try after 24 hours';
        	                    return $res;
        	                }
        	            }
        	            else {
        	                $upData['lm_login_attempts'] = 1;
        	            }
        	        } else {
        	            $upData['lm_login_attempts'] = 1;
        	            $upData['lm_ip'] = $client_ip;
        	        }
        	        
            	    $UserVerificationService = ApiModel::IsServiceEnable('is-user-verify',$bm_id);
            	    if($UserVerificationService == 'active')
            	    {
            	        if($leadData->is_verified == 'N')
            	        {
            	            $res['code'] = 404;
            	            $res['msg'] = 'User Verification Pending...';
            	            return $res;
            	        }
            	    }
            	    $attMap = ApiModel::interAttadenceMapping($leadData->lm_id,$bm_id,$basicData);
                    $res['code'] = 200;
                    $res['user_id'] = Crypt::encrypt($leadData->lemm_id);
                    $res['username'] = $leadData->lm_fullname;
                    $res['email_id'] = $leadData->lm_email;
                    $res['avatar_type'] = $leadData->lemm_avatar_type;
                    $res['avatar_url'] = $leadData->lemm_avatar_url;
                    
                    $rndnumber = base64_encode(openssl_random_pseudo_bytes(30));
                    $uuid = Crypt::encrypt($rndnumber);
                    $res['uuid'] = $uuid;
                    $upData['lm_token_id'] = $rndnumber;
                    $upData['lm_otp'] = null;
                    
                    ApiModel::UpdateLeadDataById($leadData->lm_id,$upData);
                    
            	 }
            	 else
            	 {
            	    $res['code'] = 404;
            	    $res['msg'] = 'Invalid Access Denied, Try Again!';
            	    return $res;
            	 }
            	        
            } catch(\Exception $e){
                //echo $e;
                $res['msg'] = 'Invalid Access Denied, Try Again!';
                $res['code'] = 404;
                return $res;
            }
         }
    	 return $res;
	}
	
	
	public function GuestUserLogin(Request $request)
	{
	    $eventData = array();
        $eventData['curevent'] = 'v1';
        $basicData = ApiModel::getEventDetails($eventData);
        $client_ip = request()->ip();
        $email = 'guest'.rand(10000,9999).'@ib.com';
        $aem_id = 1;
        $bm_id=83;
        
        try{
            $unique_id = base64_encode(openssl_random_pseudo_bytes(30));
    	    $lmId = DB::table('1_lead_master')->insertGetId([
                    'lm_fullname' => 'Guest',
                    'lm_email' => $email,
                    'lm_unique_id'=>$unique_id,
                    'lm_ip'=>$client_ip,
                    'lm_notes' => 'Added As Guest'
                ]);
                
    	    $lemmId = DB::table('1_lead_event_master_mapping')->insertGetId([
    	            'lm_id' => $lmId,
    	            'aem_id' => $aem_id,
    	            'bm_id' => $bm_id,
    	            'lemm_disclaimer'=>'N'
    	        ]);
    	        
    	    $attMap = ApiModel::interAttadenceMapping($lmId,$bm_id,$basicData);
            $res['status'] = 'success';
            $res['code'] = 200;
            $res['uniq'] = Crypt::encrypt($unique_id);
        }
        catch(\Exception $e){
            $res['code'] = 404;
            $res['status'] = 'failed';
            $res['msg'] = 'Parameter missing or invalid';
        }
        return $res;
	}
	
	public function CaptureUserActivity(Request $request)
	{
	    $res = array();
	    $data = array();
	    $activity_id = request('activity_id');
	    $username = request('emailId');
	    $exhiId = request('booth_id');
	    $bm_id = Crypt::decrypt(request('bm_id'));
	    $lemm_id = Crypt::decrypt(request('user_id'));
	    
	    $validator = Validator::make(['activity_id' => $activity_id,'emailId' => $username], 
	                [
                        'activity_id' => 'required|numeric',
                        'emailId' => 'required|email',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['status'] ='failed';
            $res['msg'] = 'Parameter Missing Or Invalid';
        }
        else
        {
    	    if(!empty($activity_id) && !empty($username))
    	    {
    	        $data['exhid'] = !empty($exhiId) ? $exhiId : 100;
    	        $data['username'] = $username;
    	        $data['activeId'] = $activity_id;
    	        $data['lemm_id'] = $lemm_id;
    	        $data['bm_id'] = $bm_id;
    	        
    	        $respArray=ApiModel::ActivityHere($data);
    	        
    	        if(isset($respArray['action']) && $respArray['action'] == 'insert')
    	        {
    	            $res['msg'] = 'Activity captured successfully!';
    	            $res['status'] = 'success';
    	            $res['code'] = 200;
    	        }
    	        else
    	        {
    	            $res['code'] = 200;
    	            $res['status'] = 'success';
    	            $res['msg'] = 'Already Captured';
    	        }
    	    }
    	    else
    	    {
    	        $res['code'] = 404;
    	        $res['status'] = 'failed';
    	        $res['msg'] = 'Invalid activity denied';
    	    }
        }
	    return $res;
	}
    
    function updateAvatarUrl(Request $requst)
    {
        $response = array();
        
        $bm_id = Crypt::decrypt(request('bm_id'));
        $lemm_id = Crypt::decrypt(request('user_id'));
        $type = request('avatar_type');
        $avatar_url = request('avatar_url');
        
        $validator = Validator::make(['user_id' => $lemm_id,'bm_id'=>$bm_id,'avatar_type' => $type,'avatar_url'=>$avatar_url], 
	                [
                        'user_id' => 'required',
                        'bm_id' => 'required',
                        'avatar_type' => 'required',
                        'avatar_url' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
            $res['msg'] = 'Parameter missing or invalid';
        }
        else
        {
            $check = DB::table('1_lead_master as lm')
                    ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                    ->where('lemm.lemm_id',$lemm_id)
                    ->where('lemm.bm_id',$bm_id)
                    ->select('lemm.lemm_id')
                    ->first();
                    
            if($check)
            {
                DB::table('1_lead_event_master_mapping')->where('lemm_id',$check->lemm_id)->update(['lemm_avatar_type'=>$type,'lemm_avatar_url'=>$avatar_url]);
                $response['status']='success';
            }
            else
            {
                $response['status']='failed';
            }
        }
        return $response;
    }
    
    
    
    public function getAppId(Request $request)
    {
        $res = array();
        $bm_id = Crypt::decrypt(request('bm_id'));
        $validator = Validator::make(['bm_id' => $bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid';
        }
        else
        {
            $appDetails = DB::table('1_app_setting_master')->select('asm_name as app_name','asm_app_id as app_id')->where('bm_id',$bm_id)->first();
            $res['code'] = 200;
            $res['app_detail'] = $appDetails;
        }
        return $res;
    }
    
    public function getGroundScalling(Request $request)
    {
        
        $res = array();
        $ptype = empty(request('platformtype')) ? 'webgl' : request('platformtype');
        $sceneurl = $this->baseurl.'public/assets/scene/'.strtolower($ptype).'/';
        $bm_id = Crypt::decrypt(request('bm_id'));
        
        $validator = Validator::make(['platform_type'=>$ptype,'bm_id' => $bm_id],[
                        'platform_type' => 'required',
                        'bm_id' => 'required|numeric'
                    ]);
        if($validator->fails())
        {
            $res['code'] = 404;
			$res['msg'] = 'Parameter missing or invalid';
            return $res;
        }
        else
        {
        
            $groundDetails = DB::table('1_scene_master as sm')
                            ->join('1_ground_scalling as gs','sm.sm_id','gs.sm_id')
                            ->select(DB::raw('CONCAT("'.$sceneurl.'", gs_asset_uri) AS assetURl'),'gs_asset_prefab_name as assetPrefabName','gs_position','gs_rotation','gs_scale')
                            ->where('gs_status','active')
                            ->where('sm.sm_name',request('scenename'))
                            ->where('gs.gs_platform_type',$ptype)
                            ->get();
                            
            $j=0;                  
            foreach($groundDetails as $groundDetail)
            {        
                $res['GroundScaling'][$j]['assetURl'] = $groundDetail->assetURl;
                $res['GroundScaling'][$j]['assetPrefabName'] = $groundDetail->assetPrefabName;
                $res['GroundScaling'][$j]['position'] = json_decode($groundDetail->gs_position,true);
                $res['GroundScaling'][$j]['rotation'] = json_decode($groundDetail->gs_rotation,true);
                $res['GroundScaling'][$j]['scale'] = json_decode($groundDetail->gs_scale,true);
                
                $j++;
            }
            
            $res['code'] = 200;
            
           return $res;
        }
    }
    
    public function GetHomePageSettingData(Request $request)
    {
       $res = array();
       $bm_id = Crypt::decrypt(request('bm_id'));
       $validator = Validator::make(['bm_id' => $bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid';
        }
        else
        {
            $res['code'] = 200;
            $fileurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
            $btnimgurl = $this->baseurl.'public/assets/images/';
            $res['data'] = DB::table('1_homepage_setting')
                        ->select(
                            DB::raw('CONCAT("'.$fileurl.'", ehc_hall_bgimage) AS bg_image'),
                            DB::raw('CONCAT("'.$fileurl.'", hp_video) AS bg_video'),
                            DB::raw('CONCAT("'.$btnimgurl.'", btn_img) AS btn_img'),
                            'ehc_color_code as form_color_code',
                            'hp_type as file_type',
                            'btn_color','is_btn','btn_opacity'
                            )
                        ->where('bm_id',$bm_id)
                        ->first();
        }
        return $res; 
    }
	
	public function GetMenuList(Request $request)
	{
	   $res = array();
	   $bm_id = Crypt::decrypt(request('bm_id'));
	   
	   $validator = Validator::make(['bm_id' => $bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid';
        }
        else
        {
	   
    	   $Menulist = DB::table('1_environment_template_menu_list as em')
    	                ->Join('customer_data as cd','cd.etm_id','em.etm_id')
    	                ->select('em.em_menu_name as name','em.em_order_by as order','em.em_menu_id as unique_id')
    	                ->where('em.em_status','active');
    	                
    	   if($Menulist->where('cd.bm_id',$bm_id)->count() > 0)
    	   {
    	     $Menulist = $Menulist->where('cd.bm_id',$bm_id)->orderBy('em.em_order_by','asc')->get();
    	   }
    	   else{
    	       $Menulist = DB::table('1_menu_default_list as mdl')
    	                    ->select('mdl.msm_name as name','mdl.msm_order_by as order','mdl.msm_unique_id as unique_id')
    	                    ->orderBy('mdl.msm_order_by','asc')
    	                    ->get();
    	   }
    	   
    	   $res['code'] = 200;
    	   $res['menu_items'] = $Menulist;
        }
	    return $res;
	}
	
	
	public function logoutUser(Request $request)
    {
        $bm_id = Crypt::decrypt(request('bm_id'));
        $lemm_id = Crypt::decrypt(request('user_id'));
        $validator = Validator::make(['user_id' => $lemm_id,'bm_id'=>$bm_id],[
                        'user_id' => 'required',
                        'bm_id' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['status'] ='failed';
            $res['msg'] = 'Parameter missing or invalid';
        }
        else
        {
            $eventData = array();
            $eventData['curevent'] = 'v1';
            $basicData = ApiModel::getEventDetails($eventData);
            $aem_id = 1;
        
            $leadData = DB::table('1_lead_master as lm')
        	        ->select('lm.lm_id')
        	        ->leftJoin('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
        	        ->where('lemm.lemm_id',$lemm_id)
        	        ->where('lemm.bm_id',$bm_id)
        	        ->where('lemm.aem_id',$aem_id)
        	        ->first();
        	        
            if($leadData)
            {
                $res['code'] = 200;
               $res['status']='success';
               $res['msg'] = 'Logged out successfully!';
               DB::table('1_lead_master')->where('lm_id',$leadData->lm_id)->update(['lm_unique_id'=>null]);
            }
            else
            {
                $res['msg'] = 'Parameter missing or invalid';
                $res['status']='failed';
                $res['code'] = 404;
            }
        }
        
        return $res;
    }
    
    public function GetConvaiSettingData(Request $request)
    {
        $bm_id = Crypt::decrypt(request('bm_id'));
        $validator = Validator::make(['bm_id'=>$bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
        if($validator->fails())
        {
            $res['code'] = 404;
			$res['msg'] = 'Parameter missing or invalid';
            return $res;
        }
        else
        {
            $response = ApiModel::GetConvaiSettingData($bm_id);
            return $response;
        }
    }
    
    public function GetTotalRegisteredUser(Request $request) 
    {
        $bm_id=Crypt::decrypt(request('bm_id'));
        $validator = Validator::make(['bm_id'=>$bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid';
            return $res;
        }
        else
        {
            $totalLeadData = DB::table('1_lead_master as lm')
            	            ->leftJoin('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
            	            ->leftJoin('1_registration_type_event_master as rtem','lemm.rtem_id','rtem.rtem_id')
            	            ->leftJoin('1_registration_type_master as rtm','rtm.rtm_id','rtem.rtm_id')
            	            ->select('lemm.*','lm.*','rtm.rtm_name')
                	        //->whereRaw("find_in_set('".$bm_id."',lemm.bm_id)")
                	        ->where('lemm.bm_id',$bm_id)
                	        ->count();
            return $totalLeadData;
        }
    }
    
    public function GetUserActivityList(Request $request)
    {
        $bm_id=Crypt::decrypt(request('bm_id'));
        $validator = Validator::make(['bm_id'=>$bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails()) 
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid';
            return $res;
        }
        else 
        {
            $activityList =DB::table('1_lead_master as lm')
                            ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                            ->join('1_lead_event_exhibitor_mapping as leem', 'leem.lemm_id','lemm.lemm_id')
                            ->join('1_lead_event_exhibitor_mapping_activity as leema', 'leema.leem_id','leem.leem_id')
                            ->join('1_activity_master as am','leema.am_id','am.am_id')
                            ->select('lm.lm_fullname','am.am_text','am.am_md_text as jointext','am.pre_text')
                            ->orderBy('leema.leema_id','desc')
                            //->whereRaw("find_in_set('".$bm_id."',lemm.bm_id)")
                            ->where('lemm.bm_id',$bm_id)
                            ->limit(10)
                            ->get();
                            
            return $activityList;
        }
        
    }
    
    public function GetDashboardSettingData(Request $request)
    {
        $bm_id = $request->bm_id;
        $fileurl = $this->baseurl . 'public/assets/images/dashboard/';
        
        $validator = Validator::make(['bm_id'=>$bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid';
            return $res;
        }
        else{
            $dashboardData = DB::table('1_dashboard_setting_master as dsm')
                            ->select(
                                DB::raw('CONCAT("' . $fileurl . '", dsm.logo) AS logo'),
                                DB::raw('CONCAT("' . $fileurl . '", dsm.background_img) AS bgimg'),
                                'title','news_text as newsfeed','short_title as slug')
                            ->where('bm_id',$bm_id)
                            ->first();
            return $dashboardData;
        }
    }
    
    
    public function GetSbilifeData(Request $request)
    {
        $res = array();
        $fileurl = $this->baseurl . 'public/assets/videos/wall/';
        
        $sbiData = DB::table('1_getsbi_data as gsd')
                        ->select( DB::raw('CONCAT("' . $fileurl . '", gsd.gsd_file) AS filename'))
                        ->orderby('gsd_orderby','asc')
                        ->get();
                        
        $i=0;
        $res['code']=200;
        foreach($sbiData as $data)
        {
            $res['videourl'][$i] = $data->filename;
            $i++;
        }
                        
        return $res;
    }
    
    public function GetSpeakerList(Request $request)
    {
        $res = array();
        $fileurl = $this->baseurl . 'public/assets/images/speakers/';
        $speakerList = DB::table('1_speaker_master as sm')
                        ->select(DB::raw('CONCAT("'.$fileurl . '", sm.sm_image) AS speaker_image'),'sm_id','sm_name')
                        ->where('sm_status','active')
                        ->orderby('sm_orderby','desc')
                        ->get();
                        
        $res['code']=200;
        foreach($speakerList as $key => $data)
        {
            $res['speakerList'][$key]['id'] = $data->sm_id;
            $res['speakerList'][$key]['speaker_name'] = $data->sm_name;
            $res['speakerList'][$key]['speaker_image'] = $data->speaker_image;
        }
            
        return $res;    
    }
    
    public function GetSpeakerDataById(Request $request)
    {
        $res = array();
        $sm_id = $request->sm_id;
        
        $validator = Validator::make(['sm_id'=>$sm_id],[
                        'sm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter missing or invalid!';
            return $res;
        }
        
        $fileurl = $this->baseurl . 'public/assets/videos/speakers/'.$sm_id.'/';
        $speakerData = DB::table('1_speaker_master_mapping as smm')
                        ->where('sm_id',$sm_id)
                        ->where('smm_status','active')
                        ->select('smm_orderby','smm_title as title',DB::raw('CONCAT("'.$fileurl . '", smm.smm_video) AS video_url'))
                        ->get();
                        
        foreach($speakerData as $key => $data)
        {
            $res['speaker_data'][$key]['order'] = $data->smm_orderby;
            $res['speaker_data'][$key]['title'] = $data->title;
            $res['speaker_data'][$key]['video_url'] = $data->video_url;
        }
        $res['code']=200; 
        return $res; 
                        
    }
}