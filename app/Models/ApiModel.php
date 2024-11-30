<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ApiModel extends Model
{
    
    public static function interAttadenceMapping($lmId,$bm_id,$basicData)
    {
        $resArray=array();

        ## Check Entry Exist ##
            $leadDetailsAgainstEvent=ApiModel::getLeadMaster($lmId,$bm_id,$basicData);;
        
            if(!empty($leadDetailsAgainstEvent->lemm_id)){
                $attandenData = DB::table('1_lead_event_master_mapping_attendance')
                        ->where('lemm_id', $leadDetailsAgainstEvent->lemm_id)
                        ->whereDate('lemma_datetime', 'like', date('Y-m-d'))
                        ->first();

                ## Set Save Data ##
                $saveInMappingTable=array();
                $saveInMappingTable['lemm_id']=$leadDetailsAgainstEvent->lemm_id;
    
                if(empty($attandenData)){
                    ## Save Attandence ##
                    $lemmaId = DB::table('1_lead_event_master_mapping_attendance')->insertGetId(
                        $saveInMappingTable
                    );  

                }else{
                   
                    $lemmaId=$attandenData->lemma_id;
                    ## Update Attandence##
                    $saveInMappingTable['lemma_last_seen']=date('Y-m-d H:i:s');
                    DB::table('1_lead_event_master_mapping_attendance')
                    ->where('lemma_id','=',$lemmaId)
                    ->update(
                        $saveInMappingTable
                    ); 
                }
            }
            return $lemmaId;
    }
    
    public static function getLeadMaster($lmId,$bm_id,$basicData)
    {
       
        $resArray=array();
        $eventdetail=$basicData;
        $aem_id = 1;
        
        ## Genrate OTP ##
            $datar = DB::table('1_lead_master as lm');
            $datar->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id');
            $datar->where('lemm.lm_id', $lmId);
            $datar->where('lemm.aem_id', $aem_id);
            $datar->where('lemm.bm_id', $bm_id);
            $resArray=$datar->first();
            return  $resArray;
    }
    
    public static function getEventDetails($requestData)
    {
        $eventData=array();
        if(isset($requestData['curevent'])){
           ## Get Brand List##
             $eventData= DB::table('1_event_master')
                        ->where('aem_status','current')
                        ->where('aem_event_nickname',$requestData['curevent'])
                        ->first();
        }
        return $eventData;
    }
    
    public static function ActivityHere($allRequestData)
    {
        
        if(!empty($allRequestData['exhid']) && !empty($allRequestData['activeId'])){
        
            $user = ApiModel::getLeadDataById($allRequestData['username'],$allRequestData['lemm_id']);

            $leemId=null;
            $exhim_id=$allRequestData['exhid'];
            $activeId=$allRequestData['activeId'];

            ## Is lead_event_exhibitor_mapping ##
            $isExist = ApiModel::getLeadEventExhibitorMapping($exhim_id,$user);
            
            if(!empty($isExist->leem_id)){
                $leemId =$isExist->leem_id;
            }else{
                $leemId = DB::table('1_lead_event_exhibitor_mapping')->insertGetId(
                    array(
                        'lemm_id' => $user->lemm_id,
                        'exhim_id' => $exhim_id
                    )
                );
            }
            if(!empty($leemId)){
                $resArray['leemId']=$leemId;
                $leadActivityWithExhibitor=ApiModel::getLeadEventExhibitorMappingActivity($leemId,$activeId);
                if(empty($leadActivityWithExhibitor->leema_id)){

                    $saveData=array();
                    $saveData['am_id']=$activeId;
                    $saveData['leem_id']=$leemId;
                    $saveData['lemm_id']=$user->lemm_id;
                    $saveData['leema_ip']=ApiModel::realIp();
                    
                    $leemaId = DB::table('1_lead_event_exhibitor_mapping_activity')->insertGetId(
                        $saveData
                    );
                    $resArray['action']="insert";
                }else{
                    if($activeId=='7' && !empty($leadActivityWithExhibitor->leema_id)){
                        DB::table('1_lead_event_exhibitor_mapping_activity')
                                ->where('leema_id', $leadActivityWithExhibitor->leema_id)
                                ->delete();
                        $resArray['action']="deleted";
                    }
                    $leemaId=$leadActivityWithExhibitor->leema_id;

                }
                $resArray['leemaId']=$leemaId;
            }

        }
        return $resArray;
    }
    
    public static function realIp()
    {
        if (!empty($_SERVER["HTTP_CLIENT_IP"]))
        {
            //check for ip from share internet
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
        {
            // Check for the Proxy User
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        else
        {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        return $ip;
    }
    
    
    public static function getLeadEventExhibitorMapping($exhim_id,$user)
    {
        $resArray = array();
        if(!empty($exhim_id) && !empty($user->lemm_id)){

            $resArray = DB::table('1_lead_event_exhibitor_mapping')
            ->where('exhim_id', $exhim_id)
            ->where('lemm_id', $user->lemm_id)
            ->first();
        }

        return $resArray;
    
    }
    
    
    public static function getLeadEventExhibitorMappingActivity($leemId,$amId)
    {
        $resArray = array();
        if(!empty($leemId) && !empty($amId)){

            $resArray = DB::table('1_lead_event_exhibitor_mapping_activity')
            ->where('am_id', $amId)
            ->where('leem_id', $leemId)
            ->first();
        }

        return $resArray;
    
    }
    
    public static function getLeadDataById($username,$lemmId)
    {
        $emailId = $username;
        
        $details = DB::table('1_lead_master as lm')
                    ->Join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                    ->where('lm.lm_email',$emailId)
                    ->where('lemm.lemm_id',$lemmId)
                    ->first();
                    
        return $details;
    }
    
    
    public static function getUserSlides($lemmId,$userType)
    {
        $result = array();
        if($userType=='speaker')
        {
            $result = DB::table('1_slide_master')->where('lemm_id',$lemmId)->pluck('sm_image');
            
            return $result;
        }
        else{
            return $result;
        }
    }
    
    public static function GetJourneyVideoURL($bm_id)
    {
        $videourl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/videos/journey/';
        
        $detail = DB::table('1_journey_video_master as jvm')
                    ->select(DB::raw('CONCAT("'.$videourl.'", jvm.jvm_file) AS video_url'))
                    ->where('jvm.bm_id',$bm_id)
                    ->where('jvm.jvm_status','active')
                    ->first();
        if($detail)
        {
           return $detail->video_url;
        }
        else{
            return '';
        }
    }
    
    public static function CheckServiceEnable($service)
    {
        $service = DB::table('1_app_feature_master as afm')
                        ->Join('1_feature_setting_against_an_event as fsae', 'fsae.afm_id','afm.afm_id')
                        ->Select('fsae.fsae_status')
                        ->where('afm.afm_internal_used_name',$service)
                        ->where('fsae.fsae_status','active')
                        ->first();
                        
        if($service)
        {
            return 'success';
        }
        else {
            return 'failed';
        }
    }
    
    public static function isOTPEnabledOld()
    {
        $status = 'inactive';
        
        $otpService = DB::table('1_app_feature_master')->Select('afm_status')->where('afm_internal_used_name','otp-notification')->first();
        
        if($otpService->afm_status == 'active')
        {
            $emailService = DB::table('1_app_feature_master')->Select('afm_status')->where('afm_internal_used_name','email-service')->first();
            if($otpService->afm_status == 'active')
            {
                $status = 'active';
            }
        }
        
        return $status;
    }
    
    public static function isOTPEnabled($bm_id)
    {
        $status = 'inactive';
        
        $otpService = DB::table('1_app_feature_master as afm')
                        ->Join('setting_mappings as sm', 'sm.afm_id','afm.afm_id')
                        ->Select('sm.sm_status')
                        ->where('afm.afm_internal_used_name','otp-notification')
                        ->where('sm.bm_id',$bm_id)
                        ->first();
        
        if($otpService && $otpService->sm_status == 'active')
        {
            $emailService = DB::table('1_app_feature_master as afm')
                        ->Join('setting_mappings as sm', 'sm.afm_id','afm.afm_id')
                        ->Select('sm.sm_status')
                        ->where('afm.afm_internal_used_name','email-service')
                        ->where('sm.bm_id',$bm_id)
                        ->first();
            
            if($emailService && $emailService->sm_status == 'active')
            {
                $status = 'active';
            }
        }
        return $status;
    }
    
    public static function GetMentorByCatId($mcm_id)
    {
        
    
         $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/images/mentors/';
         $videourl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/videos/';
         $asseturl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/';
         $mentorList = DB::table('1_mentor_master as mm')
        // ->Join('1_mentor_category_master as mcm', function($join){
        // $join->on(DB::raw("FIND_IN_SET(mcm.mcm_id, mm.mcm_id)",''));
        //  })
        ->select(DB::raw('CONCAT("'.$imageurl.'", mm_mentor_image) AS mentor_image,CONCAT("'.$videourl.'", mm_video_clip) AS video_clip,CONCAT("'.$videourl.'", mm_greenscreen_video) AS green_video,CONCAT("'.$asseturl.'", mm_audio_clip) AS audio_clip'),'mm_mentor_name as mentor_name','mm_mentor_designation as designation','mm_mentor_description as about_mentor','mm_avatar_link as avatar_link',
            'mm_video_text as video_text','mm_achievement as achievement')
             ->whereRaw("FIND_IN_SET(?, mcm_id) > 0", [$mcm_id])
           
            ->get();
            
        return $mentorList;
    }
    
    public static function GetTeamByCatId($tcm_id)
    {
         $imageurl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/images/mentors/';
         $videourl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/videos/';
         $asseturl='https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/';
        $teamList = DB::table('1_team_master')
            ->select(DB::raw('CONCAT("'.$imageurl.'", tm_team_image) AS team_image,CONCAT("'.$videourl.'", tm_video_clip) AS video_clip,CONCAT("'.$videourl.'", tm_greenscreen_video) AS green_video,CONCAT("'.$asseturl.'", tm_audio_clip) AS audio_clip'),'tm_team_name as team_name','tm_team_designation as designation','tm_team_description as about_team','tm_avatar_link as avatar_link',
            'tm_video_text as video_text','tm_achievement as achievement')
             ->whereRaw("FIND_IN_SET(?, tcm_id) > 0", [$tcm_id])
            ->get();
            
        return $teamList;
    }
    
    public static function updateLeadMappingData($lemm_id,$bm_id,$bm_ids)
    {
        $bmId_array = explode(',',$bm_ids);
        if(!in_array($bm_id,$bmId_array))
        {
            array_push($bmId_array,$bm_id);
            $bmId_str = implode(',',$bmId_array);
            DB::table('1_lead_event_master_mapping')->where('lemm_id',$lemm_id)->update(['bm_id'=>$bmId_str]);
            return 'insert';
        }
        else {
            return 'exist';
        }
    }
    
    
    public static function CheckAppFeatureSetting($bm_id)
    {
        $res = array();           
        $featureList = DB::table('1_app_feature_master as afm')
                    ->select('afm.afm_id','afm.afm_name','afm.afm_internal_used_name as afm_nick_name')
                    ->where('afm.afm_status','active')
                    ->get();
        
        foreach($featureList as $key => $detail)
        {
            $isEnable = DB::table('setting_mappings as sm')
                        ->where('bm_id',$bm_id)
                        ->where('afm_id',$detail->afm_id)
                        ->where('sm_status','active')
                        ->first();
            
            $res[$key]['name'] = $detail->afm_name;
            $res[$key]['short_name'] = $detail->afm_nick_name;
            $res[$key]['is_enable'] = $isEnable ? 'yes' : 'no';
        }
        return $res;
    }
    
    
    public static function CreateConvaiCharacterId($options)
    {
        $createUrl = config('app.convai_baseurl').'create';
        $ch = curl_init($createUrl);
        $headers = array(
            'Content-Type: application/json',
            'CONVAI-API-KEY: '.config('app.convai_app_key'),
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
    
    
    public static function GetConvaiSettingData($bm_id)
    {
        $convaiData = DB::table('1_convai_setting_master')->where('bm_id',$bm_id)->first();
        if($convaiData)
        {
            $res['code'] = 200;
            $res['app_id'] = $convaiData->csm_app_id;
        }
        else
        {
            $res['code'] = 404;
        }
        
        return $res;
    }
    
    public static function GetConvaiCharacterId($bm_id)
    {
        $convaiData = DB::table('1_convai_character_id_master')->where('bm_id',$bm_id)->first();
        if($convaiData)
        {
            $res['code'] = 200;
            $res['convai_id'] = $convaiData->app_id;
            $res['convai_name'] = $convaiData->convai_name;
        }
        else
        {
            $res['code'] = 404;
        }
        
        return $res;
    }
    
    public static function GetTreasureHuntStatusById($bm_id,$lemm_id)
    {
        $ticketData = DB::table('1_ticket_data')->where('lemm_id',$lemm_id)->where('bm_id',$bm_id)->first();
        if($ticketData)
        {
            return $ticketData->is_treasure_hunt;
        }
        else{
            return 'active';
        }
    }
    
    public static function IsServiceEnable($servicename,$bm_id)
    {
        $status = 'inactive';
        
        $isService = DB::table('1_app_feature_master as afm')
                        ->Join('setting_mappings as sm', 'sm.afm_id','afm.afm_id')
                        ->Select('sm.sm_status')
                        ->where('afm.afm_internal_used_name',$servicename)
                        ->where('sm.bm_id',$bm_id)
                        ->first();
        
        if($isService && $isService->sm_status == 'active'){
           $status = 'active';
        }
        
        return $status;
    }
    
    public static function GetTreasureLevelId($levelname)
    {
        $data = DB::table('1_treasure_game_master')
                ->where('game_name','LIKE','%'.$levelname.'%')
                ->select('tgm_id')
                ->first();
        return $data;
    }
    
    public static function SendThankYouMail($email)
    {
        $response = array();
        $listDetail = DB::table('1_lead_master as lm')
                    ->Join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                    ->Select('lm.lm_fullname','lm.lm_email','lm.lm_company_name','lm.lm_id')
                    ->where('lm.lm_email',$email)
                    ->first();
                        
        if($listDetail)
        {
            $email_to = $listDetail->lm_email;
            $bcc_to = ['harpreet@ibentos.com'];
            
            try{
                 
                 $response = Mail::send('emailer.register_thankyou_mail', ['data' => $listDetail], function ($m) use ($email_to,$bcc_to) {
                     $m->from('invitation@smartevents.in', 'Mint Digital Innovation Summit 2024');
                     $m->to($email_to)->subject("New User Registration");
                     $m->bcc($bcc_to);
                    });
               
            } catch(\Exception $e){
                echo $e;
            }
        }
    }
    
    
    public static function SendMailOTPVerify($email)
    {
        $res = array();
        $listDetail = DB::table('1_lead_master as lm')
                        ->Join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                        ->Select('lm.lm_fullname','lm.lm_email','lm.lm_id')
                        ->where('lm.lm_email',$email)
                        ->first();
                        
        $otp = rand(100000,999999);
        
        if($listDetail)
        {
            $email_to = $listDetail->lm_email;
            $mailer_logo = '';
            try{
                 $response = Mail::send('emailer.email_otp_verify', ['data' => $listDetail,'otp'=>$otp, 'mailer_logo'=>$mailer_logo], function ($m) use ($email_to) {
                     $m->from('invitation@smartevents.in', 'SBI Life');
                     $m->to($email_to)->subject("OTP: Login Verification");
                    });
                
                DB::table('1_lead_master')->where('lm_id',$listDetail->lm_id)->update(['lm_otp'=>$otp]);
                $res['code']=200;
            } catch(\Exception $e){
                $res['code'] = 404;
            }
        }
        else{
            $res['code'] = 404;
        }
        
        return $res;
    }
    
    public static function UpdateLeadDataById($lmId,$upData)
    {
        if(!empty($upData))
        {
            DB::table('1_lead_master')->where('lm_id',$lmId)->update($upData);
        }
        
    }
    
    
    public static function GetLeadDataByLemmId($lemmId,$tokenId)
    {
        $listDetail = DB::table('1_lead_master as lm')
                    ->Join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                    ->Select('lm.lm_fullname','lm.lm_company_name','lm.lm_id')
                    ->where('lemm.lemm_id',$lemmId)
                    ->where('lm.lm_token_id',$tokenId)
                    ->first();
                    
        return $listDetail;
    }
    
    public static function SendRegisterApprovalMail($email)
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
            $bcc_to = ['karishma@ibentos.com','monu@ibentos.com'];
            
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
    
}
