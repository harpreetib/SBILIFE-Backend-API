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

class ComModel extends Model
{
    

    public static function getCityMaster($stateId=null)
    {
        $cityMasterData=array();
        $cityMasterSql= DB::table('master_city')
        ->where('cm_status','active');
        if(!empty($stateId)){
            $cityMasterSql->where('sm_id',$stateId);
        }
        $cityMasterSql->orderBy('cm_name','ASC');
        $cityMasterData=$cityMasterSql->get();
        return $cityMasterData;
    }
    public static function getStateMaster($countryId=null)
    {
        $stateMasterData=array();
        $stateMaster= DB::table('master_state')
        ->where('sm_status','active');
        if(!empty($countryId)){
            $stateMaster->where('counm_id',$countryId);
        }
        $stateMaster->orderBy('sm_name','ASC');
        $stateMasterData=$stateMaster->get();
        return $stateMasterData;
    }
    public static function getLeadCategorization()
    {
        $tdetail=Session('tdetail');
        $profileDetail=Session('profileDetail');
        $eventDetails=Session('selectedEvent');

        $getData=array();
        $sql= DB::table('1_lead_categorization')
        ->where('lc_status','active');
        $sql->orderBy('lc_orderby','ASC');
        $getData=$sql->get();
        return $getData;
    }

    public static function getExhibitorRemark($leemId)
    {
        $tdetail=Session('tdetail');
        $profileDetail=Session('profileDetail');
        $eventDetails=Session('selectedEvent');

        $remarkList=DB::table($tdetail['lead_event_exhibitor_mapping_remark'].' as leemr')
        ->leftJoin($tdetail['exhibitor_boothstaff'].' as ebs','ebs.ebsm_id','leemr.leer_updateby')
        ->leftJoin($tdetail['lead_categorization'].' as lc','lc.lc_id','leemr.lc_id')
        ->select('leemr.*','lc.lc_text','ebs.ebsm_name as user_name')
        ->where('leemr.leem_id', $leemId)
        ->orderBy('leemr.leer_id', 'DESC')->get();
    
        return $remarkList;
    }


    public static function getCourseMasterByExhibitor()
    {

            $tdetail=Session('tdetail');
            $profileDetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');

            $AddedCourse=DB::table('1_exhibitor_product_master as epmas')
            ->join('1_parent_product_master as ppm', 'epmas.ppm_id', 'ppm.ppm_id')
            ->join('1_exhibitor_product_mapping as epm' , 'epmas.exhipm_id', 'epm.exhipm_id')
             //->leftJoin('1_parent_product_master_mapping as ppmm', 'epmas.ppmm_id', 'ppmm.ppmm_id')
            
            ->leftJoin(\DB::raw("(

            SELECT 
                epmass.exhipm_id as expmidd, 
                GROUP_CONCAT(CONCAT('<li>',ppmmm.`ppmm_text`,'</a>') SEPARATOR ' ' ) as 'ppmmm_text'

                FROM 
                    `1_exhibitor_product_master` as epmass
                join `1_parent_product_master_mapping` as ppmmm ON  FIND_IN_SET(ppmmm.`ppmm_id`, epmass.`ppmm_id`)
                WHERE 1
                group by epmass.exhipm_id) as qmm"),
                    function ($join) {
                        $join->on('qmm.expmidd', '=', 'epmas.exhipm_id');
            })
            
            ->leftJoin(\DB::raw("(

            SELECT 
                expm.epm_id as expmid, 
                GROUP_CONCAT(CONCAT('<li>',qum.`qm_text`,'</a>') SEPARATOR ' ' ) as 'qm_text'

                FROM 
                    `1_exhibitor_product_mapping` as expm
                join `1_qualification_master` as qum ON  FIND_IN_SET(qum.`qm_id`, expm.`qm_id`)
                WHERE 1
                group by expm.epm_id) as qm"),
                    function ($join) {
                        $join->on('qm.expmid', '=', 'epm.epm_id');
            })
           
            ->where('epm.exhim_id',$profileDetail->exhim_id)
            ->where('epm.epm_status','active')
            ->select(
                'qm.*',
                'epm.*',
                'ppmmm_text',
                //'ppmm.ppmm_text',
                'ppm.*',
                'epmas.*',
                DB::raw(" (CASE WHEN ppm.ppm_is_others = 'Y' && epm.ppm_other_text IS NOT NULL THEN CONCAT(ppm.ppm_text,'( ', epm.ppm_other_text ,' )') ELSE ppm.ppm_text END) AS ppm_customText ")
             )
            ->orderBy('epm.epm_id','DESC')
            ->get();

            return $AddedCourse;

    }

