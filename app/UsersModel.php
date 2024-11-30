<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\HelperController;

class UsersModel extends Model
{
   
   
    public static function getbrandDetails($brand)
    {
        $brandData=array();
        if(isset($brand)){
                ## Get Brand List##
                $brandData= DB::table('brand_organizer_master')
                ->where('bm_status','active')
                ->where('bm_nickname',$brand)
                ->first();
        }
        return $brandData;
    }
    public static function getEventDetails($tdetail,$requestData)
    {
        $eventData=array();
        if(isset($requestData->brand) && isset($requestData->curevent)){
           ## Get Brand List##
             $eventData= DB::table($tdetail['event_master'])
                        ->where('aem_status','current')
                        ->where('aem_event_nickname',$requestData->curevent)
                        ->first();
        }
        return $eventData;
    }


## ========================================================================================== ##

    public static function isExistInLeadEvantMasterMapping($lmId,$basicData)
    {
       
        $resArray=array();
        $tdetail=$basicData['tdetail'];
        $eventdetail=$basicData['event'];
        $branddetail=$basicData['brand'];

        ## Genrate OTP ##
            $datar = DB::table($tdetail['lead_event_master_mapping']);
            $datar->where('aem_id', $eventdetail->aem_id);
            $datar->where('lm_id', $lmId);
            $resArray=$datar->first();
            return  $resArray;
    }

    public static function checkUniqueField($allRequestData,$basicData)
    {
       
        $resArray=array();
        $tdetail=$basicData['tdetail'];
        $eventdetail=$basicData['event'];
        $branddetail=$basicData['brand'];

        ## Genrate OTP ##
            $datar = DB::table($tdetail['lead_master'])
            ->select('lm_id','lm_is_verified');
            if($branddetail->bm_unique_field=='lm_email'){
                $datar->where($branddetail->bm_unique_field, $allRequestData['email']);
            }else{
                $datar->where($branddetail->bm_unique_field, $allRequestData['mobile']);
            }

            $resArray=$datar->first();
            return  $resArray;
    }

   
    public static function getLeadMaster($lmId,$basicData)
    {
       
        $resArray=array();
        $tdetail=$basicData['tdetail'];
        $eventdetail=$basicData['event'];
        $branddetail=$basicData['brand'];

        ## Genrate OTP ##
            $datar = DB::table($tdetail['lead_master'].' as lm');
            $datar->join($tdetail['lead_event_master_mapping'].' as lemm', 'lemm.lm_id','lm.lm_id');
            $datar->where('lemm.lm_id', $lmId);
            $datar->where('lemm.aem_id', $eventdetail->aem_id);
            $resArray=$datar->first();
            return  $resArray;
    }
   
    ## separate functions ##
    public static function callregistration($allRequestData,$basicData)
    {
        $resArray=array();
        $resArray['IsBypassOtpPage']='N';
        $tdetail=$basicData['tdetail'];
        $eventdetail=$basicData['event'];
        

        ## Genrate OTP ##
        $opt=HelperController::generate_otp($num=4,$alpha=0,$numNonAlpha=0);
        $saveData=array();
        $saveInMappingTable=array();
        $saveInMappingTable['lemm_ip']=HelperController::realIp();
        
        $saveData['lm_fullname']=$allRequestData['fullname'];
        $saveData['lm_mobile']=$allRequestData['mobile'];
        $saveData['lm_otp']=$opt;
        $saveData['lm_email']=$allRequestData['email'];

        if(isset($allRequestData['education']) && !empty($allRequestData['education'])){
            $saveInMappingTable['qm_id']=$allRequestData['education'];
        }

        if(isset($allRequestData['course']) && !empty($allRequestData['course'])){
            $courseSet= implode(',', $allRequestData['course']);
            $saveInMappingTable['pm_id']=$courseSet;
        }

        if(isset($allRequestData['city']) && !empty($allRequestData['city'])){
            $saveData['city_id']=$allRequestData['city'];
        }


       
        $isdata=UsersModel::checkUniqueField($allRequestData,$basicData);

        if(isset($isdata->lm_id) && !empty($isdata->lm_id)) {

            ## UPDATE Lead ##
            $result = DB::table($tdetail['lead_master'])
            ->where('lm_id', $isdata->lm_id)
            ->update(
                $saveData
            );

             ## Check eventId mapped In LeadEvantMasterMapping ##
             $isExistLeadInEvant=UsersModel::isExistInLeadEvantMasterMapping($isdata->lm_id,$basicData);
             
             if(empty($isExistLeadInEvant)){
                ## Insert Mapping ##
                 $saveInMappingTable['aem_id']=$eventdetail->aem_id;
                 $saveInMappingTable['lm_id']=$isdata->lm_id;
     
                 $lemmId = DB::table($tdetail['lead_event_master_mapping'])->insertGetId(
                     $saveInMappingTable
                 );  

             }else{
                ## Update Mapping ##
                $lemmId = DB::table($tdetail['lead_event_master_mapping'])
                ->where('lemm_id', $isExistLeadInEvant->lemm_id)
                ->update(
                    $saveInMappingTable
                );  

             }

            $id=$isdata->lm_id;
            if($isdata->lm_is_verified=='Y'){
                $resArray['IsBypassOtpPage']='Y';
                $resArray['data']=UsersModel::getLeadMaster($isdata->lm_id,$basicData);
            }

            
        } else {
            ## Insert Lead Master Table##
            $id = DB::table($tdetail['lead_master'])->insertGetId(
                $saveData
            );
            
            ## Insert  LeadEventMasterMapping Table##
            $saveInMappingTable['aem_id']=$eventdetail->aem_id;
            $saveInMappingTable['lm_id']=$id;

            $lemmId = DB::table($tdetail['lead_event_master_mapping'])->insertGetId(
                $saveInMappingTable
            );  

            $phone=trim($allRequestData['mobile']);
            $templateId='76333'; 
            $dynamicFieldArray=array();
            $dynamicFieldArray['F1']=$opt;

            $resArray['sms']=HelperController::callSmsApi($phone, $templateId, $dynamicFieldArray);
        }

        $resArray['id']=$id;
        //$resArray['otp']=$opt;
        $resArray['mobile']=$allRequestData['mobile'];
        return $resArray;
    }

    public static function verifyhere($allRequestData,$basicData)
    {
       
        $tdetail=$basicData['tdetail'];
        $eventdetail=$basicData['event'];
        $vfid=trim($allRequestData['vfid']);


        $votp=implode('', $allRequestData['votp']);
        
        ## Genrate OTP ##
        $datar = DB::table($tdetail['lead_master'])
        //->where('aem_id', $eventdetail->aem_id)
        ->where('lm_mobile', $allRequestData['mobile'])
        ->where('lm_otp', $votp)
        ->where('lm_id', $vfid)
        ->first();

        ## Update Verify Status ##
        if(!empty($datar)){
            DB::table($tdetail['lead_master'])
            ->where('lm_id', $vfid)
            ->update(['lm_is_verified' => 'Y']);
        }
        return $datar;
    }

    
}
?>
