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
    
    public static function curlOperations($options)
    {
        $ch = curl_init(config('app.daily_url') . "{$options['url']}");
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer '.config('app.daily_app_key'),
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, isset($options['headers']) ? $options['headers'] : $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POST, isset($options['type']) && $options['type'] === 'POST' ? true : false);

        if ($options['type'] && $options['type'] === 'POST') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $options['data']);
        }

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function createRoomMeeting($request)
    {

         $random_name = rand(100000, 999999);
        
        $name=$request->exhim_id.'BHIVE'.$random_name.$request->lemm_id;
        

        // $time=explode(' - ',$request->meeting_time);
        // $new_time=date('H:i',strtotime('-5 hour -30 minutes',strtotime($time[0])));
        //  $new_time=date('H:i',strtotime($time[0]));
        // $nbf=$request->meeting_date.' '.$new_time.':00';
        
      
        // $utc_nbf =strtotime(date('Y-m-d H:i:s',strtotime($nbf)));
      
        //  $exp='2021-03-16 17:50:00';
        // $utc_exp = gmdate("d-m-Y H:i:s", strtotime($exp));
        
        // $max_meet_time="900";
       
        /* Create Room Meta */
        $Room = array(
            
            "properties" => array(
                "max_participants" => "10",
                "enable_chat"=>true,
                "autojoin"=>true,
               // "nbf"=>"$utc_nbf",
               // "eject_after_elapsed"=>"$max_meet_time"
                
            ),
            "name" => "$name",
             "privacy"=>"private"
            //"privacy"=>"public"
            
        );

        $Room_Meta = json_encode($Room);
        
        $response = ApiController::curlOperations(['type' => 'POST', 'url' => 'rooms', 'data' => $Room_Meta]);
        return response(json_decode($response,TRUE));

    }
    
     
    public function getRoom(Request $request)
    {
        $roomId = $request->route('room');
        if (!$roomId) {
            $error = Errors::getError(4001);
            $error["desc"] = "Failed to get roomId from URL";
            return response()->json($error);
        }

        $response = $this->curlOperations(['type' => 'GET', 'url' => "/rooms/" . $roomId]);
        return response($response);
    }
    public function GetParticipantList(Request $request)
    {

        $roomId = $request->route('roomId');
        if (!$roomId) {
            $error = Errors::getError(4001);
            $error["desc"] = "Failed to get roomId from URL";
            return response()->json($error);
        }

        $response = $this->curlOperations(['type' => 'GET', 'url' => "/rooms/" . $roomId."/users"]);
        $userlist=json_decode($response,TRUE) ;

$html="";
        $html="<p class='text-center'><strong>Total Participants : (".$userlist['total'].")</strong><hr><p/>";
          foreach ($userlist['users'] as  $value) {
            $html .="<li>".ucwords($value['name']);

                if($value['role']=='moderator'){
                  $html .=" (Councellor) ";
                }
            $html .="<a href='#'  onclick='muteparticipantaudio(`".$value['clientId']."`)'  ><span id='".$value['clientId']."_audio' class='p-5 text-right' >";
if($value['audioMuted']==true){
  $html .="<i class='fa fa-microphone-slash'></i>";
}else{
  $html .="<i class='fa fa-microphone'></i>";
}

   $html .="</span></a><a href='#' onclick='muteparticipantvideo(`".$value['clientId']."`)' ><span id='".$value['clientId']."_video' class='p-5 text-right' >";
     if($value['videoMuted']==true){
       $html .="<i class='fa fa-stop'></i>";
     }else{
       $html .="<i class='fa fa-video-camera'></i>";
     }
$html .=" </span></a></li><hr>";
          }
          echo $html;
    }

    public static function createTokenMeeting($request,$pdetail)
    {
        



        $time=explode(' - ',$request->meeting_time);
        // $new_time=date('H:i',strtotime('-5 hour -30 minutes',strtotime($time[0])));
         $new_time=date('H:i',strtotime($time[0]));
        $nbf=$request->meeting_date.' '.$new_time.':00';
        
      
        $utc_nbf =strtotime(date('Y-m-d H:i:s',strtotime($nbf)));
        
        
        
          $new_time1=date('H:i',strtotime('+1 minute',strtotime($time[1])));
        $exp=$request->meeting_date.' '.$new_time1.':00';
       
      
        $utc_exp =strtotime(date('Y-m-d H:i:s',strtotime($exp)));



        $Token = array(
            "properties" => array(
                "eject_at_token_exp" => true,
                "room_name"=>"$request->id",
               // "nbf"=>"$utc_nbf",
               // "exp"=>"$utc_exp",
                "user_name"=>"$pdetail->exhim_organization_name",
                "user_id"=>"$pdetail->exhim_id",
                "redirect_on_meeting_exit"=>"https://virtual.mymedex.com.my/admin/exhibitor/mei/Meetingsdata?page=Confirmed"
                
            )
        );

        $Token_Payload = json_encode($Token);

        $response = ApiController::curlOperations(['type' => 'POST', 'url' => "meeting-tokens", 'data' => $Token_Payload]);
        return response($response);

    }

    public function confo(Request $request, $room, $type, $ref)
    {
        return \view('EnxRtc.confo')->with(['roomId' => $room, 'user_ref' => $ref, 'usertype' => $type]);
    }
    
    
    #### Boothstaff Create Room ####
    public static function createRoom($request)
    {

         $random_name = rand(100000, 999999);
        
        $name=$request->exhim_id.'MegaSpace'.$random_name;
        

  
       
        /* Create Room Meta */
        $Room = array(
            
            "properties" => array(
                "max_participants" => "10",
                "enable_chat"=>true,
                   "enable_prejoin_ui"=> true,
                "enable_knocking"=> true
                
            ),
            "name" => "$name",
            "privacy"=>"private"
            
        );


        $Room_Meta = json_encode($Room);
        
        $response = ApiController::curlOperations(['type' => 'POST', 'url' => 'rooms', 'data' => $Room_Meta]);
        return response(json_decode($response,TRUE));

    }
    
     #### Boothstaff Create Room ####
    public static function createRoomBooth($request)
    {

         $random_name = rand(100000, 999999);
        
        //$name=$request->exhim_id.'MYMEDEX'.$request->lemm_id;
        

        // $time=explode(' - ',$request->meeting_time);
        // $new_time=date('H:i',strtotime('-5 hour -30 minutes',strtotime($time[0])));
        //  $new_time=date('H:i',strtotime($time[0]));
        // $nbf=$request->meeting_date.' '.$new_time.':00';
        
      
        // $utc_nbf =strtotime(date('Y-m-d H:i:s',strtotime($nbf)));
      
        //  $exp='2021-03-16 17:50:00';
        // $utc_exp = gmdate("d-m-Y H:i:s", strtotime($exp));
        
        // $max_meet_time="900";
       
        /* Create Room Meta */
        $Room = array(
            
            "properties" => array(
                "max_participants" => "10",
                "enable_chat"=>true,
                "autojoin"=>true,
               // "nbf"=>"$utc_nbf",
               // "eject_after_elapsed"=>"$max_meet_time"
                
            ),
            "name" => "$random_name",
            // "privacy"=>"private"
            "privacy"=>"public"
            
        );

        $Room_Meta = json_encode($Room);
        
        $response = ApiController::curlOperations(['type' => 'POST', 'url' => 'rooms', 'data' => $Room_Meta]);
        return response(json_decode($response,TRUE));

    }
    
    ###BoothStaff Create Token ###

    public static function createToken($request,$pdetail)
    {
        



         $Token = array(
                        "properties" => array(

                            "room_name"=>"$request->id",
                             "is_owner"=>true,
                            "user_name"=>"$pdetail->exhim_organization_name",
                            "user_id"=>"$pdetail->exhim_id",
                            "redirect_on_meeting_exit"=>"https://virtual.mymedex.com.my/admin/exhibitor/mei/all-leads"
                            
                        )
                    );


        $Token_Payload = json_encode($Token);

        $response = ApiController::curlOperations(['type' => 'POST', 'url' => "meeting-tokens", 'data' => $Token_Payload]);
        return response($response);

    }
    
    public function logoutUser(Request $request)
    {
        $emailId = request('email');
        
        $eventData = array();
        $eventData['curevent'] = 'v1';
        $basicData = ApiModel::getEventDetails($eventData);
        $aem_id = 1;
        
        $leadData = DB::table('1_lead_master as lm')
        	        ->select('lemm.*','lm.*')
        	        ->leftJoin('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
        	        ->where('lm.lm_email',$emailId)->where('lemm.aem_id',$aem_id)
        	        ->first();
        	        
        if($leadData)
        {
           $res['status']='success';
        }
        else
        {
            $res['status']='failed';
        }
        
        return $res;
    }
	
	public function registerUser(Request $request)
	{
	    $res = array();
	    $data = array();
	   
	    $username = request('username');
        $emailId = request('email');
        $mobile = request('mobile');
	    $bm_id = request('bm_id');
	    
	    $validator = Validator::make(['username' => $username,'email' => $emailId,'mobile' => $mobile,'bm_id' => $bm_id],[
                        'username' => 'required',
                        'email' => 'required|email',
                        'mobile' => 'required',
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] = 'failed';
            $res['msg'] = 'Parameter missing or invalid!';
        }
        else
        {
	    
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
            	    //ApiModel::interAttadenceMapping($leadData->lm_id,$bm_id,$basicData);
            	   // DB::table('1_lead_master')
            	   // ->where('lm_email',$leadData->lm_email)
            	   // ->update([
        	       //         'lm_fullname' => $username,
        	       //         'lm_mobile' => $mobile
        	       //     ]);
        	            
            	    $res['msg'] = 'User Already Exist!';
                    $res['status'] = 'failed';
            	 }
            	 else
            	 {  
            	     $unique_id = 'xyz'.rand(10000,999999);
            	     $lmId = DB::table('1_lead_master')->insertGetId([
        	                'lm_fullname' => $username,
        	                'lm_email' => $emailId,
        	                'lm_mobile' => $mobile,
        	                'lm_unique_id'=>$unique_id,
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
                        $this->SendRegisterApprovalMail($emailId);
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
	
	public function loginUser(Request $request)
	{
	    $res = array();
        $emailId = request('email');
        $emailId = Crypt::decrypt($emailId);
        $bm_id = request('bm_id');
        
        $validator = Validator::make(['email' => $emailId,'bm_id' => $bm_id],[
                        'email' => 'required|email',
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] = 'failed';
            $res['msg'] = 'Unique Id does not exist!';
        }
        else
        {
	   
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
            	        //->where('lm.lm_email',$emailId)
            	        ->where('lm.lm_unique_id',$emailId)
            	        ->where('lemm.aem_id',$aem_id)
            	        ->where('lemm.bm_id',$bm_id)
            	        ->first();
            	        
            	if($leadData)
        	    {
            	    $UserVerificationService = ApiModel::IsServiceEnable('is-user-verify',$bm_id);
            	    if($UserVerificationService == 'active')
            	    {
            	        if($leadData->is_verified == 'N')
            	        {
            	            $res['status'] = 'failed';
            	            $res['msg'] = 'User Verification Pending...';
            	            return $res;
            	        }
            	    }
            	    $attMap = ApiModel::interAttadenceMapping($leadData->lm_id,$bm_id,$basicData);
                    $res['status'] = 'success';
                    $res['user_id'] = $leadData->lemm_id;
                    $res['username'] = $leadData->lm_fullname;
                    $res['email_id'] = $leadData->lm_email;
                    $res['user_verified'] = $leadData->is_verified=='Y' ? 'yes' : 'no';
                    $res['avatar_type'] = $leadData->lemm_avatar_type;
                    $res['user_type'] = $leadData->lm_user_type;
                    $res['avatar_url'] = $leadData->lemm_avatar_url;
                    $res['mic_enable'] = $leadData->is_conference_mic_enable;
                    $res['company_name'] = $leadData->lm_company_name;
                    $res['designation'] = $leadData->lm_designation;
                    $res['avatarsdkId'] = $leadData->lm_avatarsdk_id;
                    $res['imageurl'] = !empty($leadData->lm_imgurl) ? $this->baseurl.$leadData->lm_imgurl : null;
                    $res['is_treasure_hunt'] = ApiModel::GetTreasureHuntStatusById($bm_id,$leadData->lemm_id);
                    
                    $service_status = ApiModel::IsServiceEnable('journey-video',$bm_id);
                    $res['is_journey_enable'] = $service_status=='active' ? 'yes' : 'no';
                    if($service_status == 'active')
                    {
                      $res['journey_video_url'] = ApiModel::GetJourneyVideoURL($bm_id);  
                    }
                    
                    $otpStatus = ApiModel::isOTPEnabled($bm_id);
                    if($otpStatus == 'active')
                    {
                        //$this->SendOTPMail($emailId);
                        $res['otp_status'] = 'active';
                    }
                    else{
                        $res['otp_status'] = 'inactive';
                    }
            	 }
            	 else
            	 {
            	    $res['status'] = 'failed';
            	    $res['msg'] = 'Please enter valid unique id!';
            	    return $res;
            	 }
            	        
            } catch(\Exception $e){
                //echo $e;
                $res['msg'] = 'Please enter valid unique id!';
                $res['status'] = 'failed';
                return $res;
            }
        	 
         }
    	 return $res;
	}
	
	public function getBoothList(Request $request)
	{
	    $res = array();
	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
	    $exhiList = DB::table('1_exhibitor_master as em')
	                ->join('1_exhibitor_boothstaff as eb','em.exhim_id','eb.exhim_id')
	                ->join('1_exhibitor_event_mapping as eem','em.exhim_id','eem.exhim_id')
	                ->join('1_exhibitor_hall_category as ehc','eem.ehc_id','ehc.ehc_id')
	                ->select('em.exhim_id as booth_id','eb.ebsm_name as booth_name',
	                'eem.eem_stall_number as stall_number','eem.ehc_id as hall_number','ehc.ehc_hall_name as hall_name',
	                'eb.ebm_login_user as booth_email',
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_brochure) AS brochure'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_stall_video) AS video'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_stall_backdropofvideo) AS stall_video_img'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_logo) AS logo'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_standee) AS banner_1'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_standee2) AS banner_2'),
	                'em.exhim_rpm_link as booth_avatar_url')
	                ->where('exhim_status','active')
	                ->where('eb.at_id',3)
	                ->get();
	    
	    $res['booth_list'] = $exhiList;
	    $res['status'] = 'success';
	    
	    return $res;
	}
	
	public function getBoothListByHallId(Request $request)
	{
	    $res = array();
	    
	    $hall_id = request('hall_id');
	    $validator = Validator::make(['hall_id' => $hall_id], 
	                [
                        'hall_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
    	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
    	    $exhiList = DB::table('1_exhibitor_master as em')
    	                ->join('1_exhibitor_boothstaff as eb','em.exhim_id','eb.exhim_id')
    	                ->join('1_exhibitor_event_mapping as eem','em.exhim_id','eem.exhim_id')
    	                ->join('1_exhibitor_hall_category as ehc','eem.ehc_id','ehc.ehc_id')
    	                ->select('em.exhim_id as booth_id','eb.ebsm_name as booth_name','eem.eem_stall_number as stall_number','eem.ehc_id as hall_number','ehc.ehc_hall_name as hall_name','eb.ebm_login_user as booth_email',
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_brochure) AS brochure'),
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_stall_video) AS video'),
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_stall_backdropofvideo) AS stall_video_img'),
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_logo) AS logo'),
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_standee) AS banner_1'),
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_standee2) AS banner_2'),
    	                'em.exhim_rpm_link as booth_avatar_url',
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_audio_clip) AS avatar_audio_url'),
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_logo) AS booth_minilogo'),
    	                'em.exhim_booth_func as booth_functionality','em.exhim_isib_booth as booth_isibentos',
    	                DB::raw('CONCAT("'.$imageurl.'", exhim_stall_video) AS full_screen_video'),
    	                DB::raw('CONCAT("'.$imageurl.'", green_screen_video) AS green_screen_video'),
    	                'is_green_screen_enabled','enq_text_color','enq_bgcolor',
    	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_brochure) AS pitch_deck'))
    	                ->where('exhim_status','active')
    	                ->where('eb.at_id',3)
    	                ->where('em.exhim_id','!=',71)
    	                ->where('ehc.ehc_id',$hall_id)
    	                ->get();
    	    
    	    $res['booth_list'] = $exhiList;
    	    $res['status'] = 'success';
        }
	    return $res;
	}
	
	
	public function getMainBoothDetails(Request $request)
	{
	    $res = array();
	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
	    $exhiList = DB::table('1_exhibitor_master as em')
	                ->join('1_exhibitor_boothstaff as eb','em.exhim_id','eb.exhim_id')
	                ->join('1_exhibitor_event_mapping as eem','em.exhim_id','eem.exhim_id')
	                ->join('1_exhibitor_hall_category as ehc','eem.ehc_id','ehc.ehc_id')
	                ->select('em.exhim_id as booth_id','eb.ebsm_name as booth_name','eem.eem_stall_number as stall_number','eem.ehc_id as hall_number','ehc.ehc_hall_name as hall_name','eb.ebm_login_user as booth_email',
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_brochure) AS brochure'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_stall_video) AS video'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_stall_backdropofvideo) AS stall_video_img'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_logo) AS logo'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_standee) AS banner_1'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_standee2) AS banner_2'),
	                'em.exhim_rpm_link as booth_avatar_url',
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_audio_clip) AS avatar_audio_url'),
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_logo) AS booth_minilogo'),
	                'em.exhim_booth_func as booth_functionality','em.exhim_isib_booth as booth_isibentos',
	                DB::raw('CONCAT("'.$imageurl.'", exhim_stall_video) AS full_screen_video'),
	                DB::raw('CONCAT("'.$imageurl.'", green_screen_video) AS green_screen_video'),
	                'is_green_screen_enabled','enq_text_color','enq_bgcolor',
	                DB::raw('CONCAT("'.$imageurl.'", em.exhim_brochure) AS pitch_deck'))
	                ->where('exhim_status','active')
	                ->where('eb.at_id',3)
	                ->where('em.exhim_id',71)
	                //->where('ehc.ehc_id',$hall_id)
	                ->get();
	    
	    $res['booth_list'] = $exhiList;
	    $res['status'] = 'success';
	    
	    return $res;
	}
	
	public function getBoothImages(Request $request)
	{
	    $res = array();
	    
	    $exhim_id = request('booth_id');
	    $validator = Validator::make(['booth_id' => $exhim_id], 
	                [
                        'booth_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
    	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
    	    
    	    $exhiList = DB::table('1_exhibitor_gallery')
            	    ->Select(DB::raw('CONCAT("'.$imageurl.'", eg_name) AS filename2'),'eg_name as filename')
            	    ->where('exhim_id',$exhim_id)
            	    ->where('eg_type','image')
            	    ->where('eg_status','active')
            	    ->get();
    	    
    	    $res['booth_images'] = $exhiList;
    	    $res['status'] = 'success';
        }
	    return $res;
	}
	
	public function getBoothVideos(Request $request)
	{
	    $res = array();
	    
	    $exhim_id = request('booth_id');
	    $validator = Validator::make(['booth_id' => $exhim_id], 
	                [
                        'booth_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
    	    $exhiList = DB::table('1_exhibitor_gallery')
                	    ->Select('eg_name as filename')
                	    ->where('exhim_id',$exhim_id)
                	    ->where('eg_type','video')
                	    ->get();
    	    
    	    $res['booth_videos'] = $exhiList;
    	    $res['status'] = 'success';
        }
	    
	    return $res;
	}
	
	
	public function getBoothStaff(Request $request)
	{
	    $res = array();
	    
	    $exhim_id = request('booth_id');
	    $validator = Validator::make(['booth_id' => $exhim_id], 
	                [
                        'booth_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
	    
    	    $exhiList = DB::table('1_exhibitor_boothstaff as eb')
    	                ->Join('1_exhibitor_event_with_boothstaff_mapping as eewbm','eewbm.ebsm_id','eb.ebsm_id')
    	                //->Select('ebsm_name as username','ebsm_mobile as mobile')
    	                ->Select('ebsm_name as username',DB::raw("CONCAT(ebsm_country_code, ebsm_mobile) AS mobile"))
    	                ->where('eb.exhim_id',$exhim_id)
    	                ->where('eb.at_id','4')
    	                ->where('eewbm.pps_id',2)
    	                ->get();
    	    
    	    $res['booth_staff'] = $exhiList;
    	    $res['status'] = 'success';
        }
	    
	    return $res;
	}
	
	public function getBoothProductList(Request $request)
	{
	    $res = array();
	    $data = array();
	    
	    $exhim_id = request('booth_id');
	    
	    $validator = Validator::make(['booth_id' => $exhim_id], 
	                [
                        'booth_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
        
    	   $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
    	   $exhiList = DB::table('1_exhibitor_product_master as exhipm')
    	                ->Join('1_exhibitor_product_mapping as epm', 'exhipm.exhipm_id','epm.exhipm_id')
    	                ->Select('exhipm.epm_text','epm.epm_id','epm.epm_additional_details','epm.epm_property_owner','epm.epm_property_location','epm.epm_area','epm.epm_total_price',
    	                DB::raw('CONCAT("'.$imageurl.'", epm.epm_brochure) AS epm_brochure'),
    	                DB::raw('CONCAT("'.$imageurl.'", epm.product_image) AS product_image'))
    	                ->where('epm.exhim_id',$exhim_id)->where('epm.epm_status','active')->get();
    	     
    	   $i=0;           
    	   foreach($exhiList as $exhi)
    	   {
    	       $data[$i]['productname'] = $exhi->epm_text;
    	       $data[$i]['product_id'] = $exhi->epm_id;
    	       $data[$i]['description'] = $exhi->epm_additional_details;
    	       $data[$i]['owner'] = $exhi->epm_property_owner;
    	       $data[$i]['location'] = $exhi->epm_property_location;
    	       $data[$i]['area'] = $exhi->epm_area;
    	       $data[$i]['amount'] = $exhi->epm_total_price;
    	       $data[$i]['brochure'] = $exhi->epm_brochure;
    	       $data[$i]['image_1'] = $exhi->product_image;
    	       $data[$i]['total_image'] = $this->getGallaryCount($exhim_id,$exhi->epm_id,'image');
    	       $data[$i]['total_video'] = $this->getGallaryCount($exhim_id,$exhi->epm_id,'video');
    	       $i++;
    	   }
    	    
    	    $res['booth_products'] = $data;
    	    $res['status'] = 'success';
        }
	    return $res;
	}
	
	private function getGallaryCount($exhim_id,$epmId,$type)
	{
	    $count = DB::table('1_exhibitor_gallery')
        	    ->where('exhim_id',$exhim_id)
        	    //->where('epm_id',$epmId)
        	    ->where('eg_type',$type)
        	    ->where('eg_status','active')
        	    ->count();
	    return $count;
	}
	
	public function getVideoMeeting(Request $request)
	{
	    $res = array();
	    $exhim_id = request('booth_id');
	    
	    $validator = Validator::make(['booth_id' => $exhim_id], 
	                [
                        'booth_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
    	    $leadList=DB::table('1_exhibitor_boothstaff as ebs')
                        ->Join('1_exhibitor_event_mapping as eem','ebs.exhim_id', 'eem.exhim_id')
                        ->Join('1_exhibitor_event_with_boothstaff_mapping as eewbm',function($join){
                            $join->on('eem.eem_id', 'eewbm.eem_id')
                               ->on('ebs.ebsm_id','eewbm.ebsm_id')
                               ->where('pps_id','1');
                        })
                        ->select('ebsm_name as username','eewbm_video_url as meeting_link')
                        ->where('at_id','4')
                        ->where('ebs.exhim_id',$exhim_id)
                        ->get();
                        
            $res['boothstaff_meeting'] = $leadList;
            $res['status']='success';
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
	    $bm_id = request('bm_id');
	    $lemm_id = request('user_id');
	    
	    $validator = Validator::make(['activity_id' => $activity_id,'emailId' => $username,'booth_id'=>$exhiId], 
	                [
                        'activity_id' => 'required|numeric',
                        'emailId' => 'required|email',
                        'booth_id' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
            $res['msg'] = 'Parameter Missing Or Invalid';
        }
        else
        {
    	    if(!empty($activity_id) && !empty($username))
    	    {
    	        $data['exhid'] = !empty($exhiId) ? $exhiId : 1;
    	        $data['username'] = $username;
    	        $data['activeId'] = $activity_id;
    	        $data['lemm_id'] = $lemm_id;
    	        $data['bm_id'] = $bm_id;
    	        
    	        $respArray=ApiModel::ActivityHere($data);
    	        
    	        if(isset($respArray['action']) && $respArray['action'] == 'insert')
    	        {
    	            $res['msg'] = 'Captured';
    	            $res['status'] = 'success';
    	        }
    	        else
    	        {
    	            $res['status'] = 'success';
    	            $res['msg'] = 'Already Captured';
    	        }
    	    }
    	    else
    	    {
    	        $res['status'] = 'failed';
    	    }
        }
	    return $res;
	}
	
	
	public function checkExhibitorByEmailId(Request $request)
	{
	    $res = array();
	   
        $uniqueid = request('uniqueid');
        
        $validator = Validator::make(['uniqueid' => $uniqueid], 
	                [
                        'uniqueid' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
        
            $emailId = base64_decode($uniqueid);
    	   
    	    $leadData = DB::table('1_exhibitor_master as em')
    	                    ->join('1_exhibitor_boothstaff as ebsm','em.exhim_id','ebsm.exhim_id')
        	                ->select('ebsm.ebsm_name','em.exhim_id')
        	                ->where('ebsm.ebm_login_user',$emailId)
        	                ->first();
        	        
        	 if($leadData)
        	 {
        	    $res['username'] = $leadData->ebsm_name;
        	    $res['booth_id'] = $leadData->exhim_id;
        	    $res['booth_email'] = $emailId;
                $res['status'] = 'success';
        	 }
        	 else
        	 {
        	    $res['status'] = 'failed';
        	 }
        }
    	return $res;
	}
	
	public function getAllBanners(Request $request)
	{
	    $res = array();
	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
	    $exhiList = DB::table('1_banner_master as bm')
	                ->join('1_banner_category_master as bcm','bm.bcm_id','bcm.bcm_id')
	                ->select(DB::raw('CONCAT("'.$imageurl.'", bm.bm_banner) AS banner'),'bm.bcm_id as category_id','bcm.bcm_name as category_name')
	                ->get();
	    
	    $res['banner_list'] = $exhiList;
	    $res['status'] = 'success';
	    
	    return $res;
	}
	
	public function getProjectGallaryList(Request $request)
	{
	    $exhim_id = request('booth_id');
	    $epm_id = request('project_id');
	    $type = request('type');
	    
	    $validator = Validator::make(['booth_id' => $exhim_id,'project_id' => $epm_id,'type'=>$type], 
	                [
                        'booth_id' => 'required|numeric',
                        'project_id' => 'required',
                        'type' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
    	    $gallaryList = DB::table('1_exhibitor_gallery as eg')
    	                    ->select('eg.eg_name as filename')
    	                    ->where('eg.exhim_id',$exhim_id)
    	                    ->where('eg.epm_id',$epm_id)
    	                    ->where('eg.eg_type',$type)
    	                    ->where('eg_status','active')
    	                    ->get();
    	                    
    	    $res['gallary'] = $gallaryList;
    	    $res['status'] = 'success';
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
    
    public function getUserRegistrationData(Request $request)
    {
        $res = array();
        $res['country_code'] = DB::table('master_country')
                                ->Select('counm_code',DB::raw("CONCAT(counm_iso_code, ' (+', counm_code, ')') AS country_name"))
                                ->Where('counm_id','101')
                                ->get();
                                
        $res['user_type'] = DB::table('1_user_type_master')->Select('utm_id as type_id','utm_name as type')->where('utm_status','active')->get();
        return $res;
    }
    
    public function SendRegisterApprovalMail($email)
    {
        $response = array();
        $listDetail = DB::table('1_lead_master as lm')
                    ->Join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                    ->Select('lm.lm_fullname','lm.lm_email','lm.lm_company_name','lm.lm_id')
                    ->where('lm.lm_email',$email)
                    ->first();
                        
        if($listDetail)
        {
            $email_to = ['ruhika.darbare@intel.com','anwesha.aparimita.guru@intel.com'];
            $bcc_to = ['harpreet@ibentos.com','puneet@ibentos.com','karishma@ibentos.com','monu@ibentos.com'];
            
            try{
                 
                 $response = Mail::send('emailer.register_user_approval_mail', ['data' => $listDetail], function ($m) use ($email_to,$bcc_to) {
                     $m->from('invitation@smartevents.in', 'Virtual Partner Expo');
                     $m->to($email_to)->subject("New User Registration");
                     $m->bcc($bcc_to);
                    });
               
            } catch(\Exception $e){
                echo $e;
            }
        }
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
    
    public function verifyOTP(Request $request)
    {
        $res = array();
        $otp = request('otp');
        $email = request('email');
        $bm_id=request('bm_id');
        
        $validator = Validator::make(['otp' => $otp,'email' => $email], 
	                [
                        'otp' => 'required',
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
            $uniqueId = 'xyz'.rand(10000,999999);
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
                DB::table('1_lead_master')->where('lm_id',$detail->lm_id)->update(['lm_unique_id'=>$uniqueId]);
            }
            else
            {
               $res['status'] = 'failed'; 
            }
        }
        
        return $res;
    }
    
    public function getHallList(Request $request)
    {
        $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
        $hallList=DB::table('1_exhibitor_hall_category as ehc')
                    ->Select(DB::raw('CONCAT("'.$imageurl.'", ehc.ehc_hall_bgimage) AS logo'),'ehc.ehc_hall_name as hall_name','ehc.ehc_id as hall_id','ehc.ehc_order as order')
                    ->get();
        
        return $hallList;
        
    }
    
    function updateAvatarUrl(Request $requst)
    {
        $response = array();
        
        $bm_id = request('bm_id');
        $lemm_id = request('user_id');
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
    
    public function getBannersByHallId(Request $request)
    {
        $res = array();
        $ehc_id = request('hall_id');
        
        $validator = Validator::make(['hall_id' => $ehc_id], 
	                [
                        'hall_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
            $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
            
            $doorDetail = DB::table('1_exhibitor_hall_door_master')->first();
            
            $hall_details = DB::table('1_exhibitor_hall_category as ehc')->where('ehc.ehc_id',$ehc_id)->first();
            
            $banners = DB::table('1_exhibitor_hall_banners as ehb')
                    ->select(DB::raw('CONCAT("'.$imageurl.'", ehb.ehb_banner_bgimage) AS banner_name'),'ehb.ehb_id as banner_id','ehb.ehb_image_type as img_type')->where('ehb.ehc_id',$ehc_id)->get();
            $res['banners'] = $banners;
            $res['apply_link'] = $hall_details->ehc_apply_link;
            $res['color_code'] = $hall_details->ehc_color_code;
            $res['text_color_code'] = $hall_details->ehc_text_color_code;
            $res['door1_name'] = $doorDetail->ehdm_door_1;
            $res['door2_name'] = $doorDetail->ehdm_door_2;
            $res['door3_name'] = $doorDetail->ehdm_door_3;
            $res['door4_name'] = $doorDetail->ehdm_door_4;
        }
        return $res;
    }
    
    public function getAppId(Request $request)
    {
        $res = array();
        $appDetails = DB::table('1_app_setting_master')->select('asm_name as app_name','asm_app_id as app_id')->first();
        $res['app_detail'] = $appDetails;
        return $res;
    }
    
    public function GetBoothLogos(Request $request)
    {
        $res = array();
        $logourl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
        
        $exhibitorDetails = DB::table('1_exhibitor_master as em')
	                ->join('1_exhibitor_event_mapping as eem','em.exhim_id','eem.exhim_id')
	                ->Select(DB::raw('CONCAT("'.$logourl.'", em.exhim_logo) AS booth_logo'),'eem.ehc_id as hall_id')
	                ->WhereIn('eem.ehc_id',array(1,2))
	                ->get();
	                
	   return $exhibitorDetails;
    }
    
    
    public function GetMentorList(Request $request)
    {
        $res = array();
        $mentorList = DB::table('1_mentor_category_master')->select('mcm_name as mentor_category','mcm_id as cat_id')->get();
        $res['mentor_category'] = $mentorList;
        $res['mentor_data'] = ApiModel::GetMentorByCatId(1);
     
        return $res;
    }
    
    public function GetMentorByCategoryId(Request $request)
    {
        $res = array();
        $mcm_id = request('mentor_category_id');
        $validator = Validator::make(['mentor_category_id' => $mcm_id], 
	                [
                        'mentor_category_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
            $res['mentor_data'] = ApiModel::GetMentorByCatId($mcm_id);
        }
        return $res;
    }
    
    public function GetTeamList(Request $request)
    {
        $res = array();
        $mentorList = DB::table('1_team_category_master')->select('tcm_name as team_category','tcm_id as cat_id')->get();
        $res['team_category'] = $mentorList;
        $res['team_data'] = ApiModel::GetTeamByCatId(1);
        
        return $res;
    }
    
    public function GetTeamByCategoryId(Request $request)
    {
        $res = array();
        $tcm_id = request('team_category_id');
        $validator = Validator::make(['team_category_id' => $tcm_id], 
	                [
                        'team_category_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
            $res['team_data'] = ApiModel::GetTeamByCatId($tcm_id);
        }
        return $res;
    }
    
    public function GetMentorSettingData(Request $request)
    {
        $mentorData = DB::table('1_mentor_setting')
                        ->select('ms_text_color_code as text_color','ms_topfloor_color_code as floor_color','ms_wall_color_code as wall_color','ms_is_rpm as is_rpm_enable')
                        ->get();
        return $mentorData;
    }
    
    public function GetTeamSettingData(Request $request)
    {
        $teamData = DB::table('1_team_setting')
                    ->select('ts_text_color_code as text_color','ts_topfloor_color_code as floor_color','ts_wall_color_code as wall_color','ts_is_rpm as is_rpm_enable')
                    ->get();
        return $teamData;
    }
    

    
    public function getLobbySettingsData(Request $request)
    {
        $res=array();
        $bm_id = request('bm_id');
        $validator = Validator::make(['bm_id' => $bm_id], 
	                [
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
            $fileurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/';
            $lobbyData=Db::table('1_lobby_setting_master')
                        ->select(DB::raw('CONCAT("'.$fileurl.'", lsm_audio) AS audio_link'),'lsm_livestream')
                        ->where('bm_id',$bm_id)->first();
                
            if($lobbyData)
            {
                $res['code'] = 200;
                $res['is_live_stream'] = $lobbyData->lsm_livestream;
                $res['audio_link'] = $lobbyData->audio_link;
            }
            else{
                $res['code'] = 404;
            }
        }
        
        return $res;
    }
    
      public function getConferenceSettingsData()
      {
        
          $aem_id = request('event_id');
          $type=array('logo','h_banner','v_banner','video');
          
          $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/';
        
          $responseArray=array();
          
          for($i=0;$i<count($type);$i++){
              
            
            $Data=Db::table('1_conference_assets')
            ->where('ca_status','active')
            ->where('ca_type',$type[$i])
            
          //  ->groupby('ca_type')
            ->orderby('ca_orderby','asc')
            ->select(DB::raw('CONCAT("'.$imageurl.'", ca_name) AS ca_name'),'ca_type','ca_orderby')
            ->get();
            
            $responseArray[$type[$i]]=$Data;
            
          }
            
            $slideimageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/assets/images/slide_image/';
            
            $leadDetails = DB::table('1_slide_master as sm')
                            ->Select('lm.lm_email','lemm.lemm_id')
                            ->Join('1_lead_event_master_mapping as lemm','lemm.lemm_id','sm.lemm_id')
                            ->Join('1_lead_master as lm','lemm.lm_id','lm.lm_id')
                            ->where('lemm.aem_id',$aem_id)
                            ->groupby('sm.lemm_id')
                            ->get();
                            
            foreach($leadDetails as $ke => $details)
            {
                $slideData = DB::table('1_slide_master')
                        ->select(DB::raw('CONCAT("'.$slideimageurl.'", sm_image) AS slide_image'),'sm_id as slide_number')
                        ->OrderBy('sm_id','asc')
                        ->where('lemm_id',$details->lemm_id)
                        ->get();
                        
                $responseArray['speakers'][$ke]['email'] = $details->lm_email;
                foreach($slideData as $key=>$data)
                {
                    $responseArray['speakers'][$ke]['slides'][$key] = $data->slide_image; 
                }
            }
        
        return $responseArray;
    }
    
    
    
    
    public function getExhibitorTeamList(Request $request)
	{
	    $res = array();
        $exhim_id = request('booth_id');
        $validator = Validator::make(['booth_id' => $exhim_id], 
	                [
                        'booth_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] = 'failed';
        }
        else
        {
            $mentorpicurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/';
    	    $leadData = DB::table('1_exhibitor_master as em')
    	                    ->join('1_exhibitor_team_master as etm','em.exhim_id','etm.exhim_id')
        	                ->select(DB::raw('CONCAT("'.$mentorpicurl.'", etm.etm_profile_pic) AS profile_pic2'),'etm.exhitm_id as team_id','etm.etm_text as name','etm.etm_designation as designation')
        	                ->where('em.exhim_id',$exhim_id)
        	                ->get();
        	 $res['team'] = $leadData;
        }
    	return $res;
	}
    
    
    public function getGroundScalling(Request $request)
    {
        
        $res = array();
        $ptype = empty(request('platformtype')) ? 'webgl' : request('platformtype');
        $sceneurl = $this->baseurl.'public/assets/scene/'.strtolower($ptype).'/';
        
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
        
       return $res;
    }
    
    
    public function ValidateMetaverseId(Request $request)
    {
        $res = array();
        $metaverseId = request('metaverse_id');
        $validator = Validator::make(['metaverse_id' => $metaverseId], 
	                [
                        'metaverse_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
            $check = DB::table('1_customer_data')->where('metaverse_id',$metaverseId)->first();
            if($check) {
                $res['code'] = 200;
            }
            else {
                $res['code'] = 404;
            }
        }
        return $res;
    }
    
    public function GetHomePageSettingData(Request $request)
    {
       $res = array();
       $bm_id = request('bm_id');
       $validator = Validator::make(['bm_id' => $bm_id], 
	                [
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
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
    
    public function GetAssetSettingData(Request $request)
    {
       $res = array();
       $bm_id = request('bm_id');
       
       $validator = Validator::make(['bm_id' => $bm_id], 
	                [
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
            $fileurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
            $res['data'] = DB::table('1_asset_setting_master')
                        ->select(
                            DB::raw('CONCAT("'.$fileurl.'", asm_audio_url) AS audio_url'),
                            'asm_avatar_url as avatar_url','character_id')
                        //->where('bm_id',$bm_id)
                        ->get();
        }
        return $res; 
    }
    
    public function getAudiContent(Request $request)
    {
       $fileurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public';
       $res = array();
       $res['data'] = DB::table('1_auditorium_setting')
                    ->select(
                        DB::raw('CONCAT("'.$fileurl.'", ehc_hall_bgimage) AS bg_image'),
                        DB::raw('CONCAT("'.$fileurl.'", hp_video) AS bg_video'),
                        'hp_type as file_type')
                    ->first();
        return $res; 
    }
    
    
    public function setLiveSwitchUserDetails(Request $request)
    {
        $username = request('username');
        $user_id = request('user_id');
        $device_id = request('device_id');
        $email_id = request('email_id');
        
        $validator = Validator::make(['username' => $username,'user_id' => $user_id,'device_id'=>$device_id,'email_id'=>$email_id], 
	                [
                        'username' => 'required',
                        'user_id' => 'required|numeric',
                        'device_id' => 'required',
                        'email_id' => 'required|email',
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
        
            $userDetails = DB::table('liveswitch_user_list')->where('email',$email_id)->first();
            if($userDetails){
                DB::table('liveswitch_user_list')->where('email',$email_id)->update(['user_id'=>$user_id,'device_id'=>$device_id,'status'=>'active']);
                return 'updated';
            }
            else {
                $id = DB::table('liveswitch_user_list')->insertGetId([
        	                'username' => $username,
        	                'email'=>$email_id,
        	                'user_id' => $user_id,
        	                'device_id'=>$device_id
        	            ]);
        	   return 'Inserted';
            }
        }
    }
    public function getLiveSwitchUserDetails(Request $request)
    {
        $res = array();
        $email = request('email');
        $validator = Validator::make(['email' => $email], 
	                [
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
            $detail = DB::table('liveswitch_user_list')->where('email',$email)->first();
            if($detail){
                $res['code'] = 200;
                $res['user_id'] = $detail->user_id;
                $res['device_id'] = $detail->device_id;
            }
            else {
                $res['code'] = 404;
            }
        }
        
        return json_encode($res);
    }
    
    public function updateLiveSwitchActiveUserStatus(Request $request)
    {
        $res = array();
        $email = request('email');
        
        $validator = Validator::make(['email' => $email], 
	                [
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
            DB::table('liveswitch_user_list')->where('email',$email)->update(['status'=>'inactive']);
            return 'updated';
        }
    }
    
    public function getLiveSwitchActiveUserList(Request $request)
    {
        $users = array();
        $email = request('email');
        
        $validator = Validator::make(['email' => $email], 
	                [
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='Invalid Email Address!';
            return $res;
        }
        else
        {
            if($email == 'harpreet@ibentos.com')
            {
                $users = DB::table('liveswitch_user_list')->Select('username','email')->where('user_type','visitor')->where('status','active')->get();
                return $users;
            }
            else {
                return $users;
            }
        }
        
    }
    
    public function getLobbyBanners(Request $request)
	{
	    $res = array();
	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/';
	    $exhiList = DB::table('1_lobby_banner_master as bm')
	                ->join('1_lobby_banner_category_master as bcm','bm.bcm_id','bcm.bcm_id')
	                ->select(DB::raw('CONCAT("'.$imageurl.'", bm.bm_banner) AS banner'),'bm.bcm_id as category_id','bcm.bcm_name as category_name')
	                ->get();
	    
	    $res['banner_list'] = $exhiList;
	    $res['status'] = 'success';
	    
	    return $res;
	}
	
	public function getAssetLibraryContents(Request $request)
	{
	    $res = array();
	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/';
	    $exhiList = DB::table('1_asset_library_master as bm')
	                ->join('1_asset_library_category_master as bcm','bm.bcm_id','bcm.bcm_id')
	                ->select(
	                    DB::raw('CONCAT("'.$imageurl.'", bm.bm_banner) AS banner'),
	                    'bm.bcm_id as category_id',
	                    'bcm.bcm_name as category_name',
	                    'bm.bm_link as link',
	                    'bm.bm_description as description',
	                    'bm.bm_caption as title')
	                ->get();
	                
	    $fileurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/';
	    $assetFileList = DB::table('1_asset_file_master as af')
	                ->join('1_asset_file_category_master as afm','af.afm_id','afm.afm_id')
	                ->select(DB::raw('CONCAT("'.$fileurl.'", af.af_file) AS file'),'af.afm_id as category_id','afm.afm_name as category_name')
	                ->get();
	    
	    $res['asset_files'] = $assetFileList;
	    $res['banner_list'] = $exhiList;
	    $res['status'] = 'success';
	    
	    return $res;
	}
	
	
	public function getLandingAreaBanners(Request $request)
	{
	    $res = array();
	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/';
	    $exhiList = DB::table('1_landing_banner_master as bm')
	                ->join('1_landing_banner_category_master as bcm','bm.bcm_id','bcm.bcm_id')
	                ->select(DB::raw('CONCAT("'.$imageurl.'", bm.bm_banner) AS banner'),'bm.bcm_id as category_id','bcm.bcm_name as category_name')
	                ->get();
	    
	    $res['banner_list'] = $exhiList;
	    $res['status'] = 'success';
	    
	    return $res;
	}
	
	public function GetCustomerList(Request $request)
	{
	    $res = array();
	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/';
	    $customerList = DB::table('customer_data as cd')
	                    ->Join('brand_organizer_master as bm','bm.bm_id','cd.bm_id')
	                    ->select(DB::raw('CONCAT("'.$imageurl.'", cd.cd_company_logo) AS company_logo'),'cd_company_name as company_name','cd.id as customer_id','bm.bm_nickname')
	                    ->where('cd_status','active')
	                    ->where('lead_stage','!=','prospect')
	                    ->where('is_published','Y')
	                    ->get();
	    if($customerList)
	    {
	        foreach($customerList as $key=>$data)
	        {
	            $res[$key]['id']=$data->customer_id;
	            $res[$key]['customer_name']=$data->company_name;
	            $res[$key]['img']=!empty($data->company_logo) ? $data->company_logo : $imageurl.'assets/images/not_found.png';
	            $res[$key]['customer_id']=$data->customer_id;
	            $res[$key]['link'] = 'https://'.request()->getHost().config('app.rootFolder').'/'.$data->bm_nickname;
	        }
	    }
	    return $res;
	    
	}
	
	
	public function UploadFile(Request $request)
	{
	    $file = request('file');
	    $email_id = request('email_id');
        $location_id = request('location_id');
        $dataArray['type'] = request('type');
        
        $validator = Validator::make(['file' => $file,'email_id' => $email_id,'location_id'=>$location_id,'type'=>$dataArray['type']], 
	                [
                        'file' => 'required',
                        'email_id' => 'required|email',
                        'location_id' => 'required|numeric',
                        'type' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
            $res['msg'] = "Parameter Missing Or Invalid!";
        }
        else
        {
        
            if($dataArray['type'] == 'image')
            {
                $destinationPath = 'assets/images/fileupload/';
                $profileImage = date('YmdHis') . ".jpg";
                $dataArray['fu_name'] = $destinationPath.$profileImage;
                $success = $file->move($destinationPath, $profileImage); 
            }
            
            if($dataArray['type'] == 'video')
            {
                $destinationPath = 'assets/images/fileupload/';
                $profileImage = date('YmdHis') . ".mp4";
                $dataArray['fu_name'] = $destinationPath.$profileImage;
                $success = $file->move($destinationPath, $profileImage); 
            }
            
            if($dataArray['type'] == 'text')
            {
               $dataArray['fu_name'] =  $file;
            }
            
            $leadData = DB::table('1_lead_master as lm')
    	                ->Join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
    	                ->select('lemm.lemm_id')
    	                ->where('lm.lm_email',$email_id)
    	                ->first();
    	                
    	   if($leadData)
    	   {
    	       $checkFile = DB::table('1_file_upload_master')
    	                    ->where('lemm_id',$leadData->lemm_id)
                            ->where('location_id',$location_id)
                            ->first();
    	       if($checkFile)
    	       {
    	           DB::table('1_file_upload_master')
    	                    ->where('lemm_id',$leadData->lemm_id)
    	                    ->where('location_id',$location_id)
    	                    ->update($dataArray);
    	           $res['msg'] = 'updated';
    	       }
    	       else {
    	           $dataArray['lemm_id'] = $leadData->lemm_id;
    	           $dataArray['location_id'] = $location_id;
    	           
    	           $gimId = DB::table('1_file_upload_master')->insertGetId($dataArray);
    	           $res['msg'] = 'inserted';
    	       }
    	       $res['status'] ='success';
    	   }
    	   else
    	   {
    	       $res['status'] = 'failed';
    	   }
        }
       
        return $res;
	}
	
	public function GetFileByLocationId(Request $request)
	{
        $res = array();
        $email_id = request('email_id');
        
        $validator = Validator::make(['email_id' => $email_id], 
	                [
                        'email' => 'required|email'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
            $res['msg'] ='Invalid Email Address!';
        }
        else
        {
        
            $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/';
            
            $leadData = DB::table('1_lead_master as lm')
                        ->Join('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
                        ->select('lemm.lemm_id')
                        ->where('lm.lm_email', $email_id)
                        ->first();
    	                    
    	   if($leadData)
    	   {
    	       $fileData = DB::table('1_file_upload_master as fum')
    	                    ->Select(DB::raw('CONCAT("'.$imageurl.'", fum.fu_name) AS filename'),'fum.fu_name as file_text','fum.location_id as location_id','fum.type')
    	                    ->where('fum.lemm_id',$leadData->lemm_id)
    	                    ->where('fum.status','active')
    	                    ->get();
    	                    
    	       foreach($fileData as $key=>$data)
    	       {
    	           $res['data'][$key]['filename'] = $data->type=='text' ? $data->file_text : $data->filename;
    	           $res['data'][$key]['location_id'] = $data->location_id;
    	           $res['data'][$key]['type'] = $data->type;
    	       }
    	   }
        }
        return $res;
	}
	
	//
	public function UploadFileUnity(Request $request)
	{
	    $file = request('file');
	    $bm_id = request('bm_id');
        $location_id = request('location_id');
        $dataArray['type'] = request('type');
        
        $validator = Validator::make(['file' => $file,'bm_id' => $bm_id,'location_id'=>$location_id,'type'=>$dataArray['type']], 
	                [
                        'file' => 'required',
                        'bm_id' => 'required|numeric',
                        'location_id' => 'required|numeric',
                        'type' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
            $res['msg'] = "Parameter Missing Or Invalid!";
        }
        else
        {
        
            if($dataArray['type'] == 'image')
            {
                $destinationPath = 'assets/images/unityfiles/';
                $profileImage = date('YmdHis') . ".jpg";
                $dataArray['fu_name'] = $destinationPath.$profileImage;
                $success = $file->move($destinationPath, $profileImage); 
            }
            
            if($dataArray['type'] == 'video')
            {
                $destinationPath = 'assets/images/unityfiles/';
                $profileImage = date('YmdHis') . ".mp4";
                $dataArray['fu_name'] = $destinationPath.$profileImage;
                $success = $file->move($destinationPath, $profileImage); 
            }
            
            if($dataArray['type'] == 'text')
            {
               $dataArray['fu_name'] =  $file;
            }
    	                
    	 
            $checkFile = DB::table('1_environment_content_update_master')
                        ->where('bm_id',$bm_id)
                        ->where('location_id',$location_id)
                        ->first();
            if($checkFile)
            {
               DB::table('1_environment_content_update_master')
                        ->where('bm_id',$bm_id)
                        ->where('location_id',$location_id)
                        ->update($dataArray);
               $res['msg'] = 'updated';
               $res['status'] ='success';
            }
            else {
               $dataArray['bm_id'] = $bm_id;
               $dataArray['location_id'] = $location_id;
               
               $gimId = DB::table('1_environment_content_update_master')->insertGetId($dataArray);
               $res['msg'] = 'inserted';
               $res['status'] ='success';
            }
        }
        return $res;
	}
	
	public function getUploadFile(Request $request)
	{
        $res = array();
        $bm_id = request('bm_id');
        $location_ids = request('location_ids');
        
        $validator = Validator::make(['bm_id' => $bm_id,'location_ids'=>$location_ids], 
	                [
                        'bm_id' => 'required|numeric',
                        'location_ids' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
        
            $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/';
            
            $fileData = DB::table('1_environment_content_update_master as fum')
                        ->Select(DB::raw('CONCAT("'.$imageurl.'", fum.fu_name) AS filename'),'fum.fu_name as file_text','fum.*')
                        ->where('fum.bm_id',$bm_id)
                        ->where('fum.status','active');
                        
            if(!empty($location_ids))
            {
               $location_ids = json_decode($location_ids);
               $fileData = $fileData->whereIn('fum.location_id',$location_ids); 
            }
            
            if($fileData->count() > 0)
            {
                $fileData = $fileData->get();
                foreach($fileData as $key=>$data)
                {
                   $res['data'][$key]['filename'] = $data->type=='text' ? $data->file_text : $data->filename;
                   $res['data'][$key]['location_id'] = $data->location_id;
                   $res['data'][$key]['type'] = $data->type;
                   $res['data'][$key]['position']['x'] = $data->em_position_x;
                   $res['data'][$key]['position']['y'] = $data->em_position_y;
                   $res['data'][$key]['position']['z'] = $data->em_position_z;
                   
                   $res['data'][$key]['rotation']['x'] = $data->em_rotation_x;
                   $res['data'][$key]['rotation']['y'] = $data->em_rotation_y;
                   $res['data'][$key]['rotation']['z'] = $data->em_rotation_z;
                   
                   $res['data'][$key]['scale']['x'] = $data->em_scale_x;
                   $res['data'][$key]['scale']['y'] = $data->em_scale_y;
                   $res['data'][$key]['scale']['z'] = $data->em_scale_z;
                }
            }
            else {
                $res['code'] = 404;
            }
        }
        return $res;
	}
	
	public function GetBrandIdByNickName(Request $request)
	{
	    $res = array();
	    $bm_nickname = request('tmp_name');
	    
	    $validator = Validator::make(['tmp_name' => $bm_nickname], [
            'tmp_name' => 'required'
        ]);
        
        if ($validator->fails()) {
            $res['code'] = 404;
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
    	        
    	        $res['bm_id']=$detail->bm_id;
    	        $res['temp_id']=$detail->etm_id;
    	        $res['main_scene']=$detail->etm_main_scene;
    	        $res['color_code']=$detail->cd_color_code;
    	        $res['meta_name']=$meta_name;
    	        $res['feature_list'] = $featureList;
    	        $res['form_temp_id'] = $detail->ftm_id;
    	        $res['code']=200;
    	    }
    	    else{
    	        $res['code']=404;
    	    }
        }
	    return $res;
	}
	
	
	public function getUploadFileById(Request $request)
	{
        $res = array();
        $bm_id = request('bm_id');
        $location_id = request('location_id');
        
        $validator = Validator::make(['bm_id' => $bm_id,'location_id'=>$location_id], 
	                [
                        'bm_id' => 'required|numeric',
                        'location_id' => 'required|numeric',
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
        
            $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/';
            
            $fileData = DB::table('1_environment_content_update_master_bkp as fum')
                            ->join('1_environment_template_location_list as etll','etll.id','fum.etll_id')
                            ->Select(DB::raw('CONCAT("'.$imageurl.'", fum.fu_name) AS filename'),'fum.fu_name as file_text','fum.*','etll.*')
                            ->where('fum.bm_id',$bm_id)
                            ->where('etll.location_id',$location_id)
                            //->where('fum.status','active')
                            ->first();
            
            if($fileData)
            {
               $res['filename'] = $fileData->type=='text' ? $fileData->file_text : $fileData->filename;
               $res['location_id'] = $fileData->location_id;
               $res['type'] = $fileData->type;
               $res['position']['x'] = $fileData->em_position_x;
               $res['position']['y'] = $fileData->em_position_y;
               $res['position']['z'] = $fileData->em_position_z;
               
               $res['rotation']['x'] = $fileData->em_rotation_x;
               $res['rotation']['y'] = $fileData->em_rotation_y;
               $res['rotation']['z'] = $fileData->em_rotation_z;
               
               $res['scale']['x'] = $fileData->em_scale_x;
               $res['scale']['y'] = $fileData->em_scale_y;
               $res['scale']['z'] = $fileData->em_scale_z;  
            }
        }
        return $res;
	}
	
	
	public function AddTemplateBannerLocation(Request $request)
	{
        $setArray['em_position_x'] = request('position_x');
        $setArray['em_position_y'] = request('position_y');
        $setArray['em_position_z'] = request('position_z');
        
        $setArray['em_rotation_x'] = request('rotation_x');
        $setArray['em_rotation_y'] = request('rotation_y');
        $setArray['em_rotation_z'] = request('rotation_z');
        
        $setArray['em_scale_x'] = request('scale_x');
        $setArray['em_scale_y'] = request('scale_y');
        $setArray['em_scale_z'] = request('scale_z');
        
        $res['code']=200;
        $res['msg'] = 'Inserted';
        return $res;
	}
	
	
	//Get Conntent List By bmId
	public function GetLocationListBkp(Request $request)
	{
	    $res = array();
	    $bm_id = request('bm_id');
	    $location_ids = request('location_ids');
	    
	    $validator = Validator::make(['bm_id' => $bm_id,'location_ids'=>$location_ids], 
	                [
                        'bm_id' => 'required|numeric',
                        'location_ids' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter Missing!';
        }
        else
        {
    	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/';
    	    $customerData = DB::table('customer_data')->where('bm_id',$bm_id)->first();
    	    if($customerData)
    	    {
    	        $etm_id = $customerData->etm_id;
    	        
    	        $locationData = DB::table('1_environment_template_location_list as etll')
    	                        ->select('etll.*')
    	                        ->where('etm_id',$etm_id)
    	                        ->where('em_status','active');
    	                        
    	        if(!empty($location_ids))
                {
                   $location_ids = json_decode($location_ids);
                   $locationData = $locationData->whereIn('etll.location_id',$location_ids); 
                }
                
                $locationData = $locationData->get();
    	        
    	        foreach($locationData as $key => $locations)
    	        {
    	           $conentData = DB::table('1_environment_content_update_master_bkp as ecumb')
    	                        ->select(DB::raw('CONCAT("'.$imageurl.'", ecumb.fu_name) AS filename'))
    	                        ->where('ecumb.bm_id',$bm_id)
    	                        ->where('etll_id',$locations->id)
    	                        ->first();
    	           if($conentData)
    	           {
    	               $res['data'][$key]['filename'] = $conentData->filename;
    	           }
    	           else {
    	               $res['data'][$key]['filename'] = '';
    	           }
    	           
    	           $res['data'][$key]['type'] = $locations->type;
    	           $res['data'][$key]['location_id'] = $locations->location_id;
    	           $res['data'][$key]['position']['x'] = $locations->em_position_x;
    	           $res['data'][$key]['position']['y'] = $locations->em_position_y;
    	           $res['data'][$key]['position']['z'] = $locations->em_position_z;
    	           
    	           $res['data'][$key]['rotation']['x'] = $locations->em_rotation_x;
    	           $res['data'][$key]['rotation']['y'] = $locations->em_rotation_y;
    	           $res['data'][$key]['rotation']['z'] = $locations->em_rotation_z;
    	           
    	           $res['data'][$key]['scale']['x'] = $locations->em_scale_x;
    	           $res['data'][$key]['scale']['y'] = $locations->em_scale_y;
    	           $res['data'][$key]['scale']['z'] = $locations->em_scale_z;
    	           
    	        }
    	        
    	        $res['etm_id'] = $etm_id;
    	        $res['code'] = 200;
    	    }
    	    else {
    	        $res['code'] = 404;
    	    }
        }
	    
	    return $res;
	    
	}
	
	public function UploadFileUnityNew(Request $request)
	{
	    $file = request('file');
	    $bm_id = request('bm_id');
        $location_id = request('location_id');
        
        $validator = Validator::make(['file' => $file,'bm_id' => $bm_id,'location_id'=>$location_id], 
	                [
                        'file' => 'required',
                        'bm_id' => 'required|numeric',
                        'location_id' => 'required|numeric',
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
            $customerData = DB::table('customer_data as cd')
                            ->join('1_environment_template_location_list as etll','cd.etm_id','etll.etm_id')
                            ->select('etll.id as etll_id')
                            ->where('cd.bm_id',$bm_id)
                            ->where('etll.location_id',$location_id)
                            ->first();
            if($customerData)
            {
                if(request('type') == 'image')
                {
                    $destinationPath = 'assets/images/unityfiles/';
                    $profileImage = date('YmdHis') . ".jpg";
                    $dataArray['fu_name'] = $destinationPath.$profileImage;
                    $success = $file->move($destinationPath, $profileImage); 
                }
                
                if(request('type') == 'video')
                {
                    $destinationPath = 'assets/images/unityfiles/';
                    $profileImage = date('YmdHis') . ".mp4";
                    $dataArray['fu_name'] = $destinationPath.$profileImage;
                    $success = $file->move($destinationPath, $profileImage); 
                }
                
                if(request('type') == 'text')
                {
                   $dataArray['fu_name'] =  $file;
                }
        	                
                $checkFile = DB::table('1_environment_content_update_master_bkp')
                            ->where('bm_id',$bm_id)
                            ->where('etll_id',$customerData->etll_id)
                            ->first();
                if($checkFile)
                {
                   DB::table('1_environment_content_update_master_bkp')
                            ->where('bm_id',$bm_id)
                            ->where('etll_id',$customerData->etll_id)
                            ->update($dataArray);
                   $res['msg'] = 'updated';
                   $res['status'] ='success';
                }
                else {
                   $dataArray['bm_id'] = $bm_id;
                   $dataArray['etll_id'] = $customerData->etll_id;
                   
                   $gimId = DB::table('1_environment_content_update_master_bkp')->insertGetId($dataArray);
                   $res['msg'] = 'inserted';
                   $res['status'] ='success';
                }
            }
            else {
                $res['status'] ='failed';
            }
        }
       
        return $res;
	}
	
	public function GetMenuList(Request $request)
	{
	   $res = array();
	   $bm_id = request('bm_id');
	   
	   $validator = Validator::make(['bm_id' => $bm_id], 
	                [
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
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
    	   
    	   $res['menu_items'] = $Menulist;
        }
	    return $res;
	}
	
	public function GetStreamingVideo(Request $request)
	{
	    $res = array();
	    $bm_id = request('bm_id');
	    $lemm_id = request('user_id');
	    
	    $checkData = DB::table('1_event_launch_mapping as elm')
	                ->select('elm.elm_youtube_url as youtube_url','elm.elm_daily_co_url as daily_co_url','elm.elm_active_url as active_url')
	                ->where('bm_id',$bm_id)
	                ->first();
	                
	    $leadData = DB::table('1_daily_meeting_user_token_list')
	                ->where('bm_id',$bm_id)
	                ->where('lemm_id',$lemm_id)
	                ->first();
	  
	    $res['data'] = $checkData;
	    
	    if($leadData){
	       $res['data']->meeting_token = $leadData->dmt_token;
	    }
	    else{
	        $res['data']->meeting_token = '';
	    }
	    
	    return $res;
	}
	
	public function GetDoorList(Request $request)
	{
	    $doorList = DB::table('1_environment_template_door_list')
	                ->select('etd_id as door_id','etd_name as door_name')
	                ->get();
	                
	   return $doorList;
	}
	
	public function GetDoorDataById(Request $request)
	{
	    $etd_id = request('door_id');
	    
	    $validator = Validator::make(['door_id' => $etd_id],[
                        'door_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
    	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/';
    	    $boothLogourl = 'https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/images/booth/';
    	    $check = DB::table('1_environment_template_door_list as etd')
    	                ->select(
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_image) AS bg_image'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_image_2) AS bg_image_2'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_1) AS banner_1'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_2) AS banner_2'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_3) AS banner_3'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_4) AS banner_4'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_5) AS banner_5'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_6) AS banner_6'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_7) AS banner_7'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_8) AS banner_8'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_banner_9) AS banner_9'),
    	                    DB::raw('CONCAT("'.$imageurl.'", etd.etd_video_1) AS video_1')
    	                    )
    	                ->where('etd_id',$etd_id)
    	                ->first();
    	                
    	   if($check)
    	   {
                $boothData = DB::table('1_exhibitor_master as em')
                             ->Select('em.*')
                             ->whereRaw("find_in_set('".$etd_id."',em.etd_id)")
                             ->where('em.exhim_status','active')
                             ->get();
                
                $i=0;
                foreach($boothData as $data)
                {
                   $boothBaseUrl = $boothLogourl.$data->bm_id.'/'.$data->exhim_id.'/';
                   
                   $boothVideo = $boothBaseUrl.$data->exhim_stall_video;
                   $convai_character_id = $data->exhim_convai_character_id;
                   if($data->exhim_id==9)
                   {
                       $bDetail = ApiController::GetBDataById($etd_id,$data->exhim_id);
                       $boothVideo = $bDetail->booth_video;
                       $convai_character_id = $bDetail->convai_character_id;
                   }
                   
                   $isconvai_enable  = $data->is_convai;
                   $res['Boothdata'][$i]['boothid'] = $data->exhim_id; 
                   $res['Boothdata'][$i]['infomp3'] = $isconvai_enable=='yes' ? '' : ''; 
                   $res['Boothdata'][$i]['videoplayerURL'] = $boothVideo; 
                   $res['Boothdata'][$i]['poster1url'] = $boothBaseUrl.$data->exhim_standee1; 
                   $res['Boothdata'][$i]['poster2url'] = $boothBaseUrl.$data->exhim_standee2; 
                   $res['Boothdata'][$i]['boothLogo'] = $boothBaseUrl.$data->exhim_logo; 
                   $res['Boothdata'][$i]['isConvai'] = $isconvai_enable=='yes' ? true : false;
                   $res['Boothdata'][$i]['convaicharacterId'] = $isconvai_enable=='yes' ? $convai_character_id : '';
                   $i++;
                }
    	        $res['expobanner1'] = $check->bg_image; 
    	        $res['expobanner2'] = $check->bg_image_2;
    	        
    	        $res['expobanner3'] = $check->banner_1;
    	        $res['expobanner4'] = $check->banner_2;
    	        $res['expobanner5'] = $check->banner_3;
    	        $res['expobanner6'] = $check->banner_4;
    	        $res['expobanner7'] = $check->banner_5;
    	        $res['expobanner8'] = $check->banner_6;
    	        $res['expobanner9'] = $check->banner_7;
    	        $res['expobanner10'] = $check->banner_8;
    	        $res['expobanner11'] = $check->banner_9;
    	        $res['expovideo_1'] = $check->video_1;
    	        $res['code']=200;     
    	   }
    	   else{
    	       $res['code']=404;
    	   }
        }
	   
	    return $res;
	}
	
	public function getBoothGallaryById(Request $request)
    {
        $res = array();
        $exhim_id = request('exhim_id');
        
        $validator = Validator::make(['exhim_id' => $exhim_id],[
                        'exhim_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
        }
        else
        {
            $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/images/booth';
            
            $gallaryList = DB::table('1_exhibitor_master as em')
                        ->Join('1_exhibitor_gallery as eg', 'em.exhim_id','eg.exhim_id')
                        //->Select(DB::raw('CONCAT("'.$imageurl.'", eg.eg_name) AS filename'),'eg.eg_type')
                        ->Select('eg.eg_name AS filename','eg.eg_type','em.bm_id','em.exhim_id')
                        ->where('em.exhim_id',$exhim_id)
                        ->where('eg.eg_status','active')
                        ->orderBy('eg.eg_id','desc')
                        ->get();
            
            $i=0;$j=0;       
            foreach($gallaryList as $item)
            {
                $galleryBaseUrl = $imageurl.'/'.$item->bm_id.'/'.$item->exhim_id.'/gallery/';
                
                // if($item->eg_type=='image')
                // {
                    
                //     $res['items'][$i]['src'] = $galleryBaseUrl.$item->filename.'?&auto=format&fit=crop&w=1400&q=80';
                //     $res['items'][$i]['responsive'] = $galleryBaseUrl.$item->filename.'?&auto=format&fit=crop&w=480&q=80';
                //     $res['items'][$i]['thumb'] = $galleryBaseUrl.$item->filename.'?&auto=format&fit=crop&w=240&q=80';
                //     $res['items'][$i]['facebookShareUrl'] = $galleryBaseUrl.$item->filename;
                //     $res['items'][$i]['twitterShareUrl'] =  $galleryBaseUrl.$item->filename;
                //     $res['items'][$i]['pinterestShareUrl'] = $galleryBaseUrl.$item->filename;
                //     $res['items'][$i]['linkedinShareUrl'] = $galleryBaseUrl.$item->filename;
                //     $res['items'][$i]['subHtml'] = '';
                    
                //     $i++;
                // }
                
                if($item->eg_type=='video')
                {
                    $res['items'][$i]['video']['source'][$j]['src'] = $galleryBaseUrl.$item->filename.'?&auto=format&fit=crop&w=1400&q=80';;
                    $res['items'][$i]['video']['source'][$j]['type'] =  "video/mp4";
                    
                    $res['items'][$i]['video']['attributes']['preload'] =  false;
                    $res['items'][$i]['video']['attributes']['controls'] =  true;
                    
                    $res['items'][$i]['thumb'] = 'https://megaspace.ai/admin/public/images/play.jpg?&auto=format&fit=crop&w=240&q=80';
                    $res['items'][$i]['subHtml'] = '';
                    
                    $i++;
                }
            }
        }
        return $res;
    }
    
    public function saveEnquiry(Request $request)
	{
	    $res = array(); $enqArr = array();
	    $enqArr['ind_fullname'] = request('name');
	    $enqArr['ind_email'] = request('email');
	    $enqArr['ind_company_name'] = request('company_name');
	    $enqArr['ind_designation'] = request('designation');
	    $enqArr['exhim_id'] = request('exhimId');
	    $enqArr['ind_message'] = request('message');
	    $enqArr['aem_id'] = 1;
	    
	    $validator = Validator::make(['name'=>request('name'),'email'=>request('email'),'company_name'=>request('company_name'),'designation'=>request('designation'),'exhimId'=>request('exhimId'),'message'=>request('message')],[
                        'name' => 'required',
                        'email' => 'required|email',
                        'company_name' => 'required',
                        'designation' => 'required',
                        'exhimId' => 'required|numeric',
                        'message' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['msg'] = 'Parameter missing or empty, please check and try again!';
            $res['code'] = 404; 
        }
        else
        {
            $boothDetail = DB::table('1_exhibitor_master as em')
                            ->join('1_exhibitor_boothstaff as ebm','ebm.exhim_id','em.exhim_id')
                            ->select('em.exhim_web_link','em.exhim_contact_email as booth_email','em.exhim_organisation_email as alternate_email',
                            'em.exhim_contact_person as booth_name','ebm.ebm_login_pwd as booth_pwd')
                            ->where('em.exhim_id',request('exhimId'))
                            ->where('ebm.at_id',3)
                            ->first();
            
            if($boothDetail)
            {
                
                $emId = DB::table('1_inquiry_data')->insertGetId($enqArr);
                $uniquelink = 'https://megaspace.ai/admin/exhibitor/intelexpo/auto-login/?email='.$boothDetail->booth_email.'&pwd='.base64_encode($boothDetail->booth_pwd);
                $email_to = ['monu@ibentos.com','puneet@ibentos.com'];
                
                // $email_to = $boothDetail->booth_email;
                
                // if($boothDetail->booth_email=='anwesha.aparimita.guru@intel.com')
                // {
                //   $cc = ['ruhika.darbare@intel.com'];
                // }
                // else
                // {
                //     $cc = ['ruhika.darbare@intel.com','anwesha.aparimita.guru@intel.com'];
                // }
                
                try{
                    $response = Mail::send('emailer.contact_us_mail', [
                        'booth_name'=>$boothDetail->booth_name,
                        'enquiryData' => $enqArr,
                        'uniquelink'=>$uniquelink
                        ], function ($m) use ($email_to) {
                                    $m->from('invitation@smartevents.in', 'Intel Expo');
                                    $m->to($email_to)->subject("Contact Us");
                                    //$m->cc($cc);
                                    //$m->replyTo('support@ibentos.com', 'Support Team');
                                });
                                
                    $res['web_link'] = $boothDetail->exhim_web_link;
                    $res['msg'] = 'Enquiry Sent Successfully!';   
                    $res['code'] = 200;
                    
                    $data['exhid'] = request('exhimId');
    	            $data['username'] = request('email');
    	            $data['activeId'] = 25; //Send Enquiry
    	        
    	            $respArray=ApiModel::activityHere($data);
    	        
                   
                } catch(\Exception $e){
                    //echo $e;
                    $res['msg'] = 'Mail Sending Failed!';
                    $res['code'] = 404;
                    return $res;
                }
            }
            else
            {
                $res['msg'] = 'Invalid Booth Information!';   
                $res['code'] = 404;
            }
        }
    	return $res;
	}
	
	
	public function GetBrochureListByBoothId(Request $request)
	{
	    $exhim_id = request('exhim_id');
	    $etd_id = request('etdId');
	    
	    $validator = Validator::make(['exhim_id' => $exhim_id,'etd_id'=>$etd_id],[
                        'exhim_id' => 'required|numeric',
                        'etd_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['status'] ='failed';
            $res['msg'] ='Invalid Data Passed or Missing Parameter!';
        }
        else
        {
            $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/images/booth';
            
            $gallaryList = DB::table('1_exhibitor_master as em')
                        ->Join('1_exhibitor_gallery as eg', 'em.exhim_id','eg.exhim_id')
                        ->Select('eg.eg_name AS filename','eg.eg_type','eg.eg_caption','em.bm_id','em.exhim_id')
                        ->where('em.exhim_id',$exhim_id);
                        
            if($exhim_id == 9)
            {
              $gallaryList->where('eg.etd_id',$etd_id);  
            }
                        
            $gallaryList = $gallaryList->where('eg.eg_type','brochure')
                            ->where('eg.eg_status','active')
                            ->orderBy('eg.eg_id','desc')
                            ->get();
             
            $html = '';
            foreach($gallaryList as $detail)
            {
                $brochureBaseUrl = $imageurl.'/'.$detail->bm_id.'/'.$detail->exhim_id.'/brochure/';
                
                $html .= '<div class="col-md-12 mb-3">
                                <div class="media bg-white border p-2">
                                  <img src="pdf-icon.png" class="align-self-start mr-3" alt="...">
                                  <div class="media-body">
                                	<h5 class="mt-0">'.$detail->eg_caption.'</h5>
                                	<a href="'.$brochureBaseUrl.$detail->filename.'" class="link" target="_blank">View</a>
                                  </div>
                                </div>
                            </div>';
            }
            
            $res['html'] = $html;
	    }
        return $res;
	}
	
	public function updateUserFile(Request $request)
	{
	    $res = array();
	    $file = request('file');
        $emailId = request('email');
        $aem_id = 1;
        
        $validator = Validator::make(['file' => $file,'email' => $emailId],[
                        'file' => 'required',
                        'email' => 'required|email'
                    ]);
        
        if($validator->fails())
        {
            $res['msg'] = 'Parameter missing or invalid data passed!';
            $res['code'] = 404; 
        }
        else
        {
            $leadData = DB::table('1_lead_master as lm')
    	        ->select('lm.lm_firstname')
    	        ->leftJoin('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
    	        ->where('lm.lm_email',$emailId)->where('lemm.aem_id',$aem_id)
    	        ->first();
    	        
    	   if($leadData)
    	   {
    	        
    	        $destinationPath = 'assets/images/avatar_img/'.$leadData->lm_firstname.'/';
                $profileImage = date('YmdHis') . ".jpg";
                $imgurl = $destinationPath.$profileImage;
                $success = $file->move($destinationPath, $profileImage); 
                //file_put_contents($imgurl,$file)
                
                $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/'.$imgurl;
                
                $res['img_url'] = $imageurl;
    	    
        	    DB::table('1_lead_master')->where('lm_email',$emailId)->update(['lm_imgurl'=>$imgurl]);
        	    $res['msg'] = 'User Updated Successfully!';   
                $res['code'] = 200;
            }
            else
            {
               $res['msg'] = 'Invalid Email Address';
               $res['code'] = 404;  
            }
        }
    	return $res;
	}
	
	public function updateSdkAvatarUrl(Request $requst)
    {
        $res = array();
        $emailId = request('email');
        $avatarsdkId = request('avatar_sdk_id');
        
        $check = DB::table('1_lead_master as lm')
                ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                ->where('lm.lm_email',$emailId)
                ->first();
                
        if($check)
        {
            DB::table('1_lead_master')->where('lm_id',$check->lm_id)->update(['lm_avatarsdk_id'=>$avatarsdkId,'change_id'=>'Y']);
            $res['status']='success';
        }
        else
        {
            $res['status']='failed';
        }
        
        return $res;
        
    }
	
	public static function GetBDataById($etdId,$exhimId)
	{
	    $boothfilebaseurl = 'https://'.request()->getHost().config('app.rootFolder').'/admin/public/'; 
	    
	    $bDetail = DB::table('1_door_booth_data as db')
	                ->select(
	                    DB::raw('CONCAT("'.$boothfilebaseurl.'", db.db_video) AS booth_video'),
	                    'convai_character_id'
	                    )
	                ->where('etd_id',$etdId)
	                ->where('exhim_id',$exhimId)
	                ->first();
	   
	   return $bDetail;
	}
	
	public function GenerateConvaiCharacter(Request $request)
	{
	    $data = array(
                'charName'=>request('name'),
                'voiceType'=>request('voice_type'),
                'backstory'=>request('back_story'),
                );
                
        $convaiData = json_encode($data);
	    
	    $character_id = ApiModel::CreateConvaiCharacterId(['type' => 'POST', 'data' => $convaiData]);
	    
	    $res['character_id'] = $character_id;
	    return $res;
	}
	
	public function GetMeetingListById(Request $request)
	{
	    $exhim_id = request('booth_id');
	    //$brand_id = request('brand_id');
	    $res = array();
	    $meetingDate=array();
        $meetingSlot=array();
        $meetSlot=array();
        
        $aem_id = 1;
        
        $sqlmeet="SELECT Distinct meeting_date FROM 1_meeting_slot_master
                    WHERE aem_id='".$aem_id."'
              order by meeting_date asc";
        
        $meetingDate=DB::select($sqlmeet);
        
        foreach($meetingDate as $date){
            $sqlslot="SELECT  * FROM 1_meeting_slot_master
            WHERE aem_id='".$aem_id."' and meeting_date='".$date->meeting_date."'
            order by msm_id asc";
            
            $meetingSlot = DB::select($sqlslot);
            $meetSlot[$date->meeting_date]=$meetingSlot;
              
        }
      
        $respReq['timeslot']=  $meetSlot;
	    
	    $checkmeeting = DB::table('1_meetings_data')
                        ->wherein('meeting_status',array('Confirmed','Requested'))
                        ->where('meeting_requested_to',$exhim_id)
                        ->orwhere('meeting_request_by',$exhim_id)
                        //->where('bm_id',$brand_id)
                        ->get();
        
        $i=1;$k=0;$m=1;
        $datTimeHtml = '';$cHtml = '';
        foreach($respReq['timeslot'] as $key => $value)
        {
            $date = date('d M Y',strtotime($key));
            
            $activeDate = $m==1?'active':'';
            $activeC = $m==1?'show active in':'';
            $datTimeHtml.='<li class="nav-item mb-2" role="presentation">
                            <a class="nav-item nav-link datemeet '.$activeDate.'" id="day-'.$m.'" data-toggle="tab" href="#day'.$m.'" role="tab" aria-controls="day'.$m.'" aria-selected="true">'.$date.'</a>
                        </li>';
                        
            $cHtml .= '<div class="tab-pane fade '.$activeC.'" id="day'.$m.'" role="tabpanel" aria-labelledby="day-'.$m.'">
                                   <ul class="time-list text-center">
                                      <div class="btn-group-toggle" data-toggle="buttons">';
            $m++;
            
            foreach($value as $key => $slots)
            {
                $status = '';
                $active = 'btn-outline-danger';
                
                foreach($checkmeeting as $val)
                {
                    if($slots->msm_id == $val->meeting_slot_id)
                    {
                        $status = 'disabled';
                        $active = 'btn-danger';
                    }
                }
                
                $res[$date][$k]['slot_id'] = $slots->msm_id;
                $res[$date][$k]['slot_value'] = $slots->meeting_time;
                $res[$date][$k]['status'] = $status;
                $res[$date][$k]['active'] = $active;
                $k++;
                
                $cHtml.= '<label class="btn mt-3 '.$active.' '.$status.'" for="msmid'.$slots->msm_id.'">
                            <input type="radio" class="mr-1" name="msmid" id="msmid'.$slots->msm_id.'" value="'.$slots->msm_id.'">
                            '.$slots->meeting_time.'
                        </label>';
            }
            
            $cHtml.='</div></ul></div>';
        }
        $res['dateh'] = $datTimeHtml;
        $res['datec'] = $cHtml;
        return $res;
	}
	
	
	##Book Meeting Start
	public function CheckNAddtoC(Request $request){
       
        $credits = "0";
        $lemm_id = request('requestby');
        $exhim_id = request('requestto');
        $msm_id = request('msmid');
        
        //dd($request->all());

        $getCredits = DB::table('1_lead_event_master_mapping')->select('lemm_meeting_quota')->where('lemm_id',$lemm_id)->first();
        $credits = $getCredits->lemm_meeting_quota;
       
        $totalMeetingBooked = DB::table('1_meetings_data')
                                ->where('meeting_request_by',$lemm_id)
                                ->where('meeting_status','!=','Cancelled')
                                ->count();
        
      
        if($totalMeetingBooked >= $credits){
             $res['code'] = 404;
             $res['msg'] = "You have exhausted you meeting quota.";
             return $res;
             exit();
        }
        
        
        $TotalIteminCart=DB::table('1_exhibitor_cart')
                        ->where('exhim_id',$lemm_id)->count();

         $checkAddedincart=DB::table('1_exhibitor_cart')
                        ->where('exhim_id',$exhim_id)
                        ->where('msm_id',$msm_id)
                        ->where('lemm_id',$lemm_id)
                        ->first();

        if(!empty($checkAddedincart)){
            $res['code'] = 404;
            $res['msg'] = "Selected slot is already added to cart";
            return $res;
            exit();
        }

        $checkAddedincartforcurrentbuyer=DB::table('1_exhibitor_cart')
                                        ->where('exhim_id',$exhim_id)
                                        ->where('lemm_id',$lemm_id)
                                        ->first();

        if(!empty($checkAddedincartforcurrentbuyer)){
            $res['code'] = 404;
            $res['msg'] = "You have already added one slot of this participant into cart";
            return $res;
            exit();
        }

        $checkAddedincartforcurrentbuyerbyother=DB::table('1_exhibitor_cart')
                                                ->where('exhim_id','!=',$exhim_id)
                                                ->where('lemm_id',$lemm_id)
                                                ->where('msm_id',$msm_id)
                                                ->first();

        if(!empty($checkAddedincartforcurrentbuyerbyother)){
            $res['code'] = 404;
            $res['msg'] = "Selected slot is not available at the moment.";
            return $res;
            exit();
        }

        $checkmeetingsetbyme=DB::table('1_meetings_data')
                            ->where('meeting_request_by',$lemm_id)
                            ->wherein('meeting_status',array('Confirmed','Requested'))
                            ->where('meeting_requested_to',$exhim_id)
                            ->first();
     
        if(!empty($checkmeetingsetbyme)){
            $res['code'] = 404;
            $res['msg'] = "You have already booked meeting for this participant.";
            return $res;
            exit();
        }

        $checkmeetingsetbyother=DB::table('1_meetings_data')
                            ->where('meeting_request_by','!=',$lemm_id)
                            ->where('meeting_slot_id',$msm_id)
                            ->wherein('meeting_status',array('Confirmed','Requested'))
                            ->where('meeting_requested_to',$exhim_id)
                            ->first();

        if(!empty($checkmeetingsetbyme)){
            $res['code'] = 404;
            $res['msg'] = "Selected slot is not available at the moment.";
            return $res;
            exit();
        }
        
        $checkmeetingrequestbyseller=DB::table('1_meetings_data')
                                    ->where('meeting_request_by',$exhim_id)
                                    ->wherein('meeting_status',array('Confirmed','Requested'))
                                    ->where('meeting_requested_to',$lemm_id)
                                    ->first();

        if(!empty($checkmeetingrequestbyseller)){
            $res['code'] = 404;
            $res['msg'] = "This participanty has already sent meeting request to you.";
            return $res;
            exit();
        }

       
       $insrt=DB::table('1_exhibitor_cart')
                ->insert(array(
                    'exhim_id'=>$exhim_id,
                    'lemm_id'=>$lemm_id,
                    'msm_id'=>$msm_id,
                    'meeting_type'=>request('options'),
                    'message'=>request('message')
           ));

        $meetingDetails = DB::table('1_meeting_slot_master')->select('*')->where('msm_id',request('msmid'))->first(); 

        ApiController::checkoutresponseBypass($lemm_id);
       
        $res['code'] = 200;
        $res['msg'] = "Meeting Booked Successfully";
        return $res;
   }
   
   public static function checkoutresponseBypass($lemmId){

        $IteminCart=ApiController::cartadatalist($lemmId);

        foreach($IteminCart as $list){

			ApiController::sendMeetingRequest($list,$lemmId);

        }
        
        ApiController::clearcartitem($lemmId);
    }
  
    public static function cartadatalist($lemm_id){

        $IteminCart=DB::table('1_exhibitor_cart as ec')
                    ->join('1_meeting_slot_master as msm','ec.msm_id','msm.msm_id')
                    ->where('ec.lemm_id',$lemm_id)
                    ->select('ec.*','ec.meeting_type as meetingtype','msm.*')
                    ->get();

        return $IteminCart;
    } 
    
    public static function sendMeetingRequest($request,$lemm_id){

        $roomdetails['id']=null;
        $roomdetails['name']=null;
        $roomdetails['url']=null;
        
        
        if($request->meetingtype=='online'){
            $roominfo=ApiController::createRoom($request);
            $roomdetails=json_decode($roominfo->getContent(),TRUE);
        }
    
        $requesttype='received';
    
        $insert=DB::table('1_meetings_data')->insertOrIgnore(

            array(
                    'aem_id'=>'1',
                    'request_type'=>$requesttype,
                    'meeting_request_by'=>$lemm_id,
                    'meeting_requested_to'=>$request->exhim_id,
                    'meeting_slot_id'=>$request->msm_id,
                    'meeting_date'=>$request->meeting_date,
                   // 'meeting_date'=>date('Y-m-d'),
                    'meeting_time'=>$request->meeting_time,
                    'meeting_type'=>$request->meetingtype,
                    'meeting_status'=>'Confirmed',
                    'message'=>$request->message,
                    'meeting_id'=>$roomdetails['id'],
                    'meeting_room_name'=>$roomdetails['name'],
                    'meeting_url'=>$roomdetails['url']
                )
          );
    }
    
    
    public static function clearcartitem($lemm_id){
        DB::table('1_exhibitor_cart')->where('lemm_id',$lemm_id)->delete();
    }
    ##Book Meeting End
    
    
    public function UploadSelfieById(Request $request)
    {
       $user_id = request('user_id');
       $image = request('filename');
       $bm_id = request('bm_id');
       
       $selfieUrl = 'https://'.request()->getHost().config('app.rootFolder').'/admin/';
       
        $destinationPath = 'assets/images/selfie/'.$user_id.'/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image_url = $destinationPath.$profileImage;
        $success = $image->move($destinationPath, $profileImage);
        
        $leadData = DB::table('1_lead_master as lm')
	                ->Join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
	                ->select('lemm.lemm_id')
	                ->where('lemm.lemm_id',$user_id)
	                ->first();
	                
	   if($leadData)
	   {
	       $gimId = DB::table('1_selfie_wall')->insertGetId([
        	           'lemm_id' => $leadData->lemm_id,
        	           'sf_name' => $image_url,
        	           'bm_id'=> $bm_id
	                ]);
	           
	       $res['code'] = 200;
	       $res['selfie_url'] = $selfieUrl.$image_url;
	   }
	   else
	   {
	       $res['code'] = 404;
	   }
       
        return $res;
    }
    
    public function SaveScribbleWallData(Request $request)
	{
	   $lemm_id = request('user_id');
	   $sw_text = request('msg');
	   $bm_id = request('bm_id');
	   
	   $checkData = DB::table('1_scribble_wall')
	                ->where('lemm_id',$lemm_id)
	                ->where('sw_text',$sw_text)
	                ->where('bm_id',$bm_id)
	                ->first();
	   if($checkData)
	   {
	        DB::table('1_scribble_wall')
	        ->where('sw_id',$checkData->sw_id)
	        ->where('bm_id',$bm_id)
	        ->update([
	            'lm_imgurl'=>$lemm_id,
	            'sw_text'=>$sw_text
	            ]);
	            
	       $res['code'] = 200;
	       $res['msg'] = 'Data Updated';
	   }
	   else{
	       $swId = DB::table('1_scribble_wall')->insertGetId([
    	                'lemm_id' => $lemm_id,
    	                'sw_text' => $sw_text,
    	                'bm_id'=>$bm_id
    	            ]);
    	   $res['code'] = 200;
	       $res['msg'] = 'Data Inserted';
	   }
	   
	   return $res;
	}
	
    public function GetScribbleWallDataById(Request $request)
	{
	    $res = array();
	    $bm_id = request('bm_id');
	    $checkData = DB::table('1_scribble_wall as sw')
	                ->join('1_lead_event_master_mapping as lemm','sw.lemm_id','lemm.lemm_id')
	                ->join('1_lead_master as lm','lemm.lm_id','lm.lm_id')
	                ->select('lm.lm_fullname as lm_firstname','sw.sw_text as msg')
	                ->where('sw.bm_id',$bm_id)
	                ->get();
	   $res['data'] = $checkData;
	   return $res;
	}
	
	public function GetConvaiId(Request $request)
    {
        $res = array();
        $appDetails = DB::table('1_convai_id_master')->select('asm_convai_id')->first();
        if($appDetails)
        {
            $res['code']=200;
            $res['convai_id'] = $appDetails->asm_convai_id;
        }
        else
        {
            $res['code']=404;
        }
        return $res;
    }
    
    public function getSelfieGallaryList(Request $request)
    {
        $res = array();
        $bm_id = request('bm_id');
        $fileurl=$this->baseurl;
        $gallaryList = DB::table('1_selfie_wall as sfm')
                    ->Join('1_lead_event_master_mapping as lemm', 'sfm.lemm_id','lemm.lemm_id')
                    ->Join('1_lead_master as lm','lemm.lm_id','lm.lm_id')
                    ->Select(
                        DB::raw('CONCAT("'.$fileurl.'", sfm.sf_name) AS filename'),
                        'lm.lm_fullname as fullname','sfm.bm_id')
                    ->where('sfm.bm_id',$bm_id);
                        
        $gallaryList = $gallaryList->orderBy('sfm.sf_id','desc')->limit(100)->get();

        $i=0;            
        foreach($gallaryList as $item)
        {
            $res['items'][$i]['src'] = $item->filename.'?&auto=format&fit=crop&w=1400&q=80';
            $res['items'][$i]['responsive'] = $item->filename.'?&auto=format&fit=crop&w=480&q=80';
            $res['items'][$i]['thumb'] = $item->filename.'?&auto=format&fit=crop&w=240&q=80';
            $res['items'][$i]['facebookShareUrl'] = $item->filename;
            $res['items'][$i]['twitterShareUrl'] =  $item->filename;
            $res['items'][$i]['pinterestShareUrl'] = $item->filename;
            $res['items'][$i]['linkedinShareUrl'] = $item->filename;
            $res['items'][$i]['subHtml'] = '';
            $i++; 
        }
        return $res;
    }
    
    public function getUserSelfieGallaryList(Request $request)
    {
        $res = array();
        $bm_id=request('bm_id');
        $fileurl='https://'.request()->getHost().config('app.rootFolder').'/admin/';
        $gallaryList = DB::table('1_selfie_wall as sfm')
                    ->Join('1_lead_event_master_mapping as lemm', 'sfm.lemm_id','lemm.lemm_id')
                    ->Join('1_lead_master as lm','lemm.lm_id','lm.lm_id')
                    ->Select(
                        DB::raw('CONCAT("'.$fileurl.'", sfm.sf_name) AS filename'),
                        'lm.lm_fullname as fullname','sfm.bm_id')
                     ->where('sfm.bm_id',$bm_id)
                    ->inRandomOrder()
                    ->limit(50)
                    ->get();

        $i=0;            
        foreach($gallaryList as $item)
        {
            $res['items'][$i]['src'] = $item->filename.'?&auto=format&fit=crop&w=1400&q=80';
            $res['items'][$i]['responsive'] = $item->filename.'?&auto=format&fit=crop&w=480&q=80';
            $res['items'][$i]['thumb'] = $item->filename.'?&auto=format&fit=crop&w=240&q=80';
            $res['items'][$i]['facebookShareUrl'] = $item->filename;
            $res['items'][$i]['twitterShareUrl'] =  $item->filename;
            $res['items'][$i]['pinterestShareUrl'] = $item->filename;
            $res['items'][$i]['linkedinShareUrl'] = $item->filename;
            $res['items'][$i]['subHtml'] = '';
            $i++; 
        }
        return $res;
    }
    
    public function GetCurrentLevelId(Request $request)
    {
        $lemmId = request('user_id');
        $bm_id = request('bm_id');
        
        $LeadDetail = DB::table('1_user_treasure_level as td')
                        ->where('td.lemm_id',$lemmId)
                        ->where('td.bm_id',$bm_id)
                        ->select('td.current_level')
                        ->first();
                        
        if($LeadDetail)
        {
            $res['code']=200;
            $res['current_level'] = $LeadDetail->current_level;
        }
        else
        {
            $res['code']=200;
            $res['current_level'] = 0;
        }
        
        return $res;
    }
    
    public function SetCurrentLevel(Request $request)
    {
        $lemm_id = request('user_id');
        $current_level = request('current_level');
        $bm_id = request('bm_id');
        
        $isUser = DB::table('1_user_treasure_level as td')
                    ->where('td.lemm_id',$lemm_id)
                    ->where('td.bm_id',$bm_id)
                    ->first();
        
        if($isUser)
        {
            DB::table('1_user_treasure_level as td')->where('lemm_id',$lemm_id)->where('td.bm_id',$bm_id)->update(['current_level'=>$current_level]);
        }
        else
        {
            $saveData['lemm_id'] = $lemm_id;
            $saveData['bm_id'] = $bm_id;
            $saveData['current_level'] = $current_level;
            DB::table('1_user_treasure_level')->insertGetId($saveData);
        }
        $res['code']=200;
        return $res;
    }
    
    public static function GetUpdatedTicketTime($stored_time, $time)
    {
        if(empty($stored_time))
        {
            $newTime = $time;
        }
        else if(floatval($stored_time) > floatval($time))
        {
            $newTime = $time;
        }
        else
        {
           $newTime = $stored_time; 
        }
        return $newTime;
    }
    
    public function UpdateUserTicketData(Request $request)
    {
        $lemm_id = request('user_id');
        $level = request('level_name');
        $time = request('time');
        $bm_id = request('bm_id');
        
        $validator = Validator::make(['user_id' => $lemm_id,'level_name' => $level,'time' => $time],[
                        'user_id' => 'required|numeric',
                        'level_name' => 'required',
                        'time' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
            $res['msg'] = 'Parameter Missing!';
        }
        else
        {
            $getLevelData = ApiModel::GetTreasureLevelId($level);
            $tgm_id = $getLevelData->tgm_id;
            
            $isExists = DB::table('1_user_treasure_data')
                        ->select('played_time')
                        ->where('lemm_id',$lemm_id)
                        ->where('bm_id',$bm_id)
                        ->where('tgm_id',$tgm_id)
                        ->first();
            
            $data['is_played']=1;
            $data['played_time']=$time;
            
            if($isExists)
            {
                $data['played_time'] = ApiController::GetUpdatedTicketTime($isExists->played_time, $time);
            }
            
            if($isExists)
            {
                DB::table('1_user_treasure_data')
                ->where('bm_id',$bm_id)
                ->where('lemm_id',$lemm_id)
                ->where('tgm_id',$tgm_id)
                ->update($data);
            }
            else
            {
               $data['lemm_id']=$lemm_id;
               $data['bm_id']=$bm_id;
               $data['tgm_id']=$tgm_id;
               $tlId = DB::table('1_user_treasure_data')->insertGetId($data); 
            }
            
            DB::table('1_user_treasure_level')->where('bm_id',$bm_id)->where('lemm_id',$lemm_id)->update(['current_level'=>0]);

            $res['code']=200;
        }
        return $res;
    }
    
    public function GetTotalTicketCompleteCount(Request $request)
    {
        $i=0;
        $lemm_id = request('user_id');
        $bm_id = request('bm_id');
        
        $gameLevel = DB::table('customer_data as cu')
                    ->select('tgm_ids')
                    ->where('bm_id',$bm_id)
                    ->first();
                    
        $countLevel = count(explode(',',$gameLevel->tgm_ids));
                    
        $gameList = DB::table('1_treasure_game_master as tgm')
                  ->leftjoin("customer_data as cu",\DB::raw("FIND_IN_SET(tgm.tgm_id,cu.tgm_ids)"),">",\DB::raw("'0'"))
                  ->leftJoin('1_user_treasure_data as td', function($leftJoin)use($lemm_id)
                    {
                      $leftJoin->on('td.tgm_id', '=', 'tgm.tgm_id')
                     ->where('td.lemm_id', '=', $lemm_id );
                   })
                  ->select('tgm.*','cu.etm_id as eid','td.*')
                  ->where('cu.bm_id',$bm_id)
                  ->orderBy('tgm.tgm_id','asc');
        
        if($gameList->count() > 0)
        {
            $res['total_level'] = $countLevel;
            $gameList = $gameList->get();
        
            foreach($gameList as $key=>$data)
            {
                $res['ticket_level'][$key] = $data->is_played!=NULL ? $data->is_played : 0;
            }
            
            $res['ticket_complete'] = array_sum($res['ticket_level']);
            $res['code']=200;
        }
        else
        {
            $res['total_level'] = $totalGame;
            $res['code']=404;
        }
        return $res;
    }
    
    public function GetTicketBoardList(Request $request)
    {
        $res=array();
        $bm_id = request('bm_id');
        $list = DB::table('1_user_treasure_data as utd')
                ->Join('1_lead_event_master_mapping as lemm','utd.lemm_id','lemm.lemm_id')
                ->Join('1_lead_master as lm', 'lm.lm_id','lemm.lm_id')
                ->Select('lm.lm_fullname', 'lm.lm_email', 'utd.lemm_id', DB::raw('SUM(`played_time`) AS total_points'))
                ->Where('td_status','active')
                ->Where('is_played',1)
                ->where('utd.bm_id',$bm_id)
                ->groupBy('utd.lemm_id')
                ->orderBy('total_points','asc')
                ->limit(10)
                ->get();
                
        $i=0;
        foreach($list as $detail)
        {
            $res['scoreboard'][$i]['user_id'] = $detail->lemm_id;
            $res['scoreboard'][$i]['name'] = $detail->lm_fullname;
            $res['scoreboard'][$i]['email'] = $detail->lm_email;
            $res['scoreboard'][$i]['score'] = number_format($detail->total_points,3);
            $i++;
        }
        
        return $res;
    }
    
    public function UpdateTreasureHuntStatus(Request $request)
    {
        $lemm_id = request('user_id');
        $bm_id = request('bm_id');
        
        DB::table('1_ticket_data')->where('bm_id',$bm_id)->where('lemm_id',$lemm_id)->update(['is_treasure_hunt'=>'inactive']);
        
        $res['code']=200;
        return $res;
    }
    
    public function UpdateTreasureHuntStatus2(Request $request)
    {
        $lemm_id = request('user_id');
        $bm_id = request('bm_id');
        DB::table('1_user_treasure_level')->where('bm_id',$bm_id)->where('lemm_id',$lemm_id)->update(['is_treasure_hunt'=>'inactive']);
        $res['code']=200;
        return $res;
    }
    
    
    public function GetBoothListByBmId(Request $request)
    {
        $bm_id = request('bm_id');
        $res = array();
	    $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/images/booth';
	    $exhiList = DB::table('1_exhibitor_master as em')
	                ->join('1_exhibitor_boothstaff as eb','em.exhim_id','eb.exhim_id')
	                ->join('1_exhibitor_event_mapping as eem','em.exhim_id','eem.exhim_id')
	                ->join('1_exhibitor_hall_category as ehc','eem.ehc_id','ehc.ehc_id')
	                ->select('em.exhim_id as booth_id','eb.ebsm_name as booth_name',
	                'eem.eem_stall_number as stall_number','eem.ehc_id as hall_number','ehc.ehc_hall_name as hall_name',
	                'eb.ebm_login_user as booth_email','em.exhim_logo','em.exhim_standee','em.exhim_standee2','em.exhim_standee3',
	                'em.exhim_rpm_link as booth_avatar_url','em.bm_id','em.exhim_id','em.exhim_convai_character_id')
	                ->where('exhim_status','active')
	                ->where('em.bm_id',$bm_id)
	                ->where('eb.at_id',3)
	                ->get();
	   
	   $i=0;
	   foreach($exhiList as $detail)
	   {
	       $imageurlNew = $imageurl.'/'.$detail->bm_id.'/'.$detail->exhim_id.'/';
	    
	       $res['data'][$i]['booth_id'] = $detail->exhim_id;
	       $res['data'][$i]['booth_name'] = $detail->booth_name;
	       $res['data'][$i]['logo'] = $imageurlNew.$detail->exhim_logo;
	       $res['data'][$i]['banner_1'] = $imageurlNew.$detail->exhim_standee;
	       $res['data'][$i]['banner_2'] = $imageurlNew.$detail->exhim_standee2;
	       $res['data'][$i]['banner_3'] = $imageurlNew.$detail->exhim_standee3;
	       $res['data'][$i]['convai_id'] = $detail->exhim_convai_character_id;
           $i++;
	   }
	    return $res;
    }
    
    
    public function GetConvaiSettingData(Request $request)
    {
        $bm_id = request('bm_id');
        $response = ApiModel::GetConvaiSettingData($bm_id);
        return $response;
    }
    
    public function GetConvaiCharacterId(Request $request)
    {
        $bm_id = request('bm_id');
        $response = ApiModel::GetConvaiCharacterId($bm_id);
        return $response;
    }
    
    public function GetSceneBanners(Request $request)
    {
        $bm_id = request('bm_id');
        $imageurl = $this->baseurl.'public/assets/images/scene/';
        $bannerData = DB::table('1_scene_banner_list as sbl')
                        ->select(DB::raw('CONCAT("'.$imageurl.'", sbl.sbl_file) AS imgUrl'))
                        ->where('bm_id',$bm_id)->first();
        if($bannerData)
        {
            $res['code'] = 200;
            $res['img'] = $bannerData->imgUrl;
        }else {
            $res['code'] = 404;
        }
        
        return $res;
    }
    
    public function GetTreasureHuntGameList(Request $request)
    {
        $res = array();
        $bm_id = request('bm_id');
        $imageurl = $this->baseurl.'public/assets/images/treasure/game/';
        $data = TreasureGameMaster::GetGameList($bm_id);
        
        if($data['locations']) {
            $locations = $data['locations'];
            $res['position'] = json_decode($locations->tgl_position,true);
            $res['rotation'] = json_decode($locations->tgl_rotation,true);
            $res['scale'] = json_decode($locations->tgl_scale,true);
        }
        else {
            
        }
        
        foreach($data['gameList'] as $key => $detail) {
            $res['games'][$key]['name'] = $detail->game_name;
            $res['games'][$key]['point'] = $detail->game_points;
            $res['games'][$key]['imgurl'] = $imageurl.$detail->img_url;
            $res['games'][$key]['hint'] = $detail->tgm_hint;
            $res['games'][$key]['category'] = $detail->category_name;
            $res['games'][$key]['category_id'] = $detail->cat_id;
            
            $res['games'][$key]['position'] = json_decode($detail->tgmm_position,true);
            $res['games'][$key]['rotation'] = json_decode($detail->tgmm_rotation,true);
            $res['games'][$key]['scale'] = json_decode($detail->tgmm_scale,true);
            
        }
        return $res;
    }
    
    public function GetQuizQuestionList(Request $request) 
    {
        $bm_id = request('bm_id');
        $bm_id = 19;
        $tgm_id = request('game_level_id');
        $fileurl = $this->baseurl.'assets/quiz/';
        $questionData = DB::table('1_quiz_master')
    	            ->select('qm_type as question_type','qm_name as question_name',
    	            DB::raw('CONCAT("'.$fileurl.'", qm_audio_video) AS question_url'),'qm_opt_1 as option_1','qm_opt_2 as option_2','qm_opt_3 as option_3','qm_opt_4 as option_4','qm_ans as answer')
    	            ->where('bm_id',$bm_id)
    	            //->where('tgm_id',$tgm_id)
    	            ->where('status','active');
    	        
    	 if($questionData->count())
    	 {
    	    $questionData = $questionData->get();
    	    $res['questions'] = $questionData;
            $res['code'] = 200;
    	 }
    	 else
    	 {
    	    $res['code'] = 400;
    	 }
    	 
    	 return $res;
    }
    
   
   public function getInnovationSummitData(Request $request)
{
    $res = array();

    $videoUrl = $this->baseurl.'/public/assets/images/homepage/';

    $innovationData = DB::table('1_innovation_summit_data as isd')
        ->select(
            DB::raw('CONCAT("'.$videoUrl.'", isd.video_url) AS video_url'),
            'isd.convaiid_1',
            'isd.convaiid_2',
            'isd.convaiid_3',
            'isd.convaiid_4',
            'isd.convaiid_1_name',
            'isd.convaiid_2_name',
            'isd.convaiid_3_name',
            'isd.convaiid_4_name'
        )
        ->where('isd_status', 'active')
        ->where('bm_id', 9)
        ->first();

    if ($innovationData) {
        $res['videourl'] = $innovationData->video_url;
        $res['convaiid_1'] = $innovationData->convaiid_1;
        
        $res['convaiid_2'] = $innovationData->convaiid_2;
        $res['convaiid_3'] = $innovationData->convaiid_3;
        $res['convaiid_4'] = $innovationData->convaiid_4;
        $res['convaiid_1_name'] = $innovationData->convaiid_1_name;
        $res['convaiid_2_name'] = $innovationData->convaiid_2_name;
        $res['convaiid_3_name'] = $innovationData->convaiid_3_name;
        $res['convaiid_4_name'] = $innovationData->convaiid_4_name;
    }

    return $res;
} 

public function getInnovationSummiBoothtData(Request $request)
{
    $res = array();

    $videoUrl = $this->baseurl . 'public/assets/images/innovationsummit/';
    $imageUrl = $this->baseurl . 'public/assets/images/mintdigital/';

    $innovationData = DB::table('1_innovation_summit_booth_data as isd')
        ->select(
            DB::raw('CONCAT("' . $videoUrl . '", isd.isd_video_url) AS video_url'),
            DB::raw('CONCAT("' . $videoUrl . '", isd.video_url_2) AS video_url2'),
            DB::raw('CONCAT("' . $imageUrl . '", isd.poster2_url) AS image_url'),
            DB::raw('CONCAT("' . $imageUrl . '", isd.pdf_url) AS pdf_url'),
            'isd.convai_character_Id as convai_id',
            'isd.charcter_id as character_id',
            'isd.isd_boothid as booth_id', 
            'isd.bits_url as bits_url', 
            'isd.spatial_url as spatial_url' 
        )
        ->where('isd_status', 'active')
        ->where('bm_id', 9)
        ->limit(2)
        ->get();

    if ($innovationData->isNotEmpty()) {
        $boothData = [];
        foreach ($innovationData as $data) {
            $boothData[] = [
                "boothid" => $data->booth_id,
                "infomp3" => "",
                "videoplayerURL" => $data->video_url,
                "poster1url" => "null",
                "poster2url" => $data->image_url,
                "boothLogo" => "null",
                "isConvai" => true,
                "convaicharacterId" => $data->convai_id,
            ];
        }

        $res['Boothdata'] = $boothData;
        // $res['videourl'] = $boothData[0]['videoplayerURL'];
        $res['videourl'] = $innovationData[0]->video_url2;
        // $res['videourl2'] = $innovationData[1]->video_url2;
        $res['bitsurl'] = $innovationData[0]->bits_url;
        $res['spatialurl'] = $innovationData[0]->spatial_url;
        $res['pdfurl'] = $innovationData[1]->pdf_url;
        $res['characterID'] = $innovationData[1]->character_id;
        $res['code'] = 200;
    } else {
        $res['Boothdata'] = [];
        $res['videourl'] = '';
        $res['videourl2'] = '';
        $res['pdfurl'] = '';
        $res['code'] = 404;  
    }

    return $res;
}


    public function MobileLoginUser(Request $request)
    {
        $isExist = DB::table('1_user_login_master')->where('ulm_email',request('email'))->first();
        if($isExist)
        {
            $res['msg']='200';
        }
        else{
            $lmId = DB::table('1_user_login_master')->insertGetId([
        	                'ulm_email' => request('email'),
        	                'ulm_agent' => request('uagent'),
        	            ]);
        	 $res['code']=200;
        }
        return $res;
        
    }
    
    
    public function getVimeoData(Request $request)
{
    $res = array();

    $videoData = DB::table('1_get_vimeo_data as gvd')
        ->select('gvd.gvd_video_url as video_url')
        ->where('status', 'active')
        ->where('bm_id', 9)
        ->get();

    if (!$videoData->isEmpty()) {
        $res['videourl'] = $videoData->first()->video_url;
        $res['code'] = 200;
    } else {
        $res['videourl'] = "";
        $res['code'] = 404;
    }

    return $res;
}

public function GetNappavalleryData(Request $request)
{
    $res = array();
    $bm_id = request('bm_id');
    $napavalleyData = DB::table('1_nappavalley-data as gnd')
                    ->select('gnd.convai_character_id as convai_id')
                    ->where('status', 'active')
                    //->where('bm_id', $bm_id)
                    ->first();

    if ($napavalleyData) {
        $res['characterID'] = $napavalleyData->convai_id;
    } 
    
    else {
        $res['characterID'] = "";
    }

    return $res;
}
    
    public function GetTotalRegisteredUser(Request $request) 
    {
        $bm_id=request('bm_id');
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
    
    public function GetUserActivityList(Request $request)
    {
        $bm_id=request('bm_id');
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
    
    public function GetDashboardSettingData(Request $request)
    {
        $bm_id = $request->bm_id;
        $fileurl = $this->baseurl . 'public/assets/images/dashboard/';
        $dashboardData = DB::table('1_dashboard_setting_master as dsm')
                        ->select(
                            DB::raw('CONCAT("' . $fileurl . '", dsm.logo) AS logo'),
                            DB::raw('CONCAT("' . $fileurl . '", dsm.background_img) AS bgimg'),
                            'title','news_text as newsfeed','short_title as slug')
                        ->where('bm_id',$bm_id)
                        ->first();
        return $dashboardData;
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
            
        return $res; 
                        
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
}