   /*----------------------Start Masters--------------------------------*/
    public static function getQualificationMaster($basicData)
    {
        $qualiMData=array();
        $tdetail=$basicData['tdetail'];
        $eventdetail=$basicData['event'];

        $qualiMData= DB::table($tdetail['qualification_master'])
        ->where('qm_status','active')
        ->orderBy('qm_orderby','ASC')
        ->get();
        return $qualiMData;
    }
    public static function getCourseMaster($basicData)
    {
        return ComModel::getParentProductMaster($basicData);
    }
    public static function getParentProductMaster($basicData)
    {
        $parentProductMaster=array();
        $tdetail=$basicData['tdetail'];
        $eventdetail=$basicData['event'];

        $parentProductMaster= DB::table('1_parent_product_master as ppm')
        ->leftJoin('1_parent_product_master_mapping as ppmm',  'ppmm.ppm_id', '=', 'ppm.ppm_id')
        ->select('ppm.ppm_id','ppm.ppm_id as key','ppm.ppm_text as value')
        ->where('ppm.ppm_status','active')
        ->groupBy('ppm.ppm_id')
        ->orderBy('ppm.ppm_orderby','ASC')
        ->get();
        return $parentProductMaster;
    }

    public static function getCityMasterByCityId($cityId)
    {
        $cityMasterData=array();
        $cityMasterSql= DB::table('master_city')
        ->where('cm_status','active')
        ->where('cm_id',$cityId)
        ->orderBy('cm_name','ASC');
        $cityMasterData=$cityMasterSql->first();
        return $cityMasterData;
    }

   
    public static function isAboutuDataFilled($basicData, $lmId)
    {
        $isAbuFilled="N";
        $tdetail=$basicData['tdetail'];
        $eventdetail=$basicData['event'];
        $user = Session::get('user'); 
        if(!empty($lmId)){
            $datar = DB::table($tdetail['lead_master'])
            ->where('lm_id', $lmId)
            ->whereNotNull('pm_id')
            ->whereNotNull('qm_id')
            ->whereNotNull('city_id')
            ->first();
            if(!empty($datar)){
                $isAbuFilled="Y";
            }
        }

        return $isAbuFilled;
    }
    
    
    public static function getProductMasterWithMapping($aemId){
			
		$productArray=array();
	    $productMaster= ComModel::getProductMaster($aemId);
	    
	    foreach($productMaster as $key =>$productDetails){
	        $productArray[$key]['product']=$productDetails;
			
			$subProductList = DB::table('1_parent_product_master_mapping')
                            ->where('ppm_id', $productDetails->ppm_id)
                            ->where('ppmm_status', 'active')
                            ->get();
			
			$productArray[$key]['sub-product']=$subProductList;
	    }
		return $productArray;
	}
		
	public static function getProductMaster($aemId=null){
			
		$areaArray = DB::table('1_parent_product_master')
                        ->where('ppm_status', 'active')
                        ->where('ppm_is_show_frontend', 'Y');
                            
		if(!empty($aemId)){
			$areaArray = $areaArray->where('aem_id', $aemId);
		}
		
		$areaArray = $areaArray->get();
			
		return $areaArray;
	}
	
	public static function getParentProductMasterMappingDetail($ppmId,$ppmmId){
	    $ppArray = [];
	    $ppmDetail = DB::table('1_parent_product_master')
                        ->where('ppm_status', 'active')
                        ->whereIn('ppm_id', explode(',',$ppmId))
                        ->select(DB::raw('group_concat(ppm_text SEPARATOR "|") as ppm_text'))
                        ->first();
			
		$ppmmDetail = DB::table('1_parent_product_master_mapping')
                        ->where('ppmm_status', 'active')
                        ->whereIn('ppmm_id', explode(',',$ppmmId))
                        ->select(DB::raw('group_concat(ppmm_text SEPARATOR "|") as ppmm_text'))
                        ->first();
        
        $ppArray['ppmDetail'] = $ppmDetail->ppm_text;
        $ppArray['ppmmDetail'] = $ppmmDetail->ppmm_text;
        
        return $ppArray;
	}
	
	
	public static function getTotalConferenceVisitors($datefrom,$dateto,$leadType) {
	    
	    if(empty($datefrom)) {
	        $datefrom = date('Y-m-d');
	    }
	    
	    if(empty($dateto)) {
	        $dateto = date('Y-m-d');
	    }
        $tdetail=Session('tdetail');
        $selectedEvent=Session('selectedEvent');
        $AllEvent=Session('AllEvent');
        
        $total_visitors = DB::table('1_lead_event_activity_mapping as leam')
            ->leftJoin($tdetail['activity_master'].' as am', 'leam.am_id', 'am.am_id')
            ->leftJoin($tdetail['lead_event_master_mapping'].' as lemm', 'leam.lemm_id', 'lemm.lemm_id')
            ->leftJoin($tdetail['lead_master'].' as lm', 'lemm.lm_id', 'lm.lm_id')

            ->select('lm.*','am.*', 'leam.leam_datetime');
 
        if($AllEvent==false){
            $total_visitors->where('leam.aem_id',$selectedEvent->aem_id);
        }
        
        
        $total_visitors->where('leam.am_id',$leadType);
        
        
        if (!empty($datefrom) && !empty($dateto)){

            $total_visitors->whereDate('leam.leam_datetime','>=',$datefrom)
                            ->whereDate('leam.leam_datetime','<=',$dateto);
        }if (!empty($datefrom) && empty($dateto) ){

            $total_visitors->whereDate('leam.leam_datetime','=', $datefrom);
        }
        if (!empty($dateto) && empty($datefrom)){

            $total_visitors->whereDate('leam.leam_datetime','<=', $dateto);
            
        }
        
        $total_visitors = $total_visitors->count();
        
        return $total_visitors;
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
    
    public static function GetBrandMeetingData($lemmId,$bmId)
    {
        $leadData = DB::table('1_lead_master as lm')
                    ->join('1_lead_event_master_mapping as lemm','lemm.lm_id','lm.lm_id')
                    ->select('lm.lm_fullname')
                    ->where('lemm.lemm_id',$lemmId)
                    ->first();
                    
        if($leadData)
        {
            $meetingData = DB::table('1_event_launch as el')
                            ->join('1_event_launch_mapping as elm','elm.el_id','el.el_id')
                            ->select('elm.elm_daily_co_name as room_name')
                            ->where('el.el_unique_name','livestream')
                            ->where('elm.bm_id',$bmId)
                            ->first();
                            
            if($meetingData)
            {
                $res['room_name'] = $meetingData->room_name;
                $res['user_name'] = $leadData->lm_fullname;
                $res['status'] = 'success';
            }
            else
            {
                $res['status'] = 'failed';
            }
        }
        else
        {
            $res['status'] = 'failed';
        }
        
        return $res;
    }
    
    public static function UpdateTokenData($lemmId,$bm_id,$response)
    {
        $tokenData = json_decode($response,true);
        
        $insertData['dmt_token'] = $tokenData['token'];
        $insertData['token_response'] = $response;
            
        $tokenExist = DB::table('1_daily_meeting_user_token_list')
                        ->where('lemm_id',$lemmId)
                        ->where('bm_id',$bm_id)
                        ->first();
                        
        if($tokenExist)
        {
           DB::table('1_daily_meeting_user_token_list')
           ->where('lemm_id',$lemmId)
           ->where('bm_id',$bm_id)
           ->update($insertData);
           
        }
        else
        {
            $insertData['lemm_id'] = $lemmId;
            $insertData['bm_id'] = $bm_id;
            DB::table('1_daily_meeting_user_token_list')->insert($insertData);
        }
    }
    
    
    public static function UpdateConvaiId($exhim_id,$convai_id)
    {
        $isExist = DB::table('1_exhibitor_master as em')
                    ->where('exhim_id',$exhim_id)
                    ->first();
                    
        if($isExist){
            DB::table('1_exhibitor_master')->where('exhim_id',$exhim_id)->update(['exhim_convai_character_id'=>$convai_id]);
            return true;
        }
        return false;
        
    }
   
}