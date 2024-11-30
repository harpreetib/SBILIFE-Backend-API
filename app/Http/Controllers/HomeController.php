<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use Redirect;
use App\ComModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\HelController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\EnxRtc\RoomController;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\DailyApi\ApiController;

use ZipArchive;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    protected $eventDetails;

    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->basicData=HelController::setimpdata($request);
      $this->getBaseUrl=HelperController::getBaseUrl($request);
    }

    public function index()
    {
        return view('home',['prefix_url' => $this->getBaseUrl]);
    }

    public function dashboard(){
      
            $today=date('Y-m-d');
            $sessDetail=Session('profileDetail');
            
            $tdetail=Session('tdetail');
            $selectedEvent=Session('selectedEvent');
            $AllEvent=Session('AllEvent');
            
            ### Exhibitor Wise  
            $infoTotalcity=DB::table($tdetail['lead_master'] .' as lm')
                ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                ->leftJoin($tdetail['master_city'] .' as mc' ,'lm.city_id', 'mc.cm_id')
                 ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'lemm.lemm_id', 'leem.lemm_id')
                 ->where('leem.exhim_id',$sessDetail->exhim_id);
            if($AllEvent==false){
                $infoTotalcity ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $itotcity=$infoTotalcity->select(DB::raw("case when mc.cm_name is null then lm.city_id else mc.cm_name end as Name,count(lm.city_id) as TotalCount"))
                ->groupBy('lm.city_id')->get();
            
            $infoTotalcourse=DB::table($tdetail['lead_event_master_mapping'] .' as lemm')
                ->Join($tdetail['parent_product_master'] .' as pm' ,'lemm.ppm_id', 'pm.ppm_id')
                 ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'lemm.lemm_id', 'leem.lemm_id')
                 ->where('leem.exhim_id',$sessDetail->exhim_id);
            if($AllEvent==false){
                $infoTotalcourse ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $itotcourse=$infoTotalcourse->select('pm.ppm_text as Name','lemm.ppm_id',DB::raw("count(lemm.ppm_id) as TotalCount"))
                ->groupBy('lemm.ppm_id')->get();
            //dump( $query->pm_id);
            
               
            $infoTotalactivity=DB::table($tdetail['activity_master'] .' as am')
                ->Join($tdetail['lead_event_exhibitor_mapping_activity'] .' as leema' ,'leema.am_id', 'am.am_id')
                ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'leema.leem_id', 'leem.leem_id')
                ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'leem.lemm_id', 'lemm.lemm_id')
                 ->where('leem.exhim_id',$sessDetail->exhim_id);
            if($AllEvent==false){
                $infoTotalactivity ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $itotactivity=$infoTotalactivity ->select('am.am_text as Name',DB::raw("count(leema.am_id) as TotalCount"))
                ->groupBy('leema.am_id')->get();
            
      
            
            $todays_total=DB::table($tdetail['lead_master'].' as lm')
                ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'lemm.lemm_id', 'leem.lemm_id')
                 ->where('leem.exhim_id',$sessDetail->exhim_id)
                ->whereDate('leem.leem_datetime', $today);
            if($AllEvent==false){
                $todays_total ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            
            $tototal=$todays_total->get()->count(); 
            
            $total=DB::table($tdetail['lead_master'].' as lm')
                ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'lemm.lemm_id', 'leem.lemm_id')
                 ->where('leem.exhim_id',$sessDetail->exhim_id);
            if($AllEvent==false){
                $total ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $tot=$total->count();
            
            $leadsource=DB::table($tdetail['lead_master'].' as lm')
                ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                ->leftJoin($tdetail['master_lead_source'].' as mls' ,'mls.ls_id','lemm.ls_id');
            if($AllEvent==false){
                $leadsource ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $ieadtotsource=$leadsource->select(DB::raw("count(lemm.ls_id) as TotalCount,case when mls.ls_text is null then lemm.ls_id else  mls.ls_text end as Name"))
                ->groupBy('Name')->get();
            
            
            $tdaily_total=DB::table($tdetail['lead_master'].' as lm')
                ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                 ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'lemm.lemm_id', 'leem.lemm_id')
                 ->where('leem.exhim_id',$sessDetail->exhim_id);
            if($AllEvent==false){
                $tdaily_total ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $Dtotal=$tdaily_total->select(DB::raw("date(leem.leem_datetime) as createdate,count(leem.lemm_id) as TotalCount"))
                ->groupby(DB::raw("date(leem.leem_datetime)"))->get(); 
            
               $CurrentEducation=DB::table($tdetail['lead_master'] .' as lm')
                ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                ->Join($tdetail['qualification_master'] .' as qm' ,'lemm.qm_id', 'qm.qm_id')
                 ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'lemm.lemm_id', 'leem.lemm_id')
                    ->where('leem.exhim_id',$sessDetail->exhim_id);
            if($AllEvent==false){
                $CurrentEducation ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $itotCurrentEducation=$CurrentEducation->select('qm.qm_text as Name',DB::raw("count(distinct lm.lm_id) as TotalCount"))
                ->groupBy('lemm.qm_id')->get();
            
            
 ### FAIR WISE ALL TOTAL
 
 
 $FairCurrentEducation=DB::table($tdetail['lead_master'] .' as lm')
                ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                ->Join($tdetail['qualification_master'] .' as qm' ,'lemm.qm_id', 'qm.qm_id')
                 ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'lemm.lemm_id', 'leem.lemm_id');
     
            if($AllEvent==false){
                $FairCurrentEducation ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $itotFCurrentEducation=$FairCurrentEducation->select('qm.qm_text as Name',DB::raw("count(distinct lm.lm_id) as TotalCount"))
                ->groupBy('lemm.qm_id')->get();
                
              
            
            $infoFairTotalcourse=DB::table($tdetail['lead_event_master_mapping'] .' as lemm')
                ->Join($tdetail['parent_product_master'] .' as pm' ,'lemm.ppm_id', 'pm.ppm_id')
                 ->Join($tdetail['lead_event_exhibitor_mapping'] .' as leem' ,'lemm.lemm_id', 'leem.lemm_id');
   
            if($AllEvent==false){
                $infoFairTotalcourse ->where('lemm.aem_id',$selectedEvent->aem_id);
            }
            $itotFcourse=$infoFairTotalcourse->select('pm.ppm_text as Name','lemm.ppm_id',DB::raw("count(lemm.ppm_id) as TotalCount"))
                ->groupBy('lemm.ppm_id')->get();
         
            
                
                   
                   
                   ### Fair Total
                     ### Total  OTP Verified Attendace 
                         $totalreg_count = DB::table($tdetail['lead_master'].' as lm')
                              ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                               ->join($tdetail['lead_event_master_mapping_attendance'].' as lemma','lemm.lemm_id','lemma.lemm_id')
                              ->where('lemm.aem_id',$selectedEvent->aem_id)
                             
                              ->count();   

                   // $totalreg_count=$total_reg_count+$total_du_count;
                   
                    $total_count = DB::table($tdetail['lead_master'].' as lm')
                              ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                              ->join($tdetail['lead_event_exhibitor_mapping'] .' as leem', 'lemm.lemm_id','leem.lemm_id')
                              ->where('lemm.aem_id',$selectedEvent->aem_id)
                              ->distinct()
                              ->count('lm.lm_id'); 

            ### Total daily OTP Verified Attendace 
                         $total_daily_attendence = DB::table($tdetail['lead_master'].' as lm')
                              ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id')
                               ->join($tdetail['lead_event_master_mapping_attendance'].' as lemma','lemm.lemm_id','lemma.lemm_id')
                              ->where('lemm.aem_id',$selectedEvent->aem_id)
                               ->whereDate('lemma.lemma_datetime', $today)
                              ->count();   
            
                
                
            
            return view('dashboard.dashboardv2', [
            
            'prefix_url' => $this->getBaseUrl,
            'itotFCurrentEducation'=>$itotFCurrentEducation,
            'itotCurrentEducation'=>$itotCurrentEducation,
            'itotFcourse'=>$itotFcourse,
            'infoTotalcity'=>$itotcity,
            'infoTotalcourse'=>$itotcourse,
            'todays_total'=>$tototal,
            'total'=>$tot,
            'infoTotalactivity'=>$itotactivity,
            'total_count'=>$total_count,
            'total_daily_attendence'=>$total_daily_attendence,
            'Dtotal'=>$Dtotal,
            'totalreg_count'=>$totalreg_count
            
            
            ]);
    }


public function ViewProfile(Request $request){
      
            $data=null;
            // dd($data);
            if($request->has('ajaxRequset')){
              $data=$request->all();
            }
           
     

            $stateId=null;
            $countryId=null;

            $tdetail=Session('tdetail');
            $sessDetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            
            $aem_id = 1;

            $profileDetail = DB::table('1_exhibitor_master as em')
            
            ->leftJoin('1_exhibitor_event_mapping as eem', 'eem.exhim_id', 'em.exhim_id')
            ->leftJoin('master_city as mc', 'mc.cm_id', 'em.cm_id')
            ->leftJoin('master_state as ms', 'ms.sm_id', 'em.sm_id')
            ->leftJoin('master_country as mcon', 'em.counm_id', 'mcon.counm_id')
            ->leftJoin('1_exhibitor_profile_master as epmm', 'em.exhim_profile', 'epmm.epm_id')
            ->leftJoin(\DB::raw("(
  
                SELECT 
                  em.`exhim_id`, 
                  GROUP_CONCAT(CONCAT('<li>',ot.`ot_name`,'</a>') SEPARATOR ' ' ) as 'ot_name_ae'
      
                  FROM 
                      `1_exhibitor_master` as em
                  join `1_organization_type` as ot ON  FIND_IN_SET(ot.`ot_id`, em.`ot_id`)
                  WHERE 1
                  group by em.exhim_id) as pmot"),
                      function ($join) {
                          $join->on('pmot.exhim_id', '=', 'em.exhim_id');
              })
             
            ->select('ms.sm_name','ot_name_ae','mc.cm_name','mcon.counm_name','em.*','eem.*','em.ppm_id as ppmId','epmm.epm_text as epm_name', 'eem.ppm_id as ppmId')
            ->where('em.exhim_id', '=', $sessDetail->exhim_id)
            ->where('eem.aem_id', '=', $aem_id)
            ->first();
            
           // dd($profileDetail);

            $highlightDetail = DB::table('1_exhibitor_highlights_mapping')
            ->select('*')
            ->where('exhim_id', '=', $profileDetail->exhim_id)
            ->get();
            
            ## Get Bothdesigns##
            $sqlBoothdesign=DB::table('1_exhibitor_boothdesign_master as ebm')
            ->Join('1_exhibitor_boothdesign_event_mapping as ebem', function($join) use ($eventDetails){
                        $join->on('ebm.ebm_id', '=', 'ebem.ebm_id')
                             ->where('ebem.aem_id', '=', 1);
                })
            ->leftJoin('1_participation_plans_master as ppm' ,'ppm.ppm_id', 'ebem.ppm_id');
            
            $sqlBoothdesign->select('ebem.*','ppm.*','ebm.*');
            $sqlBoothdesign->where('ebem.ppm_id', '=', $profileDetail->ppm_id);
            $sqlBoothdesign->orderBy('ebm.ebm_css','asc');
            $boothdesign=$sqlBoothdesign->get();
            

                            
            ## Get gallery Category ##
            $galleryCategory=DB::table('1_gallery_category_master')
                            ->where('gcm_status','active')
                            //->where('ppm_id', '=', $profileDetail->ppm_id)
                            ->get();
                            
                            
                            
            //dd($boothdesign);
            
            //$gallerytypearray=array('image','video');
            $gallerytypearray=array('image','video','brochure');
            $gallerybytype=array();
            foreach($gallerytypearray as $type){
                
                $galleryDetail = DB::table('1_exhibitor_gallery as eg')
                ->leftJoin('1_gallery_category_master as gc', 'gc.gcm_id','eg.gcm_id')
                ->leftJoin('1_environment_template_door_list as etd', 'etd.etd_id','eg.etd_id')
                ->select('eg.*','gc.gcm_name','.etd.etd_name')
                ->where('exhim_id', '=', $profileDetail->exhim_id)
                ->where('eg_type', '=', $type)
                ->where('eg_status','active')
                ->get();
                
                
            $gallerybytype[$type]=$galleryDetail;
            }
            
            //dd($gallerybytype);
            
            
            $thumbnaildata=DB::table('1_exhibitor_thumbnail_data')->where('exhim_id',$profileDetail->exhim_id)->where('etd_status','Y')->get();
            $thumbnailSocialData=DB::table('1_exhibitor_thumbnail_social_data')->where('exhim_id',$profileDetail->exhim_id)->where('etd_status','Y')->get();
             $interactivedata=DB::table('1_interactive_map_master')->where('exhim_id',$profileDetail->exhim_id)->orderby('id','desc')->get();

     $accessType=DB::table('1_participation_plans_subscription_mapping as ppsm')
                            ->join('1_participation_plans_master as ppm','ppsm.ppm','ppm.ppm_id')
                            ->join('1_participation_plans_subscription as pps','ppsm.pps_id','pps.pps_id')
                            ->join('1_exhibitor_event_mapping as eem','ppm.ppm_id','eem.ppm_id')
    
                            ->where('eem.exhim_id',$profileDetail->exhim_id)
                            
                            ->where('eem.aem_id',$aem_id)
                        
                            ->get();
                            
    $servicetaken=DB::table('1_exhi_addon_service_mapping as easm')
                    ->join('1_participation_plans_subscription as pps','easm.pps_id','pps.pps_id')
                    ->select(DB::raw("sum(easm.count) as ctr,easm.pps_id,pps.pps_name"))
                    ->where('easm.exhim_id',$profileDetail->exhim_id)
                    ->groupby('easm.pps_id','pps.pps_name')->get(); 


            
            /*$stateMaster= DB::table('master_state')
            ->get();
        dump($stateMaster);*/
            $getStateList =ComModel::getStateMaster($countryId);
            $getCityList =ComModel::getCityMaster($stateId);
            $counm_code=DB::table('master_country')->get();
           
          
            //$AddedCourse=ComModel::getCourseMasterByExhibitor();
            
            
            $productWithSubProductList = ComModel::getProductMasterWithMapping($aem_id);
            
            $industries = DB::table('1_organization_type')
                        ->where('ot_status','active')
                        ->orderby('ot_orderby','asc')
                        ->orderby('ot_name','asc')
                        ->get();
                        
            $exhibitor_profiles = DB::table('1_exhibitor_profile_master')
                        ->where('epm_status','active')
                        ->orderby('epm_orderby','asc')
                        ->orderby('epm_text','asc')
                        ->get();
                        
            $doorList = DB::table('1_environment_template_door_list')
                        ->select('etd_id','etd_name')
                        ->where('etd_status','active')
                        ->get();
            
           
           //dd($productWithSubProductList);
            $coursesDetails=HomeController::getcourses();

            $tergetBlade='others.user-profile';
            if(!empty(request('ajaxRequset'))) {
              $tergetBlade='others.basicdetail-form';
            }
            
            //dd($profileDetail);
            $ppDetail = ComModel::getParentProductMasterMappingDetail($profileDetail->ppmId,$profileDetail->ppmm_id);
            
            return view($tergetBlade, [
              'profileDetail' => $profileDetail,
              'boothdesign'=>$boothdesign,
              'galleryDetail'=>$gallerybytype,
              'coursesDetails'=>$coursesDetails,
              'highlightDetail'=>$highlightDetail->toArray(),
              //'AddedCourse'=>$AddedCourse,
              'bmid'=>Session('session')[0]->bm_id,
              'stateList' => $getStateList,
              'counm_code'=>$counm_code,
              'cityList' => $getCityList,
              'reqData' => $data,
              'servicetaken'=>$servicetaken,
              'accessType'=>$accessType,
              'prefix_url' => $this->getBaseUrl,
              'galleryCategory' => $galleryCategory,
              'thumbnaildata'=>$thumbnaildata,
              'thumbnailSocialData'=>$thumbnailSocialData,
              'interactivedata'=>$interactivedata,
              'productWithSubProductList' => $productWithSubProductList,
              'ppDetail' => $ppDetail,
              'industries' => $industries,
              'exhibitor_profiles'=>$exhibitor_profiles,
              'exhim_email' => $sessDetail->exhim_contact_email,
              'doorList'=>$doorList
            ]);
    }
    
    public function ViewProfileProjectGallary($brandId, $epmId){
      
            

            $tdetail=Session('tdetail');
            $sessDetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');

            $profileDetail = DB::table('1_exhibitor_master'.' as em')
            
            ->leftJoin('1_exhibitor_event_mapping as eem', 'eem.exhim_id', 'em.exhim_id')
            ->leftJoin('master_city as mc', 'mc.cm_id', 'em.cm_id')
            ->leftJoin('master_state as ms', 'ms.sm_id', 'em.sm_id')
            ->leftJoin('master_country as mcon', 'em.counm_id', 'mcon.counm_id')
            ->leftJoin('1_exhibitor_profile_master as epmm', 'em.exhim_profile', 'epmm.epm_id')
            ->leftJoin(\DB::raw("(
  
                SELECT 
                  em.`exhim_id`, 
                  GROUP_CONCAT(CONCAT('<li>',ot.`ot_name`,'</a>') SEPARATOR ' ' ) as 'ot_name_ae'
      
                  FROM 
                      `".'1_exhibitor_master'."` as em
                  join `1_organization_type` as ot ON  FIND_IN_SET(ot.`ot_id`, em.`ot_id`)
                  WHERE 1
                  group by em.exhim_id) as pmot"),
                      function ($join) {
                          $join->on('pmot.exhim_id', '=', 'em.exhim_id');
              })
             
            ->select('ms.sm_name','ot_name_ae','mc.cm_name','mcon.counm_name','em.*','eem.*','em.ppm_id as ppmId','epmm.epm_text as epm_name', 'eem.ppm_id as ppmId')
            ->where('em.exhim_id', '=', $sessDetail->exhim_id)
            ->where('eem.aem_id', '=', $eventDetails->aem_id)
            ->first();
            
           // dd($profileDetail);

            $highlightDetail = DB::table($tdetail['exhibitor_highlights_mapping'])
            ->select('*')
            ->where('exhim_id', '=', $profileDetail->exhim_id)
            ->get();
            
           
            ## Get gallery Category ##
            $galleryCategory=DB::table('1_gallery_category_master')
                            ->where('gcm_status','active')
                            ->get();
            
            $gallerytypearray=array('image');
            $gallerybytype=array();
            foreach($gallerytypearray as $type){
                
                $galleryDetail = DB::table('1_exhibitor_gallery'.' as eg')
                ->leftJoin('1_gallery_category_master as gc', 'gc.gcm_id','eg.gcm_id')
                ->select('eg.*','gc.gcm_name')
                ->where('exhim_id', '=', $profileDetail->exhim_id)
                ->where('epm_id',$epmId)
                ->where('eg_type', '=', $type)
                ->where('eg_status','active')
                ->get();
                
                $gallerybytype[$type]=$galleryDetail;
            }
            
            //dd($gallerybytype);
            
            
            $thumbnaildata=DB::table('1_exhibitor_thumbnail_data')->where('exhim_id',$profileDetail->exhim_id)->where('etd_status','Y')->get();
            
           //dd($productWithSubProductList);
            $coursesDetails=HomeController::getcourses();

            $tergetBlade='others.projects.photo-gallary';

            return view($tergetBlade, [
              'profileDetail' => $profileDetail,
              'galleryDetail'=>$gallerybytype,
              'highlightDetail'=>$highlightDetail->toArray(),
              'bmid'=>Session('session')[0]->bm_id,
              'prefix_url' => $this->getBaseUrl,
              'galleryCategory' => $galleryCategory,
              'thumbnaildata'=>$thumbnaildata,
              'epmId'=>$epmId
            ]);
    }
    
    public function ViewProjectVideoGallary($brandId,$epmId){
            
            $tdetail=Session('tdetail');
            $sessDetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');

            $profileDetail = DB::table('1_exhibitor_master'.' as em')
            
            ->leftJoin('1_exhibitor_event_mapping as eem', 'eem.exhim_id', 'em.exhim_id')
            ->leftJoin('master_city as mc', 'mc.cm_id', 'em.cm_id')
            ->leftJoin('master_state as ms', 'ms.sm_id', 'em.sm_id')
            ->leftJoin('master_country as mcon', 'em.counm_id', 'mcon.counm_id')
            ->leftJoin('1_exhibitor_profile_master as epmm', 'em.exhim_profile', 'epmm.epm_id')
            ->leftJoin(\DB::raw("(
  
                SELECT 
                  em.`exhim_id`, 
                  GROUP_CONCAT(CONCAT('<li>',ot.`ot_name`,'</a>') SEPARATOR ' ' ) as 'ot_name_ae'
      
                  FROM 
                      `".'1_exhibitor_master'."` as em
                  join `1_organization_type` as ot ON  FIND_IN_SET(ot.`ot_id`, em.`ot_id`)
                  WHERE 1
                  group by em.exhim_id) as pmot"),
                      function ($join) {
                          $join->on('pmot.exhim_id', '=', 'em.exhim_id');
              })
             
            ->select('ms.sm_name','ot_name_ae','mc.cm_name','mcon.counm_name','em.*','eem.*','em.ppm_id as ppmId','epmm.epm_text as epm_name', 'eem.ppm_id as ppmId')
            ->where('em.exhim_id', '=', $sessDetail->exhim_id)
            ->where('eem.aem_id', '=', $eventDetails->aem_id)
            ->first();
            
           // dd($profileDetail);

            $highlightDetail = DB::table($tdetail['exhibitor_highlights_mapping'])
            ->select('*')
            ->where('exhim_id', '=', $profileDetail->exhim_id)
            ->get();
            
            

                            
            ## Get gallery Category ##
            $galleryCategory=DB::table('1_gallery_category_master')
                            ->where('gcm_status','active')
                            //->where('ppm_id', '=', $profileDetail->ppm_id)
                            ->get();
                            
            //dd($profileDetail->exhim_id);
            
            $gallerytypearray=array('video');
            $gallerybytype=array();
            foreach($gallerytypearray as $type){
                
                $galleryDetail = DB::table('1_exhibitor_gallery'.' as eg')
                ->leftJoin('1_gallery_category_master as gc', 'gc.gcm_id','eg.gcm_id')
                ->select('eg.*','gc.gcm_name')
                ->where('eg.exhim_id', '=', $profileDetail->exhim_id)
                ->where('eg.epm_id',$epmId)
                ->where('eg.eg_type', '=', $type)
                ->where('eg.eg_status','active')
                ->get();
                
                
                $gallerybytype[$type]=$galleryDetail;
            }
            
            //dd($gallerybytype);
            
            $thumbnaildata=DB::table('1_exhibitor_thumbnail_data')->where('exhim_id',$profileDetail->exhim_id)->where('etd_status','Y')->get();

            $tergetBlade='others.projects.video-gallary';

            return view($tergetBlade, [
              'profileDetail' => $profileDetail,
              'galleryDetail'=>$gallerybytype,
              'highlightDetail'=>$highlightDetail->toArray(),
              'bmid'=>Session('session')[0]->bm_id,
              'prefix_url' => $this->getBaseUrl,
              'galleryCategory' => $galleryCategory,
              'thumbnaildata'=>$thumbnaildata,
              'epmId'=>$epmId
            ]);
    }


      public static function getcourses($ppmId=null){
        $tdetail=Session('tdetail');
        $coursesDetails=array();
        $pdetail=Session('profileDetail');
        $stream = DB::table('1_parent_product_master')
            //             ->join($tdetail['exhibitor_product_master'].' as epm','ppm.ppm_id','epm.ppm_id')
            //             ->join($tdetail['exhibitor_product_mapping'].' as epmap','epm.exhipm_id','epmap.exhipm_id')
            // ->select('ppm.ppm_id','ppm.ppm_text')->distinct()
            ->get();

          $ppm_id="";
          if(!null==request('ppm_id')){
            $ppm_id=request('ppm_id');
          }else if(!empty($ppmId)){
            $ppm_id=$ppmId;
          }else{
            $ppm_id=$stream[0]->ppm_id;
          }

         $courses = DB::table('1_exhibitor_product_master as epm')
                     ->join('1_exhibitor_product_mapping as epmap','epm.exhipm_id','epmap.exhipm_id')
         ->select('epm.epm_text')
         ->where('epm.ppm_id', '=', $ppm_id)
            ->where('epm.epm_status','active')
         ->where('epmap.exhim_id', '=', $pdetail->exhim_id)
         ->get();

         $qualification = DB::table('1_qualification_master')
         ->select('*')
         ->get();

         $coursesDetails['stream']=$stream;
         $coursesDetails['courses']=$courses;
         $coursesDetails['qualification']=$qualification;

        $content="";
                $content .='<div class="col-md-12 col-12">
                  <label class="radio radio-outline-danger">
                      <input type="hidden" name="Course" value="other"  formControlName="radio" onclick="Showotherinput(this.value)" >
                 </label>
                  <input class="form-control" type="text" name="new_course" id="new_course" value=""  placeholder="Enter Course Name" >
                  <span class="text-danger" id="err_msg_nc" name="err_msg_nc"  style="display:none;">
                </div>';
                
                 if(!null==request('ppm_id') ){
             if(count($courses)!=0){
                $content .='<div class="col-md-12 mt-4" style=""><div class=""><label><u> Courses Already Added</u></label></div>';
                foreach ($courses as  $value) {

                      $content .='<div class="sorting_filter" id="selectedFilter" style="background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 20px;
    padding: 2px 15px 2px 15px;
    margin: 0 2px 3px 0px;
    font-size: 12px;
    display: inline-block;
    color: #000;
    line-height: 20px;
    position: relative;"><span>';
                      $content .=$value->epm_text;
                      $content .= '</div></span>';
                }
                $content .="</div>";
             }

          return $content;

         }else{
           return $coursesDetails;
         }


      }
      
      public static function getparentproductsubcategory($ppmId=null){
        $tdetail=Session('tdetail');
        $coursesDetails=array();
        $pdetail=Session('profileDetail');
        
        $ppm_id = request('ppm_id');
        
        $ppmm_id = request('ppmm_id');
        
        $ppmmidArray = explode(',',$ppmm_id);
        

        $content="";
                 
        if(!null==request('ppm_id') ){
            $subcategories = DB::table('1_parent_product_master_mapping')  
                ->where('ppm_id', '=', $ppm_id)
                ->where('ppmm_status','active')
                ->get();

             if(count($subcategories)!=0){
                foreach ($subcategories as  $key => $value) {
                    $ischecked = '';
                    
                    //if(!empty($ppmm_id) && $ppmm_id==$value->ppmm_id) {
                    if(!empty($ppmm_id) && in_array($value->ppmm_id, $ppmmidArray)) {
                        $ischecked= 'checked';
                    }else{
                        if($key==0) {
                            $ischecked="checked";
                        }
                    }
                    
                    $content .=' <div class="col-md-4 col-6">
                                    <label class="checkbox checkbox-outline-danger">
                                       <input type="checkbox" name="pp_subcategory[]" '.$ischecked.' value="'.$value->ppmm_id.'" formControlName="checkbox" >
                                       <span>'.$value->ppmm_text.'</span>
                                       <span class="checkmark"></span>
                                   </label></div>';
                }
             }

            return $content;

        }


      }

    // public static function GetDashboardData(){
    //   return view('dashboard.dashboardv1', ['prefix_url' => $this->getBaseUrl]);
    // }

     public function GetDataList(){

      $tdetail=Session('tdetail');
      $pdetail=Session('profileDetail');
      $eventDetail=Session('evntDetail');
      $selectedEvent=Session('selectedEvent');
     
      $aem_id=1;
     
      $profileDetail = DB::table('1_exhibitor_master as em')
            ->leftJoin('master_city as mc', 'mc.cm_id', 'em.cm_id')
            ->leftJoin('master_state as ms', 'ms.sm_id', 'em.sm_id')
            ->select('em.*','ms.sm_name','mc.cm_name')
            ->where('em.exhim_id', '=', $pdetail->exhim_id)
            ->first();
      
        $qualification = request('qm');
        $course = request('course');
        $city = request('city');
        $state = request('state');
        $datefrom = request('datefrom');
        $dateto = request('dateto');
        $leadstage = request('leadstage');
        $leadtype = request('leadtype');


      if(Session::has('paginate')){
          $paginate = Session::get('paginate');
      } else{
        $paginate = 10;
      }

      if (null !==(request('pagination'))){
          $paginate = request('pagination');
          Session::put('paginate', $paginate);
      }
      $searchText="";
      if (null !==(request('search_text'))){
          $searchText = request('search_text');
          //Session::put('search_text', $search_text);
      }

      $leadList=DB::table('1_lead_master as lm')
      ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
      ->join('1_lead_event_exhibitor_mapping as leem', 'leem.lemm_id','lemm.lemm_id')
      ->leftjoin('1_organization_type_master as otm', 'otm.otm_id','lemm.otm_id')
      ->leftjoin('1_organization_type as ot', 'ot.ot_id','lemm.ot_id')
      ->leftJoin(\DB::raw("(

          SELECT 
          leema.`leem_id`,
          GROUP_CONCAT(CONCAT('<li>',am.`am_text`,'</a>') SEPARATOR ' ' ) as 'activity'
          FROM 
                    `1_lead_event_exhibitor_mapping_activity` as leema
               join `1_lead_event_exhibitor_mapping` as leem on leem.`leem_id`=leema.`leem_id`
          left join `1_activity_master`  as am ON am.`am_id`=leema.`am_id`
          WHERE leem.`exhim_id`='".$pdetail->exhim_id."'
          group by leema.`leem_id` ) as leema"),
                function ($join) {
                    $join->on('leema.leem_id', '=', 'leem.leem_id');
        })
        ->leftJoin(\DB::raw("(

          SELECT 
            lemm.`lemm_id`, 
            GROUP_CONCAT(CONCAT('<li>',ppm.`ppm_text`,'</a>') SEPARATOR ' ' ) as 'pm_text'

            FROM 
                `1_lead_event_master_mapping` as lemm
            join `1_parent_product_master` as ppm ON  FIND_IN_SET(ppm.`ppm_id`, lemm.`ppm_id`)
            WHERE 1
            group by lemm.lemm_id) as pm"),
                function ($join) {
                    $join->on('pm.lemm_id', '=', 'lemm.lemm_id');
        })


      ->leftJoin('master_city as mc'  ,'lm.city_id','mc.cm_id')
      ->leftJoin('master_country as counm'  ,'counm.counm_id','lm.country_id')
      ->leftJoin('1_qualification_master as qm' ,'lemm.qm_id','qm.qm_id')
      ->leftJoin('1_lead_categorization as lc' ,'lc.lc_id','leem.lc_id')
      ->leftJoin('1_exhibitor_boothstaff as ebstf' ,'ebstf.ebsm_id','leem.leem_updateby');
      
       

      $leadList->select('ot.*','otm.*','lm.*',  'lemm.lemm_id as lemmid', 'lemm.*', 'leem.*','leema.activity','mc.*','counm.*','qm.*','pm.*','lc.*','ebstf.ebsm_name as last_interaction_by',DB::raw("case when mc.cm_name is null then lm.city_id else mc.cm_name end as cm_name"));
      ## Set Event Filter ##
      $leadList->where('lemm.aem_id', $aem_id);
       ## Set Exhibitor ##
      $leadList->where('leem.exhim_id',$pdetail->exhim_id);

      if(!empty($leadtype)){
         $leadList->where('lemm.lemm_reg_type',$leadtype);
        }

      if(!empty($searchText)){
            $leadList->where(function($query) use ($searchText) {
                $query->orwhere('lm.lm_email',$searchText)
                    ->orwhere('lm.lm_mobile',$searchText)
                    ->orwhere('mc.cm_name',$searchText)
                    ->orwhere('qm.qm_text','like','%'.$searchText.'%')
                    ->orwhere('pm.pm_text','like','%'.$searchText.'%')
                    ->orwhere('lm.lm_fullname','like','%'.$searchText.'%');
            });
      }
     
         if (!empty($qualification)){
          //dump($qualification);
            $leadList->where('lemm.qm_id', $qualification);

          }if (!empty($course)){
            $leadList->whereRaw("FIND_IN_SET(?, lemm.ppm_id) > 0", [$course]);
          }if (!empty($city)){
           
            $leadList->where('lm.city_id', $city)->groupBy('lm.city_id');
          }if (!empty($leadstage)){
            
            $leadList->where('leem.lc_id', $leadstage);
            
          }
            if (!empty($datefrom) &&  empty($dateto) ){
                            
      $leadList->whereDate('lemm.lemm_insert_date','=',$datefrom);
                            
    }
    else if (!empty($dateto) && !empty($datefrom)){
                            
        $leadList->whereDate('lemm.lemm_insert_date','>=', $datefrom)->whereDate('lemm.lemm_insert_date','<=', $dateto);
                            
     }
                            else if (!empty($dateto) && empty($datefrom)){
                            
                                $leadList->whereDate('lemm.lemm_insert_date','<=', $dateto);
                            
                            }

         //dump(date("Y-m-d"));

        
      $leadList->orderby('leem.leem_datetime','DESC');

      $res=$leadList ->paginate($paginate);
      
      ## Lead Categorization ##
      $leadcat=ComModel::getLeadCategorization();
      $eewbmdetail="";
      
      if($pdetail->at_id=='4'){
                $eewbmdetail=DB::table('1_exhibitor_event_with_boothstaff_mapping as eewbm')
                ->join('1_exhibitor_boothstaff as eb','eewbm.ebsm_id','eb.ebsm_id')

                ->join('1_exhibitor_event_mapping as eem',function($join){
                $join->on('eewbm.eem_id', 'eem.eem_id')
                  ->on('eb.exhim_id','eem.exhim_id');
                })
                ->where('eewbm.ebsm_id',$pdetail->ebsm_id)
                ->where('eb.exhim_id',$pdetail->exhim_id)
                ->where('eem.aem_id',$selectedEvent->aem_id)
                ->get();
                if(isset($eewbmdetail[0])){
                  $eewbmdetail=$eewbmdetail[0];
                }
      }
          $productdata = DB::table('1_parent_product_master')->select('ppm_id','ppm_text')->get();
          $qualificationdata = DB::table('1_qualification_master')->select('qm_id','qm_text')->get();
          $statedata = DB::table('master_state')->select('sm_id','sm_name')->get();
          $leadcategorization = DB::table('1_lead_categorization')->select('lc_id','lc_text')->get();

          $qualifications = DB::table('1_qualification_master')->where('qm_id',$qualification)->select('qm_text','qm_id')->first();
          $courses = DB::table('1_parent_product_master')->where('ppm_id',$course)->select('ppm_text','ppm_id')->first();
          $citys = DB::table('master_city')->where('cm_id',$city)->select('cm_name','cm_id')->first();
          $leadstages = DB::table('1_lead_categorization')->where('lc_id',$leadstage)->select('lc_text','lc_id')->first();
          $states = DB::table('master_state')->where('sm_id',$state)->select('sm_name','sm_id')->first();
     // dd($res);
     

      return view('exhibitors.exhibitor-visitor-tables',['leadList'=>$res, 'leadcat'=>$leadcat, 'eewbmdetail'=>$eewbmdetail,  'prefix_url' => $this->getBaseUrl,
            'qualificationdata'=>$qualificationdata,
            'leadcategorization'=>$leadcategorization,
            'qualification'=>$qualifications,
            'statedata'=>$statedata,
            'datefrom'=>$datefrom,
            'dateto'=>$dateto,
            'leadstage'=>$leadstages,
            'citys'=>$citys,
            'states'=>$states,
            'productdata'=>$productdata,
            'courses'=>$courses,
            'leadtype'=>$leadtype,
            'profileDetail'=>$profileDetail,
            'userData' => $pdetail,
            'exhim_email'=>$pdetail->exhim_contact_email
          ]);
    }
    public function VisitorActivity(){

            $tdetail=Session('tdetail');
            if(Session::has('paginate')){
                $paginate = Session::get('paginate');
            } else{
              $paginate = 10;
            }

            if (null !==(request('pagination'))){
                $paginate = request('pagination');
                Session::put('paginate', $paginate);
            }
            $searchText="";
            if (null !==(request('search_text'))){
                $searchText = request('search_text');
                //Session::put('search_text', $search_text);
            }

            $leadList=DB::table($tdetail['lead_master'].' as lm' )
            ->join($tdetail['lead_event_master_mapping'].' as lemm', 'lemm.lm_id', 'lm.lm_id')
            ->leftJoin($tdetail['master_city'].' as mc', 'lm.city_id', 'mc.cm_id')
            ->leftJoin($tdetail['qualification_master'].' as qm', 'lemm.qm_id', 'qm.qm_id')
            ->leftJoin($tdetail['parent_product_master'].' as ppm' ,'lemm.ppm_id','ppm.ppm_id');
            if(!empty($searchText)){
                  $leadList->where(function($query) use ($tdetail,$searchText) {
                      $query->orwhere('lm.lm_email',$searchText)
                            ->orwhere('lm.lm_mobile',$searchText)
                            ->orwhere('mc.cm_name',$searchText)
                            ->orwhere('qm.qm_text','like','%'.$searchText.'%')
                            ->orwhere('ppm.ppm_text','like','%'.$searchText.'%')
                            ->orwhere('lm.lm_fullname','like','%'.$searchText.'%');
                  });
            }

            $res=$leadList->paginate($paginate);

            return view('datatables.activity-tables',['leadList'=>$res,  'prefix_url' => $this->getBaseUrl]);
    }


    public function Updateuserprofile(Request $request){

        
          $tdetail=Session('tdetail');
          $pdetail=Session('profileDetail');
          
              
           if(!null==request('video_file')){
                
                $vidName= 'video-'.date('Y-m-d').time().'.mp4';
                $vidPath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/gallery/';
                $path = public_path() . $vidPath . $vidName;
                
                File::makeDirectory(public_path() . $vidPath, 0777, true, true);
                request("video_file")->move(public_path($vidPath), $vidName);
                
                $insertVideoGallery=array(
                    'exhim_id'=> $pdetail->exhim_id,
                    'epm_id'=> request('epmId'),
                    'eg_name'=>$vidName,
                    'eg_type'=>'video'
                );

                if(!null==request('vtype')){
                    $insertVideoGallery['eg_video_type']=request('vtype');
                }
                
                if(!null==request('video_caption')){
                    $insertVideoGallery['eg_caption']=request('video_caption');
                }
                if(!null==request('video_category')){
                    $insertVideoGallery['gcm_id']=request('video_category');
                }
                
                $insert=DB::table('1_exhibitor_gallery')
                            ->insert(
                                $insertVideoGallery
                            );
                
                ##Added for video gallery count 
                $updatetransection=DB::table('1_exhibitor_profile_transection')
                                    ->where('exid', $pdetail->exhim_id)
                                    ->update( array(
                                        'booth_videogallery'=>1
                                    )
                                );
          }

            if(!null==request('upload_photo') && request('photoupload')=='photoupload'){
                $upload_image=request('upload_photo');
                
                $data = request('logoimage');
                
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                $data = base64_decode($data);
                $imageName= 'photo-'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/gallery/';
                $path = public_path() . $imagePath . $imageName;
                
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                file_put_contents($path, $data);
                    
                ## Create Array ##
                $insertGallery=array(
                              'exhim_id'=> $pdetail->exhim_id,
                              'epm_id' => request('epmId'),
                              'eg_name'=>$imageName,
                              'eg_type'=>'image'
                              );
                   
                if(!null==request('egcaption')){
                    $insertGallery['eg_caption']=request('egcaption');
                }
                if(!null==request('egcategory')){
                    $insertGallery['gcm_id']=request('egcategory');
                }

                $insert=DB:: table('1_exhibitor_gallery')
                ->insert(
                    $insertGallery
                );
                    
                $updatetransection=DB:: table('1_exhibitor_profile_transection')
                          ->where('exid', $pdetail->exhim_id)
                          ->update( array(
                                          'booth_photogallery'=>1
                                        
                                        )
                          );  
          }
          
          
             ## Upload Banner ##
            if(!null==request('upload_photo') && request('photoupload')=='UpdateBanner'){
                  $upload_image=request('upload_photo');
             
                  $imageName = date('Y-m-d').time().'.'.$upload_image->getClientOriginalExtension();

                  $imagePath='assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                  $upload_image->move(public_path($imagePath), $imageName);
                 
                  $insert=DB:: table('1_exhibitor_master')
                              ->where('exhim_id', $pdetail->exhim_id)
                              ->update( array(
                                              'exhim_banner'=>$imageName
                                            
                                            )
                              );
            }
          
             ## Upload Standee ##
            if(!null==request('upload_standee') && request('standeeimage')=='standeeimage'){
                $upload_image=request('upload_standee');
                
                $data = request('staimage');
                
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                $data = base64_decode($data);
                $image_name= 's1'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                $path = public_path() . $imagePath . $image_name;
                file_put_contents($path, $data); 
                
                $insert=DB:: table('1_exhibitor_master')
                            ->where('exhim_id', $pdetail->exhim_id)
                            ->update( array(
                                        'exhim_standee'=>$image_name
                
                                    )
                        );
            }
          
          
            ## Upload Standee1 ##
            if(!null==request('sta1image') && request('standee1image')=='standee1image'){
                $upload_image=request('upload1_standee');
                
                $data = request('sta1image');
                
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                $data = base64_decode($data);
                $image_name= 's11'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                $path = public_path() . $imagePath . $image_name;
                file_put_contents($path, $data); 
                
                $insert=DB:: table('1_exhibitor_master')
                            ->where('exhim_id', $pdetail->exhim_id)
                            ->update( array(
                            'exhim_standee1'=>$image_name
                            
                            )
                        );
            
            }
          
           ## Upload Standee ##
            if(!null==request('upload_standee') && request('standeeimage')=='standeeimage'){
                $upload_image=request('upload_standee');
                
                $data = request('staimage');
                
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                
                $data = base64_decode($data);
                $image_name= 's1'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                $path = public_path() . $imagePath . $image_name;
                file_put_contents($path, $data); 
                
                $insert=DB:: table('1_exhibitor_master')
                            ->where('exhim_id', $pdetail->exhim_id)
                            ->update( array(
                                'exhim_standee'=>$image_name
                            )
                        );
            }
          
          
          
          
        ## Upload Standee2 ##
        if(!null==request('sta2image') && request('standee2image')=='standee2image'){
            $upload_image=request('upload2_standee');
            
            $data = request('sta2image');
            
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            
            $data = base64_decode($data);
            $image_name= 's2'.date('Y-m-d').time().'.jpg';
            $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
            File::makeDirectory(public_path() . $imagePath, 0777, true, true);
            $path = public_path() . $imagePath . $image_name;
            file_put_contents($path, $data); 
            
            $insert=DB:: table('1_exhibitor_master')
                        ->where('exhim_id', $pdetail->exhim_id)
                        ->update( array(
                            'exhim_standee2'=>$image_name
                        )
                    );
        
        }
          
                ## Upload Standee3 ##
          if(!null==request('sta3image') && request('standee3image')=='standee3image'){
                    
                    $upload_image=request('upload3_standee');
                    $data = request('sta3image');

                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    
                    $data = base64_decode($data);
                    $image_name= 's3'.date('Y-m-d').time().'.jpg';
                    $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    $path = public_path() . $imagePath . $image_name;
                    file_put_contents($path, $data); 
                  
             
                 
                    $insert=DB:: table('1_exhibitor_master')
                              ->where('exhim_id', $pdetail->exhim_id)
                              ->update( array(
                                              'exhim_standee3'=>$image_name
                                            
                                            )
                              );
          
          }
          
          
          
          
          
                ## Upload Standee4 ##
          if(!null==request('sta4image') && request('standee4image')=='standee4image'){
                $upload_image=request('upload4_standee');
                  
                $data = request('sta4image');

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                
                $data = base64_decode($data);
                $image_name= 's4'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                $path = public_path() . $imagePath . $image_name;
                file_put_contents($path, $data); 
                  
             
                 
                $insert=DB:: table('1_exhibitor_master')
                              ->where('exhim_id', $pdetail->exhim_id)
                              ->update( array(
                                              'exhim_standee4'=>$image_name
                                            
                                            )
                              );
    
                              
          }
          
          
             ## Upload Mobile Standee ##
          if(!null==request('upload_standee_mo') && request('standeeimagemo')=='standeeimagemo'){
                  $upload_image=request('upload_standee_mo');
             
                  $imageName = date('Y-m-d').time().'.'.$upload_image->getClientOriginalExtension();
                 

                  $imagePath='assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                  $upload_image->move(public_path($imagePath), $imageName);
                 
                  $insert=DB:: table('1_exhibitor_master')
                              ->where('exhim_id', $pdetail->exhim_id)
                              ->update( array(
                                              'exhim_mo_standee'=>$imageName
                                            
                                            )
                              );
          }
          
          
          ## Upload backdrop image of video ##
          if(!null==request('bcimage') && request('backdropofvideo')=='backdropImage-1'){
                  $upload_image=request('upload_backdropimage');
             
             
             
               $data = request('bcimage');

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                
                $data = base64_decode($data);
                $image_name= 'backdropimage-'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                $path = public_path() . $imagePath . $image_name;
                
                
                file_put_contents($path, $data);
             
          
                  $insert=DB:: table('1_exhibitor_master')
                              ->where('exhim_id', $pdetail->exhim_id)
                              ->update( array(
                                              'exhim_stall_backdropofvideo'=>$image_name
                                            
                                            )
                              );
          }
          
          ## Upload Desk Logo ##
          if(!null==request('upload_desklogo') && request('desklogo')=='desklogo-1'){
              
             
              $image_name='';
                  $upload_image=request('upload_desklogo');
             $ppm=request('ppm_id');
             
            
               $data = request('deskimage');

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name= 'desklogo-'.date('Y-m-d').time().'.jpg';
         $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
         File::makeDirectory(public_path() . $imagePath, 0777, true, true);
        $path = public_path() . $imagePath . $image_name;


        file_put_contents($path, $data);
            
                 
                  $insert=DB:: table('1_exhibitor_master')
                              ->where('exhim_id', $pdetail->exhim_id)
                              ->update( array(
                                              'exhim_desk_logo'=>$image_name
                                            
                                            )
                              );
                              
                $updatetransection=DB:: table('1_exhibitor_profile_transection')
                              ->where('exid', $pdetail->exhim_id)
                              ->update( array(
                                              'booth_setup_desc_logo'=>1
                                            
                                            )
                              );
          }
          
        ## Upload Lobby Image ##
          if(!null==request('upload_lobbyImage') && request('lobbyImage')=='lobbyImage-1'){
                  $upload_image=request('upload_lobbyImage');
             
                  $imageName = 'lobby-'.date('Y-m-d').time().'.'.$upload_image->getClientOriginalExtension();
                 

                  $imagePath='assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                  $upload_image->move(public_path($imagePath), $imageName);
                 
                  $insert=DB:: table('1_exhibitor_master')
                              ->where('exhim_id', $pdetail->exhim_id)
                              ->update( array(
                                              'exhim_lobby_image'=>$imageName
                                            
                                            )
                              );
                              
                              $updatetransection=DB:: table('1_exhibitor_profile_transection')
                              ->where('exid', $pdetail->exhim_id)
                              ->update( array(
                                              'booth_setup_lobby_image'=>1
                                            
                                            )
                              );
          }
          
          
          ##update avatar url
          if(!null==request('avatar_url'))
          {
              $avatar_url = request('avatar_url');
             
              DB::table('1_exhibitor_master')
                            ->where('exhim_id', $pdetail->exhim_id)
                            ->update( array(
                                'exhim_rpm_link'=>$avatar_url
                            )
                        );
          }
          
          if(!null==request('standeevideo_file') && request('standeevideo')=='standeevideo'){
              
                $videoUrl = request('standeevideo_file');
                
                $vidName= 'video-'.date('Y-m-d').time().'.mp4';
                $vidPath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                $path = public_path() . $vidPath . $vidName;
                
                File::makeDirectory(public_path() . $vidPath, 0777, true, true);
                $videoUrl->move(public_path($vidPath), $vidName);
                
                $insert=DB::table('1_exhibitor_master')
                            ->where('exhim_id', $pdetail->exhim_id)
                            ->update( array(
                                'exhim_stall_video'=>$vidName
                            )
                        );
          }
          
          
           
           ## Upload Mobile Banner ##
            if(!null==request('upload_mbanner') && request('photoupload')=='UpdateBanner'){
              
                $upload_mbanner=request('upload_mbanner');
                
                $imageMName = date('Y-m-d').time().'.'.$upload_mbanner->getClientOriginalExtension();
                
                $imagePath='assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                
                $upload_mbanner->move(public_path($imagePath), $imageMName);
                
                $insert=DB::table('1_exhibitor_master')
                            ->where('exhim_id', $pdetail->exhim_id)
                            ->update( array(
                                'exhim_mo_v_banner'=>$imageMName
                            )
                        );
            }
          
            ## Upload Logo ##
            if(!null==request('upload_logo') && request('photoupload')=='UpdateLogo'){
                
                $upload_image=request('upload_logo');
                
                $data = request('logoimage');
                
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                
                $data = base64_decode($data);
                $imageName= 'logo-'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/';
                $path = public_path() . $imagePath . $imageName;
                
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                file_put_contents($path, $data);
                
                $insert=DB::table('1_exhibitor_master')
                            ->where('exhim_id', $pdetail->exhim_id)
                            ->update( array(
                                'exhim_logo'=>$imageName
                            )
                        );
                
                $updatetransection=DB:: table('1_exhibitor_profile_transection')
                                        ->where('exid', $pdetail->exhim_id)
                                        ->update( array(
                                            'booth_setup_logo'=>1
                                        )
                                    );
            }

          if(!null==request('photoupload') && request('photoupload')=='photoupdate'){
                
                $updateGallery=array();
                if(!null==request('egcaption')){
                    $updateGallery['eg_caption']=request('egcaption');
                }
                if(!null==request('egcategory')){
                    $updateGallery['gcm_id']=request('egcategory');
                }
                
                $update=DB:: table('1_exhibitor_gallery')
                            ->where('eg_id', request('eg_id'))
                            ->update(
                                $updateGallery
                            );
            }

            if(!null==request('upload_brochure') && request('brochure')=='brochure'){
                $upload_image=request('upload_brochure');
                
                $brochureName = 'brochure-'.date('Y-m-d').time().'.'.$upload_image->getClientOriginalExtension();
                $brochurePath='/assets/images/booth/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/brochure/';
                $upload_image->move(public_path($brochurePath), $brochureName);
                
                // $update=DB:: table('1_exhibitor_master')
                //             ->where('exhim_id', $pdetail->exhim_id)
                //             ->update(array(
                //                 'exhim_brochure'=>$imageName
                //             )
                //         );
                
                $insertBrochureGallery=array(
                    'exhim_id'=> $pdetail->exhim_id,
                    'epm_id'=> request('epmId'),
                    'eg_name'=>$brochureName,
                    'eg_type'=>'brochure',
                    'etd_id'=>request('etdId')
                );
                
                if(!null==request('brochure_caption')){
                    $insertBrochureGallery['eg_caption']=request('brochure_caption');
                }

                $insert=DB::table('1_exhibitor_gallery')
                            ->insert(
                                $insertBrochureGallery
                            );
            }


          if(!null==request('quickfact')){
           
                $setInsertArray=array();
                if($request->has('institute_type')){
                  $setInsertArray['exhim_type_of_institute'] = request('institute_type'); }
                if($request->has('ownership')){
                    $setInsertArray['exhim_ownership']=request('ownership'); }
                if($request->has('estd_year')){
                    $setInsertArray['exhim_estd_year']=request('estd_year'); } 
                if($request->has('accreditation')){
                    $setInsertArray['exhim_accreditation']=request('accreditation'); }
                if($request->has('campus_area')){
                    $setInsertArray['exhim_campus_area']=request('campus_area'); }
                if($request->has('approval')){
                    $setInsertArray['exhim_approval']=request('approval'); }
                if($request->has('phone')){
                    $setInsertArray['exhim_contact_us']=request('phone'); }
                if($request->has('email')){
                    $setInsertArray['exhim_contact_email']=request('email'); }
                if($request->has('address')){
                    $setInsertArray['exhim_address']=request('address'); }
                if($request->has('state')){
                    $setInsertArray['sm_id']=request('state'); }
                if($request->has('city')){
                    $setInsertArray['cm_id']=request('city'); }
                if($request->has('whatsapp_id')){
                    $setInsertArray['exhim_whatsapp']=request('whatsapp_id'); }

                if($request->has('organization_name')){
                    $setInsertArray['exhim_organization_name']=request('organization_name'); }
                if($request->has('web_link')){
                    $setInsertArray['exhim_web_link']=request('web_link'); }
                    
                if($request->has('youtube')){
                    $setInsertArray['exhim_youtube_link']=request('youtube'); }
                    
                if($request->has('facebook')){
                    $setInsertArray['exhim_facebook_link']=request('facebook'); }
                    
                if($request->has('twitter')){
                    $setInsertArray['exhim_twitter_link']=request('twitter'); }
                    
                if($request->has('linkedIn')){
                    $setInsertArray['exhim_linkedIn_link']=request('linkedIn'); }
                    
                if($request->has('instagram')){
                    $setInsertArray['exhim_instagram_link']=request('instagram'); }
                    
                if($request->has('recognition')){
                    $setInsertArray['exhim_recognition']=request('recognition'); }
                    
                if($request->has('punchline_text')){
                    $setInsertArray['exhim_punchline']=request('punchline_text'); }
                    
                    
                
                if($request->has('interested_in')){
				    
				    $ppmIds=array();
				    $ppmmIds=array();
				    foreach(request('interested_in') as $key => $inVal){
				        $interestedInArray=explode('-', $inVal);
				        $ppmIds[$key]=$interestedInArray[0];
				        $ppmmIds[$key]=$interestedInArray[1];
				    }
				    
				    ## ---row data of Product master--- ##
				    $interestedIn=implode(',', request('interested_in'));
				    $setInsertArray['ppm_id_custom'] = $interestedIn;
					
				    ## ---Product master--- ##
					$interestedInCat=implode(',', $ppmIds);
					$setInsertArray['ppm_id'] = $interestedInCat;
					
					## ---Product master mapping--- ##
					$interestedInSubCat=implode(',', $ppmmIds);
					$setInsertArray['ppmm_id'] = $interestedInSubCat;
				}
				
				
				 if($request->has('industry')){
				    $industries=implode(',', request('industry'));
				    $setInsertArray['ot_id'] = $industries;
				}
				
				if($request->has('exhibitor_profile')){
				    $setInsertArray['exhim_profile'] = request('exhibitor_profile');
				}
                    


                $update=DB:: table('1_exhibitor_master')
                ->where('exhim_id', $pdetail->exhim_id)
                ->update(
                    $setInsertArray
                );
          }
          if(!null==request('highlights')){

              if(!empty(request('ehm_id'))){
      
              
                  foreach(request('ehm_id') as $key =>$ehm_id){
                        $update=DB:: table('1_exhibitor_highlights_mapping')
                        ->where('exhim_id', $pdetail->exhim_id)
                        ->where('ehm_id', $ehm_id)
                        ->update(array(
                                    'ehm_highlight_text'=>request('updhighlight')[$key]
                                        )
                                );
                  }
                  
                  
                  if(!null==request('inshighlight')){ 
                      foreach(request('inshighlight') as  $highlightText){
                            if(!empty($highlightText)){
                                  $insthigh=DB::table('1_exhibitor_highlights_mapping')
                                  ->insert(array(
                                      'exhim_id'=> $pdetail->exhim_id,
                                      'ehm_highlight_text'=>$highlightText
                                      ));  
                            }
                      }
                      
                      $update=DB:: table('1_exhibitor_profile_transection')
                        ->where('exid', $pdetail->exhim_id)
                        
                        ->update(array(
                                    'booth_setup_lobby_about'=>1
                                        )
                                );
                  }
                  
              }
              
             else {
                  
                  foreach(request('highlight') as  $highlightText){
                    if(!empty($highlightText)){
                                  $insthigh=DB::table('1_exhibitor_highlights_mapping')
                                  ->insert(array(
                                      'exhim_id'=> $pdetail->exhim_id,
                                      'ehm_highlight_text'=>$highlightText
                                      ));  
                            }
                  }

              }
                    

          }

        return redirect($this->getBaseUrl.'/profile');
    }
    
    function updateProjectGallary(Request $request)
    {
        
        $tdetail=Session('tdetail');
          $pdetail=Session('profileDetail');
          
              
           if(!null==request('video_file')){
                
                $vidName= 'video-'.date('Y-m-d').time().'.mp4';
                $vidPath='/assets/videos/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/gallery/';
                $path = public_path() . $vidPath . $vidName;
                
                File::makeDirectory(public_path() . $vidPath, 0777, true, true);
                request("video_file")->move(public_path($vidPath), $vidName);
                
                $videoUrl = config('app.asset_url').$vidPath.$vidName; //Added For Access File From Metaverse
                
                $insertVideoGallery=array(
                    'exhim_id'=> $pdetail->exhim_id,
                    'epm_id'=> request('epmId'),
                    'eg_name'=>$videoUrl,
                    'eg_type'=>'video'
                );
                if(!null==request('vtype')){
                    $insertVideoGallery['eg_video_type']=request('vtype');
                }
                
                if(!null==request('video_caption')){
                    $insertVideoGallery['eg_caption']=request('video_caption');
                }
                if(!null==request('video_category')){
                    $insertVideoGallery['gcm_id']=request('video_category');
                }
                
                //dd($insertVideoGallery);
                $insert=DB::table('1_exhibitor_gallery')
                            ->insert(
                                $insertVideoGallery
                            );
                
                ##Added for video gallery count 
                $updatetransection=DB::table('1_exhibitor_profile_transection')
                                    ->where('exid', $pdetail->exhim_id)
                                    ->update( array(
                                        'booth_videogallery'=>1
                                    )
                                );
                                
            if($insert)
            {
              return "success";
            }
            else{
              return "failed";
            }
          }

            if(!null==request('upload_photo') && request('photoupload')=='photoupload'){
                
                
                $upload_image=request('upload_photo');
                
                $data = request('logoimage');
                
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                $data = base64_decode($data);
                $imageName= 'photo-'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/gallery/';
                $path = public_path() . $imagePath . $imageName;
                
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                file_put_contents($path, $data);
                
                $imageName = config('app.asset_url').$imagePath.$imageName; //Added For Access File From Metaverse
                    
                ## Create Array ##
                $insertGallery=array(
                              'exhim_id'=> $pdetail->exhim_id,
                              'epm_id' => request('epmId'),
                              'eg_name'=>$imageName,
                              'eg_type'=>'image'
                              );
                              
                   
                if(!null==request('egcaption')){
                    $insertGallery['eg_caption']=request('egcaption');
                }
                if(!null==request('egcategory')){
                    $insertGallery['gcm_id']=request('egcategory');
                }

                $insert=DB:: table('1_exhibitor_gallery')
                ->insert(
                    $insertGallery
                );
                    
                $updatetransection=DB:: table('1_exhibitor_profile_transection')
                          ->where('exid', $pdetail->exhim_id)
                          ->update( array(
                                          'booth_photogallery'=>1
                                        
                                        )
                          );  
                          
              if($insert)
              {
                  return "success";
              }
              else{
                  return "failed";
              }
          } 
    }
    

    function AddCourseOffered(Request $request){
      
      $tdetail=Session('tdetail');
      $pdetail=Session('profileDetail');
      $respArray=array();
      $respArray['code']='404';
      $respArray['htmlData']='';
    

      $exhipm_id="";
      $qm_ids =NULL;
      $setArray= array();
      
      if($request->has('upload_brochure')){
        $pdfFileData=request('upload_brochure');
        $imageName = date('Y-m-d').time().'.'.$pdfFileData->getClientOriginalExtension();

        $imagePath='assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/brochure/';
        $upload_file=$pdfFileData->move(public_path($imagePath), $imageName);
        
        $imageName = config('app.asset_url').$imagePath.$imageName; //For Metaverse Property Expo
        
        $setArray['epm_brochure'] = $imageName;
      }
      
      if($request->has('product_image')){
          
                $pdfFileData=request('product_image');
                $data = request('piimage');
                
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                $data = base64_decode($data);
                $imageNames= 'pimage-'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/brochure/';
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                $path = public_path() . $imagePath . $imageNames;
                
                file_put_contents($path, $data);
                
                $imageNames = config('app.asset_url').$imagePath . $imageNames; //Added For Metaverse Access
        
                // $imageNames = date('Y-m-d').time().'.'.$pdfFileData->getClientOriginalExtension();
                // $imagePath='/assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/brochure/';
                // $upload_file=$pdfFileData->move(public_path($imagePath), $imageNames);
                $setArray['product_image'] = $imageNames;
      }
      if($request->has('product_image2')){
          
                $pdfFileData=request('product_image2');
                $data2= request('piimage2');
                
                list($type, $data2) = explode(';', $data2);
                list(, $data2)      = explode(',', $data2);
                
                $data2 = base64_decode($data2);
                $imageNames2= 'pimage2-'.date('Y-m-d').time().'.jpg';
                $imagePath2='/assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/brochure/';
                File::makeDirectory(public_path() . $imagePath2, 0777, true, true);
                $path2 = public_path() . $imagePath2 . $imageNames2;
                
                file_put_contents($path2, $data2);
                
                $imageNames = config('app.asset_url').$imagePath2 . $imageNames2;
        
                // $imageNames = date('Y-m-d').time().'.'.$pdfFileData->getClientOriginalExtension();
                // $imagePath='/assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/brochure/';
                // $upload_file=$pdfFileData->move(public_path($imagePath), $imageNames);
                $setArray['product_image2'] = $imageNames2;
      }
      
      if($request->has('product_video_url')){
          
               
                $productVideoUrl=request('product_video_url');
              
                if(strpos(request('product_video_url'), '?v') == true){
                    
                     $newurl=explode('?v=',request('product_video_url'));
                     $youtubeKey=explode('&',$newurl[1]);
                     $productVideoUrl="https://www.youtube.com/embed/".$youtubeKey[0];
                } 
                else if(strpos(request('product_video_url'), 'youtu.be/') == true){
                    
                    $newurl=explode('youtu.be/',request('product_video_url'));
                    $productVideoUrl="https://www.youtube.com/embed/".$newurl[1];
                }  
             
                $setArray['product_video'] = $productVideoUrl;
      }

      $ppm_id='';
    //   if(!null==request('stream') && request('stream')=='other'){
    //              $insertstream= DB::table($tdetail['parent_product_master'])
    //                 ->insert(
    //                   array(
    //                         'ppm_text'=>request('new_stream')
    //                       )
    //                   );
    //           $ppm_id = DB::getPdo()->lastInsertId();
    //   }else{
          $ppm_id=request('stream');
    //  }
      
      
      //$ppmm_id = request('pp_subcategory');
      //$ppmmId = implode('|',request('pp_subcategory'));
      $ppmm_id = 1;
      $ppmmId = 1;
     
  
      if(!null==request('Course') && request('Course')=='other') {
          
         
          
          $epm_text=request('new_course');
          $checkexhipmap=array();
          
           $exhipm_id="";
           
          $checkexhipm=DB::table($tdetail['exhibitor_product_master'])
          ->where('epm_text',$epm_text)
          ->where('ppm_id',$ppm_id)
          ->where('ppmm_id','regexp',$ppmmId)
          ->first();
    
          if(!empty($checkexhipm)){
              $exhipm_id=$checkexhipm->exhipm_id;
                $checkexhipmap=DB::table($tdetail['exhibitor_product_mapping'])
              ->where('exhipm_id',$exhipm_id )
               ->where('exhim_id', $pdetail->exhim_id)
               ->where('epm_status','active')
             ->first();
             
          }
      
         
          //if(empty($checkexhipm)){
             if(!empty(request('exhipmId'))){
                
                  $mapcourse = DB::table($tdetail['exhibitor_product_master'])
                            ->where('exhipm_id',request('exhipmId'))
                            ->update(
                              array(
                                    'ppm_id'=>$ppm_id,
                                    'ppmm_id' => $ppmm_id,
                                    'epm_text'=>request('new_course')
                                  )
                            );
                $exhipm_id = request('exhipmId');
        
              }
              else{
                if(empty($checkexhipm)) {
                     $insertcourse= DB::table($tdetail['exhibitor_product_master'])
                            ->insert(
                              array(
                                    'ppm_id'=>$ppm_id,
                                    'ppmm_id' => $ppmm_id,
                                    'epm_text'=>request('new_course')
                                  )
                              );
                      $exhipm_id = DB::getPdo()->lastInsertId(); 
              }
              else{
                  //do nothing
              }
            }
        //   }else{
              
        //   }
              
              
      }else{
        $exhipm_id=request('Course');
        $qm_id= $request->has('Education') ? request('Education') : array();
        $qm_ids = implode(',', $qm_id);
      }
      
      
      

      
      $setArray['exhipm_id']=$exhipm_id;
      $setArray['exhim_id']=$pdetail->exhim_id;
      $setArray['qm_id'] = $qm_ids;
      if($request->has('course_duration')){
          $setArray['epm_duration_in_year']= request('course_duration'); }
      if($request->has('course_fee_sem')){
          //$setArray['epm_fee_charged_per_sem']= request('course_fee_sem'); 
          $setArray['epm_area']= request('course_fee_sem');
        }
      if($request->has('course_fee_year')){
          //$setArray['epm_total_fee_charged']= request('course_fee_year'); 
          $setArray['epm_total_price']= request('course_fee_year');}
      if($request->has('course_fee_text')){
          $setArray['epm_course_fee_text']= request('course_fee_text'); }
      if($request->has('scholarship_program')){
          $setArray['epm_scholarship_program']= request('scholarship_program'); }
      if($request->has('epm_additional_details')){
          $setArray['epm_additional_details']= request('epm_additional_details'); }
          
        if($request->has('property_onwer_name')){
          $setArray['epm_property_owner']= request('property_onwer_name'); }
          
        if($request->has('property_location')){
            $setArray['epm_property_location']= request('property_location'); }

      if($request->has('new_stream')){
              $setArray['ppm_other_text']= request('new_stream'); }

      if(!empty(request('epmId'))){

          $mapcourse = DB::table($tdetail['exhibitor_product_mapping'])
                    ->where('epm_id',request('epmId'))
                    ->update(
                      $setArray  
                    );
          $respArray['code']='200';

      }else if(empty($checkexhipmap)) {
          $mapcourse= DB::table($tdetail['exhibitor_product_mapping'])
                      ->insert(
                        $setArray
                  );
          $respArray['code']='200';

      }

        ## Course List ##
        $AddedCourse=ComModel::getCourseMasterByExhibitor();
        return view('others.viewcourselist',['AddedCourse'=>$AddedCourse,  'prefix_url' => $this->getBaseUrl]);
    }

#######END CLASS ###


    public function bothstaff(){

      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');
      if(Session::has('paginate')){
          $paginate = Session::get('paginate');
      } else{
        $paginate = 10;
      }
      if (null !==(request('pagination'))){
          $paginate = request('pagination');
          Session::put('paginate', $paginate);
      }
      $searchText="";
      if (null !==(request('search_text'))){
          $searchText = request('search_text');
          //Session::put('search_text', $search_text);
      }
     
      $leadList=DB::table($tdetail['exhibitor_boothstaff'] .' as ebs')
      ->Join($tdetail['exhibitor_event_mapping'] .' as eem','ebs.exhim_id', 'eem.exhim_id')
      ->leftjoin($tdetail['exhibitor_event_with_boothstaff_mapping'] .' as eewbm',function($join){
            $join->on('eem.eem_id', 'eewbm.eem_id')
               ->on('ebs.ebsm_id','eewbm.ebsm_id');
               //->where('pps_id','1');
        })
     
      ->where('at_id','4');
      if(!empty($searchText)){
            $leadList->where(function($query) use ($searchText) {
                $query->orwhere('ebs.ebsm_name','like','%'.$searchText.'%')
                    ->orwhere('ebs.ebm_login_user','like','%'.$searchText.'%')
                    ->orwhere('ebs.ebsm_mobile','like','%'.$searchText.'%');
            });
      }
      $leadList->select(
        'eem.aem_id',
        'eem.eem_id',
        'eem.ppm_id',
        'ebs.*',
        'eewbm.*'
        //'eewbm.eewbm_id',
         //'eewbm.eewbm_priority_in_list',
        //'eewbm.pps_id','eewbm.eewbm_counseling_topics',
        //DB::raw(" (CASE WHEN eewbm.eewbm_status = 'active' && ebs.ebsm_statu='active' THEN 'Active' ELSE 'Inactive' END) AS staffStatus ")
     );


           //$leadList->where('eewbm.eewbm_status', 'active');
    // $leadList->where('ebs.ebsm_statu', 'active');
      $leadList->where('eem.exhim_id', $profileDetail->exhim_id);
      $leadList->where('eem.aem_id', $eventDetails->aem_id);
      $res=$leadList->paginate($paginate);
      
      //dd($res);

    $subsUsage=DB::table($tdetail['participation_plans_subscription_mapping'].' as ppsm')
                            ->join($tdetail['participation_plans_master'].' as ppm','ppsm.ppm','ppm.ppm_id')
                            ->join($tdetail['participation_plans_subscription'].' as pps','ppsm.pps_id','pps.pps_id')
                            ->join($tdetail['exhibitor_event_mapping'].' as eem','ppm.ppm_id','eem.ppm_id')
                            ->leftjoin(DB::raw('(SELECT count(eewbm.pps_id) as Total,eewbm.pps_id,eem.ppm_id
                                  FROM  '.$tdetail['exhibitor_boothstaff'].' AS `ebs`
                        
                                    INNER JOIN '.$tdetail['exhibitor_event_mapping'].' AS `eem` 
                                                 ON `ebs`.`exhim_id` = `eem`.`exhim_id` 
                                     JOIN '.$tdetail['exhibitor_event_with_boothstaff_mapping'].' AS `eewbm` 
                                                            ON `eem`.`eem_id` = `eewbm`.`eem_id`
                                                            AND ebs.ebsm_id=eewbm.ebsm_id
                                                            WHERE  `ebs`.`exhim_id` = "'.$profileDetail->exhim_id.'" 
                                                                   AND `eem`.`exhim_id` = "'.$profileDetail->exhim_id.'"  
                                                                   AND `eem`.`aem_id` = "'.$eventDetails->aem_id.'" 
                                                                   AND `eewbm`.`eewbm_status` = "active"
                                   
                                   group by eewbm.pps_id) as exhibdata'),
                        	        function($join)
                        	        {
                        	           $join->on('pps.pps_id','exhibdata.pps_id');
                        	        })
                            ->where('eem.exhim_id',$profileDetail->exhim_id)
                            ->where('eem.aem_id',$eventDetails->aem_id)
  
                            ->select('exhibdata.Total','pps.pps_id','pps.pps_name')
                            ->groupby('pps.pps_id','pps.pps_name')
                            ->get();

                            $accessType=DB::table($tdetail['participation_plans_subscription_mapping'].' as ppsm')
                                ->join($tdetail['participation_plans_master'].' as ppm','ppsm.ppm','ppm.ppm_id')
                                ->join($tdetail['participation_plans_subscription'].' as pps','ppsm.pps_id','pps.pps_id')
                                ->join($tdetail['exhibitor_event_mapping'].' as eem','ppm.ppm_id','eem.ppm_id')
                                ->where('eem.exhim_id',$profileDetail->exhim_id)
                                ->where('eem.aem_id',$eventDetails->aem_id)
                                ->where('pps.pps_status','active')
                                ->get();
                                
                                //dd($accessType);
        
                                $servicetaken=DB::table('1_exhi_addon_service_mapping as easm')
                                ->join($tdetail['participation_plans_subscription'].' as pps','easm.pps_id','pps.pps_id')
                                ->select(DB::raw("sum(easm.count) as ctr,easm.pps_id,pps.pps_name"))
                                ->where('easm.exhim_id',$profileDetail->exhim_id)
                                ->groupby('easm.pps_id','pps.pps_name')->get();                    


                        $accessTypeDropdownDataOption='';
                        foreach($accessType as  $option){
                            $disabled='';
                           foreach($subsUsage as $totalused){
                               
                               $ppsmcount=$option->ppsm_count;
                               foreach($servicetaken as $addon){
                                   if($option->pps_id==$addon->pps_id){
                                       $ppsmcount=$ppsmcount+$addon->ctr;
                                       break;
                                   }
                               }
                                   
                               
                                            if($totalused->pps_id==$option->pps_id && ($ppsmcount-$totalused->Total)!=0 ){
                                                 if($option->pps_id==1 || $option->pps_id==2 || $option->pps_id==7){
                                                 $accessTypeDropdownDataOption .='<option value="'.$option->pps_id.'" >'.$option->pps_name.'</option>'; 
                                                 }
                               
                                                break;
                                           
                               }
                            }
                               
                        }
    
                        $counm_code=DB::table($tdetail['master_country'])->where('counm_id',$profileDetail->counm_id)->first();
                        
                        $countryList = DB::table($tdetail['master_country'])
                        ->orderby('counm_orderby','asc')
                        ->orderby('counm_name','asc')
                        ->get();

      
        return view('datatables.bothstaff-tables',[
            'leadList'=>$res,
            'profileDetail'=>$profileDetail,
            'counm_code'=>$counm_code,
            'accessTypeDropdownDataOption'=>$accessTypeDropdownDataOption,
            'subsUsage'=>$subsUsage,
            'accessType'=>$accessType,
            'servicetaken'=>$servicetaken , 
            'countryList'=>$countryList,
            'prefix_url' => $this->getBaseUrl
            ]);
    }

    public function getbothstaff(){

      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');

      $leadList=DB::table($tdetail['exhibitor_boothstaff']);
      $leadList->where('ebs_statu', 'active');
      $leadList->where('exhim_id', $profileDetail->exhim_id);
      $res=$leadList->get();
      return $res;

     }

     public function callcitylist(Request $request) {
			$respReq=array();
			$respReq['code']='404';
			$respReq['msg']='The records not found!';

				
				$state="";
				if(!empty(request('state'))){
					$state=request('state');
				}
				$cityMaster=ComModel::getCityMaster($state);
				if(!empty($cityMaster)){
					$respReq['code']='200';
						$htmlAppend='<option value="">Select Please</option>';
						$htmlMobAppend="";
						if(!empty($cityMaster)){
							foreach($cityMaster as $key => $cityData){
                $htmlAppend .=' <option value="'.$cityData->cm_id.'" > '.$cityData->cm_name.' </option>';
							}
						}

					$respReq['htmlAppend']=$htmlAppend;
				}
		return json_encode($respReq);
  }
  

    public function addeditcourse(){

      $stateId=null;
      $countryId=null;
      $ppmId=null;
      $exhipmId = null;
      $applyedDetails=array();
      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');
      $epmId="";
      if(!empty(request('epmId'))){
          $epmId=request('epmId');
          $profileSql = DB::table($tdetail['exhibitor_product_mapping']. ' as epmap')
                    ->Join($tdetail['exhibitor_product_master'].' as epm', 'epm.exhipm_id', 'epmap.exhipm_id')
                    ->Join($tdetail['parent_product_master'].' as ppm', 'ppm.ppm_id', 'epm.ppm_id')
                    ->select('epmap.*','epm.*','ppm.*');
                    if(!empty(request('epmId'))){
                      $profileSql->where('epmap.epm_id', request('epmId'));
                    }
                    $profileSql->where('epmap.exhim_id', $profileDetail->exhim_id);
          $applyedDetails= $profileSql->first();
          $ppmId =$applyedDetails->ppm_id;
          $exhipmId = $applyedDetails->exhipm_id;
      }



      $coursesDetails=HomeController::getcourses($ppmId);

      return view('others.addeditcourse', [
        'coursesDetails'=>$coursesDetails,
        'applyedDetails'=>$applyedDetails,
        'epmId' => $epmId,
        'exhipmId'=>$exhipmId,

        'prefix_url' => $this->getBaseUrl
      ]);
    }

    public function addcategory(Request $request) {

      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');
    
    
      $leemId = empty(request('leemId')) ? '' : request('leemId') ;
      
      if(!empty($leemId)){

            $dataList=DB::table($tdetail['lead_event_exhibitor_mapping'])
                        ->where('leem_id', request('leemId'))->first();

              # Remark History#
              $remarkList=ComModel::getExhibitorRemark(request('leemId'));

              $leadcat=ComModel::getLeadCategorization();
              $htmlAppend='<option value="">Select Please</option>';

              if(!empty($leadcat)){
                  foreach($leadcat as $key => $catData){
                    $htmlAppend .=' <option value="'.$catData->lc_id.'" ';
                  
                    if($dataList->lc_id==$catData->lc_id)
                      $htmlAppend .=' selected ';

                    $htmlAppend .='> '.$catData->lc_text.' </option>';
                  }
              }
          }
       
        return view('datatables.catgaction',['htmlAppend'=>$htmlAppend, 'leemId'=>$leemId, 'remarkList'=>$remarkList ]);
    }

    public function showhistory(Request $request) {
      
      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');
    
      $leemId = empty(request('leemId')) ? '' : request('leemId') ;
    
      # Remark History#
      $remarkList=ComModel::getExhibitorRemark($leemId);
      
      return view('datatables.showhistory',['remarkList'=>$remarkList, 'prefix_url' => $this->getBaseUrl ]);
  }

    
    public function changeleadstatus(){

      $respReq['code']='404';
      $respReq['msg']='The records not found!';

      $tdetail=Session('tdetail');
      $sessDetails=Session('profileDetail');
      $ip=HelperController::realIp();

      if(!null==request('leemId')) {

           
             $respReq['code']='200';

              ## Last Remark Update ##
              DB::table($tdetail['lead_event_exhibitor_mapping'])
              ->where('leem_id',request('leemId'))
              ->update(
                      array(
                            'leem_updateby'=>$sessDetails->ebsm_id,
                            'leem_updateby_ip'=>$ip,
                            'lc_id'=>request('clsstage'),
                            'leem_last_remark_update_date'=> now(),
                            'leem_comment'=>request('clscomment')
                    )
              );

              ## ADD Remark ##
              DB::table($tdetail['lead_event_exhibitor_mapping_remark'])
              ->insert(
                      array(
                            'leem_id'=> request('leemId'),
                            'leer_updateby'=> $sessDetails->ebsm_id,
                            'leer_updateby_ip'=> $ip,
                            'lc_id'=> request('clsstage'),
                            'leer_remark'=> request('clscomment')
                    )
              );

      }

       return json_encode($respReq);
  }

public static function subscription_usage(){
    
      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');
      
    $subsUsage=DB::table($tdetail['participation_plans_subscription_mapping'].' as ppsm')
                            ->join($tdetail['participation_plans_master'].' as ppm','ppsm.ppm','ppm.ppm_id')
                            ->join($tdetail['participation_plans_subscription'].' as pps','ppsm.pps_id','pps.pps_id')
                            ->join($tdetail['exhibitor_event_mapping'].' as eem','ppm.ppm_id','eem.ppm_id')
                            ->leftjoin(DB::raw('(SELECT count(eewbm.pps_id) as Total,eewbm.pps_id,eem.ppm_id
          FROM  `1_exhibitor_boothstaff` AS `ebs`

            INNER JOIN `1_exhibitor_event_mapping` AS `eem` 
                         ON `ebs`.`exhim_id` = `eem`.`exhim_id` 
             JOIN `1_exhibitor_event_with_boothstaff_mapping` AS `eewbm` 
                                    ON `eem`.`eem_id` = `eewbm`.`eem_id`
                                    AND ebs.ebsm_id=eewbm.ebsm_id
                                    WHERE  `ebs`.`exhim_id` = "'.$profileDetail->exhim_id.'" 
                                           AND `eem`.`exhim_id` = "'.$profileDetail->exhim_id.'"  
                                           AND `eem`.`aem_id` = "'.$eventDetails->aem_id.'" 
                                           AND `eewbm`.`eewbm_status` = "active"
           
           group by eewbm.pps_id) as exhibdata'),
	        function($join)
	        {
	           $join->on('pps.pps_id','exhibdata.pps_id');
	        })
                            ->where('eem.exhim_id',$profileDetail->exhim_id)
                            ->where('eem.aem_id',$eventDetails->aem_id)
  
                            ->select('exhibdata.Total','pps.pps_id','pps.pps_name')
                            ->groupby('pps.pps_id','pps.pps_name')
                            ->get();
                            
                            return $subsUsage;
}

public function savevisitingcard (){
           
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
            if(!empty(request('imteractive_image1'))){
                // $image=request('imteractive_image1');
              
                // $destinationPath = 'assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive/'; // upload path
                // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                // $image_url1 = $destinationPath.$profileImage;
                   
                // $success = $image->move($destinationPath, $profileImage); 
            
                // $arrayToUpdateSave['visiting_card_image']=$image_url1;
            }
            
            if(!null==request('imteractive_image1')){
                $upload_image=request('imteractive_image1');
                
                
                $data = request('logoimage');
    
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
        
        
                $data = base64_decode($data);
                
                $imageName= date('YmdHis') . "." . $upload_image->getClientOriginalExtension();
                $imagePath='/assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive/';
                $path = public_path() . $imagePath . $imageName;
        
                //dd($path);
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                file_put_contents($path, $data);
                
                //$profileImage = date('YmdHis') . "." . $upload_image->getClientOriginalExtension();
                $image_url1 = $imagePath.$imageName;
                $arrayToUpdateSave['visiting_card_image']=$image_url1;
                       
            }
         
       
           $data= DB::table('1_exhibitor_event_with_boothstaff_mapping')->where('ebsm_id',$pdetail->ebsm_id);
            $updateuser = DB::table('1_exhibitor_event_with_boothstaff_mapping')->where('ebsm_id',$pdetail->ebsm_id)
                           
                                ->update(
                                      $arrayToUpdateSave
                              );
                    
                
        
        return redirect($this->getBaseUrl.'/visiting-card');
        
        }

    public  function saveData(Request $request)
    {
          $respArray=array();
          $tdetail=Session('tdetail');
          $selectedEvent=Session('selectedEvent');
        $pdetail=Session('profileDetail');
          

          $ebsm_id =request('ebsmId');
          
          $getebsmdetail=DB::table($tdetail['exhibitor_boothstaff'])
          ->where('ebsm_id',$ebsm_id)
          ->get();
          $eemId =request('eemId');
          $eewbmId =request('eewbmId');
          $ppsId =request('pps_id');
          $eewbmStatus =request('status');
          $returnVal="";
        $videoChat=array(1);
          if(empty($eewbmId)){
               $room_id='';
            $append="";
            // if(in_array(request('pps_id'),$videoChat)){
            //     $roomId=  RoomController::createRoom();
            //     $room_id=json_decode($roomId->getContent(),TRUE)['room']['room_id'];
            // }
              
            $eewbmId=DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
                      ->insertGetId([
                        'eewbm_status'=>'active',
                        'ebsm_id'=>$ebsm_id,
                        'eem_id'=>$eemId,
                        'pps_id'=>$ppsId,
       
                      'eewbm_whatsapp_id'=>$getebsmdetail[0]->ebsm_country_code.$getebsmdetail[0]->ebsm_mobile
                      ]);
                      $returnVal="active";

          }else{

            //   $check = DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
            //         ->where('eewbm_id',$eewbmId)
            //         ->select('eewbm_status','eewbm_video_caller_id')
            //         ->first();

            $check = DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'].' as eewbm')
                    ->join($tdetail['exhibitor_boothstaff'].' as ebs','eewbm.ebsm_id','ebs.ebsm_id')
                    ->whereNotNull('eewbm_video_caller_id')
                    ->whereNotNull('eewbm_video_caller_id_moderator')
                    ->where('ebs.exhim_id',$pdetail->exhim_id)
                    ->where('pps_id','!=',1)
                    ->select('eewbm_status','eewbm_video_caller_id','eewbm_video_caller_id_moderator')
                    ->first();
       
                     $room_id='';
                     $room_id_url='';
                    if(in_array(request('pps_id'),$videoChat) && empty($check->eewbm_video_caller_id)){
                       // $roomId=  RoomController::createRoom();
                       // $room_id=json_decode($roomId->getContent(),TRUE)['room']['room_id'];
                        $roominfo=ApiController::createRoomBooth(request());
                        $roomdetails=json_decode($roominfo->getContent(),TRUE);
                        $room_id = $roomdetails['name'];
                        $room_id_url = $roomdetails['url'];
                         $boothstaffMappingArray['eewbm_video_caller_id']=$room_id;
                        $boothstaffMappingArray['eewbm_video_url']=$room_id_url;
                    }  
                    
                    $attendId="";
                    $ModeratattendId="";
                    if(isset($check->eewbm_video_caller_id) && !empty($check->eewbm_video_caller_id)){
                       $attendId=$check->eewbm_video_caller_id;
                       $ModeratattendId=$check->eewbm_video_caller_id_moderator;
                       
                       
                                     DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
                              ->where('eewbm_id',$eewbmId)
                              ->update([
                                'eewbm_status'=>$eewbmStatus,
                                'ebsm_id'=>$ebsm_id,
                                'eem_id'=>$eemId,
                                'pps_id'=>$ppsId,
                                'eewbm_video_caller_id'=>$room_id,
                                'eewbm_video_caller_id_moderator'=>$ModeratattendId,
                                'eewbm_video_url'=>$room_id_url,
                                'eewbm_whatsapp_id'=>$getebsmdetail[0]->ebsm_country_code.$getebsmdetail[0]->ebsm_mobile
                              ]);

                    }else{
                                         DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
                              ->where('eewbm_id',$eewbmId)
                              ->update([
                                'eewbm_status'=>$eewbmStatus,
                                'ebsm_id'=>$ebsm_id,
                                'eem_id'=>$eemId,
                                'pps_id'=>$ppsId,
                                'eewbm_video_caller_id'=>$room_id,
                                 'eewbm_video_url'=>$room_id_url,
                                'eewbm_whatsapp_id'=>$getebsmdetail[0]->ebsm_country_code.$getebsmdetail[0]->ebsm_mobile
                              ]);
                    }
     

                  $returnVal=$eewbmStatus;
              
          }
        //   $respArray['ppsId']= $ppsId;
        //   $respArray['ebsmId']= $ebsm_id;
        //   $respArray['eemId']= $eemId;
        //   $respArray['eewbmId']= $eewbmId;
        //   $respArray['status']= $returnVal;

        return HomeController::subscription_usage();
      //  return   json_encode($respArray);
    }

    public function edituser(){
        $tdetail=Session('tdetail');
        $profileDetail=Session('profileDetail');
        $eventDetails=Session('selectedEvent');     
        $ebsmId="";
        $dataList=array();
        
                if(!empty(request('ebsmId'))){ 
                  
                       
                        $ebsmId=request('ebsmId');
                        
                        $dataList =  DB::table($tdetail['exhibitor_boothstaff'] .' as ebs')
                                    ->leftJoin($tdetail['exhibitor_event_with_boothstaff_mapping'] .' as eewbm','ebs.ebsm_id', 'eewbm.ebsm_id')
                                    ->leftjoin($tdetail['exhibitor_event_mapping'] .' as eem', function($join){
                                                        $join->on('eewbm.eem_id', 'eem.eem_id')
                                                        ->on('ebs.exhim_id','eem.exhim_id');
                                                        })
                                    ->where('ebs.ebsm_id',$ebsmId)
                                    ->select('ebs.*','eem.*','eewbm.eewbm_id','eewbm.eewbm_counseling_topics','eewbm.pps_id','eewbm.epm_id')
                                    ->first();
                }
            
                $subsUsage=DB::table($tdetail['participation_plans_subscription_mapping'].' as ppsm')
                ->join($tdetail['participation_plans_master'].' as ppm','ppsm.ppm','ppm.ppm_id')
                ->join($tdetail['participation_plans_subscription'].' as pps','ppsm.pps_id','pps.pps_id')
                ->join($tdetail['exhibitor_event_mapping'].' as eem','ppm.ppm_id','eem.ppm_id')
                ->leftjoin(DB::raw('(SELECT count(eewbm.pps_id) as Total,eewbm.pps_id,eem.ppm_id
                                    FROM  '.$tdetail['exhibitor_boothstaff'].' AS `ebs`
                                    
                                    INNER JOIN '.$tdetail['exhibitor_event_mapping'].' AS `eem` 
                                                 ON `ebs`.`exhim_id` = `eem`.`exhim_id` 
                                     JOIN '.$tdetail['exhibitor_event_with_boothstaff_mapping'].' AS `eewbm` 
                                        ON `eem`.`eem_id` = `eewbm`.`eem_id`
                                        AND ebs.ebsm_id=eewbm.ebsm_id
                                        WHERE  `ebs`.`exhim_id` = "'.$profileDetail->exhim_id.'" 
                                               AND `eem`.`exhim_id` = "'.$profileDetail->exhim_id.'"  
                                               AND `eem`.`aem_id` = "'.$eventDetails->aem_id.'" 
                                               AND `eewbm`.`eewbm_status` = "active"
                
                                    group by eewbm.pps_id) as exhibdata'),function($join) {
                                       $join->on('pps.pps_id','exhibdata.pps_id');
                    })
                ->where('eem.exhim_id',$profileDetail->exhim_id)
                ->where('eem.aem_id',$eventDetails->aem_id)
                
                ->select('exhibdata.Total','pps.pps_id','pps.pps_name')
                ->groupby('pps.pps_id','pps.pps_name')
                ->get();
                
                
                $accessType=DB::table($tdetail['participation_plans_subscription_mapping'].' as ppsm')
                ->join($tdetail['participation_plans_master'].' as ppm','ppsm.ppm','ppm.ppm_id')
                ->join($tdetail['participation_plans_subscription'].' as pps','ppsm.pps_id','pps.pps_id')
                ->join($tdetail['exhibitor_event_mapping'].' as eem','ppm.ppm_id','eem.ppm_id')
                ->where('eem.exhim_id',$profileDetail->exhim_id)
                ->where('eem.aem_id',$eventDetails->aem_id)
                ->get();
                
                
                $servicetaken=DB::table('1_exhi_addon_service_mapping as easm')
                ->join($tdetail['participation_plans_subscription'].' as pps','easm.pps_id','pps.pps_id')
                ->select(DB::raw("sum(easm.count) as ctr,easm.pps_id,pps.pps_name"))
                ->where('easm.exhim_id',$profileDetail->exhim_id)
                ->groupby('easm.pps_id','pps.pps_name')->get();                    


                $accessTypeDropdownDataOption='';
                foreach($accessType as  $option){
                    $disabled='';
                   foreach($subsUsage as $totalused){
                       
                                   $ppsmcount=$option->ppsm_count;
                                   foreach($servicetaken as $addon){
                                       if($option->pps_id==$addon->pps_id){
                                           $ppsmcount=$ppsmcount+$addon->ctr;
                                           break;
                                       }
                                   }
                           
                       
                                    if($totalused->pps_id==$option->pps_id && ($ppsmcount-$totalused->Total)!=0 ){
                                        
                                         if($option->pps_id==1 || $option->pps_id==2 || $option->pps_id==7){
                                             
                                                $selOption="";
                                                if(isset($dataList->pps_id) && $dataList->pps_id==$option->pps_id){
                                                     $selOption="selected";
                                                }
                                                $accessTypeDropdownDataOption .='<option value="'.$option->pps_id.'"  '.$selOption.' >'.$option->pps_name.'</option>'; 
                                         }
                       
                                        break;
                                    }
                    }
                       
                }
            //dd($subsUsage);
           // dd($accessTypeDropdownDataOption);
            
            $counm_code=DB::table($tdetail['master_country'])->where('counm_id',$profileDetail->counm_id)->first();
            $countryList = DB::table($tdetail['master_country'])
                        ->orderby('counm_orderby','asc')
                        ->orderby('counm_name','asc')
                        ->get();  
                        
             $productList=DB::table('1_exhibitor_product_mapping as epm')
                ->join('1_exhibitor_product_master as expm','expm.exhipm_id','epm.exhipm_id')
                ->join('1_parent_product_master as ppm','ppm.ppm_id','expm.ppm_id')
                ->where('epm.exhim_id',$profileDetail->exhim_id)
                ->where('epm.epm_status','active')
                ->select('ppm.ppm_id','expm.exhipm_id','epm.epm_id','expm.epm_text')
                ->groupby('epm.epm_id')
                ->get();  
                
            
            
            return view('datatables.edituser',[
                        'dataList'=>$dataList,
                        'counm_code'=>$counm_code,
                        'ebsmId'=>$ebsmId,
                        'accessTypeDropdownDataOption'=>$accessTypeDropdownDataOption,
                        'countryList'=>$countryList,
                        'productList' =>$productList
            ]);

        
  }


 public function adduser()
  {
    $tdetail=Session('tdetail');
    $pdetail=Session('profileDetail');
    $eventDetails=Session('selectedEvent');
    $selectedEvent=Session('selectedEvent');
    
    $responseArray=array();
    $responseArray['code']='404';
    
    $videoChat=array(1);
    $audioCall=array(7);
    
        $arrayToUpdateSave=array(   
            'exhim_id'=>$pdetail->exhim_id,
            'ebsm_name'=>request('name'),
            'ebsm_mobile'=>request('phone'),
            'ebm_login_user'=>request('email'),
            'ebm_login_pwd'=>request('password'),
            'ebsm_country_code'=>request('country_code'),
            'ebsm_designation'=>request('designation')
        );
        
        ## Image Upload ## 
        $image=request('profile');
        if(!empty($image)){
            $destinationPath = 'assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/exhibitorProfile/'; // upload path
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image_url = $destinationPath.$profileImage;
            $success = $image->move($destinationPath, $profileImage); 
        
            $arrayToUpdateSave['ebsm_profile_pic']=$image_url;
        }
        
        
        
        ## boothstaffMapping ##
        $boothstaffMappingArray=array(    
                'eewbm_whatsapp_id'=>request('country_code').request('phone')
               
                );
                
        ## Create Meeting Room ##  
        $room_id='';
        $append="";
        $room_id_url="";
        if(in_array(request('acccess_type'),$videoChat)){
            /*$roomId=  RoomController::createRoom();
            $room_id=json_decode($roomId->getContent(),TRUE)['room']['room_id'];
            
            $boothstaffMappingArray['eewbm_video_caller_id']=$room_id;*/
         
            $roominfo=ApiController::createRoomBooth(request());
            $roomdetails=json_decode($roominfo->getContent(),TRUE);
            $room_id = $roomdetails['name'];
            $room_id_url = $roomdetails['url'];
             $boothstaffMappingArray['eewbm_video_caller_id']=$room_id;
             $boothstaffMappingArray['eewbm_video_url']=$room_id_url;
       }
       
       if(in_array(request('acccess_type'),$audioCall)){
           $boothstaffMappingArray['eewbm_audio_call']='active';
       }
                
        if(null!=request('epmId')){
            $boothstaffMappingArray['epm_id']=request('epmId');
        }else{
            $boothstaffMappingArray['epm_id']=NULL;
        }
        
        if(null!=request('eewbmCounselingTopics')){
            $boothstaffMappingArray['eewbm_counseling_topics']=request('eewbmCounselingTopics');
        }else{
            $boothstaffMappingArray['eewbm_counseling_topics']=NULL;
        }
        
       // print_r($boothstaffMappingArray);exit;

                     
      if(!empty(request('ebsmId'))){

                ## Update ##
                $updateuser = DB::table($tdetail['exhibitor_boothstaff'])
                ->where('ebsm_id',request('ebsmId'))
                ->update(
                     $arrayToUpdateSave   
                );
              
            
                ## boothstaffMapping ##
                // $updateData = DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
                // ->where('eewbm_id',request('eewbm_id'))
                // ->update(
                //     $boothstaffMappingArray
                // );

               $responseArray['code']='200';
                //return 'true';
              
      }else {

                $exhBoothStaff= DB::table($tdetail['exhibitor_boothstaff'])
                ->where('exhim_id', $pdetail->exhim_id)
                ->where('ebm_login_user', request('email'))
                ->first();
                
                
                if(empty($exhBoothStaff)){
                
                    $geteemid=DB::table($tdetail['exhibitor_event_mapping'])
                    ->where('exhim_id',$pdetail->exhim_id)
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->first();
                            
                            
                    # save #
                    $ebsmId= DB::table($tdetail['exhibitor_boothstaff'])
                                    ->insertGetId(
                                        $arrayToUpdateSave
                                    );
                            
                            
                    $boothstaffMappingArray['eem_id']=$geteemid->eem_id;
                    $boothstaffMappingArray['ebsm_id']=$ebsmId;
                    $boothstaffMappingArray['pps_id']=request('acccess_type');
                    
                    $insertData = DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
                        ->insert(
                              $boothstaffMappingArray
                        );
                
                }else{
                
                    if($exhBoothStaff->at_id=='3'){
                         $responseArray['code']='409';
                         echo json_encode($responseArray); exit;
                    }else{
                         $responseArray['code']='408';
                         echo json_encode($responseArray); exit;
                    }
                }
                
                if ($insertData== true){
                    $responseArray['code']='200';
                }else{
                    $responseArray['code']='false';
                }
                    
        }

        echo json_encode($responseArray);exit;
  }

   #####======================= Set Session ===================================#####
   public function seteventasrequest()
   {
         $resp=Array();
         $resp['code']='404';
         $tdetail=Session('tdetail');
         $sessDetails=Session('profileDetail');

       if(request('eventid')){

             $eventid=request('eventid');
             
             ## Current : Event Detail #
             $evntDetail = DB::table($tdetail['event_master'])
             ->where('aem_id', '=', request('eventid'))
             ->orderBy('aem_id', 'DESC')
             ->first();
             if(isset($evntDetail)){
                 Session::put('selectedEvent', $evntDetail);
                 $resp['code']='200'; 
                 $resp['data']= $evntDetail;
             }
           
       }
       return Redirect::to('/'.base64_decode(request('targetpage'))); 
     }
   
   
    public function reqonoff()
    {
          $resp=Array();
          $resp['code']='404';
          $tdetail=Session('tdetail');
          $sessDetails=Session('profileDetail');
  
          if(request('reqstatus')){
           
              $reqstatus=request('reqstatus');

              $check = DB::table($tdetail['exhibitor_boothstaff'])
              ->where('ebsm_id', $sessDetails->ebsm_id)
              ->select('ebsm_livestatus')
              ->first();
              if(!empty($check)){
                    $setStatus="online";
                    if ($check->ebsm_livestatus == 'online') {
                      $setStatus="offline";
                    }

                    ## Current : Event Detail #
                    DB::table($tdetail['exhibitor_boothstaff'])
                    ->where('ebsm_id', $sessDetails->ebsm_id)
                    ->update(
                      array(
                        'ebsm_livestatus' => $setStatus
                      )
                    );
                    
                    
                    Session::put('livestatus', $setStatus);
                    $resp['code']='200'; 
              }
              
          }
          return json_encode($resp);
      
      }


    public function saveexhibitordata(Request $request) 
    {
        $resp=Array();
        $resp['code']='404';
        $tdetail=Session('tdetail');
        $sessDetails=Session('profileDetail');
    
        if($request->has('ebm_id')){
            if(!null==request('ebm_id')){
                DB::table('1_exhibitor_master')
                ->where('exhim_id', $sessDetails->exhim_id)
                ->update(
                    array(
                    'ebm_id' => request('ebm_id'),
                    
                    )
                );  
            }
            $resp['code']='200'; 
        }
    
        if($request->has('exId')){
            if(!null==request('qs_i_gauge')){
                DB::table('1_exhibitor_master')
                ->where('exhim_id', request('exId'))
                ->update(
                    array(
                    'exhim_qs_i_gauge' => request('qs_i_gauge'),
                    'exhim_qs_logo' => request('QSLOGO')
                    )
                );  
            }
    
            if(!null==request('No_PaperForms')){
                DB::table('1_exhibitor_master')
                ->where('exhim_id', request('exId'))
                ->update(
                    array(
                    'exhim_NoPaperForms' => request('No_PaperForms'),
                    'exhim_np_secret_key' => request('secret_key'),
                    'exhim_np_college_id' => request('college_id')
                    )
                );  
            }
    
            if(request('exhim_scholarship_percentage') || request('exhim_scholarship_percentage')==0){
    
                DB::table('1_exhibitor_master')
                ->where('exhim_id', request('exId'))
                ->update(
                    array(
                    'exhim_scholarship_percentage' => request('exhim_scholarship_percentage'),
                    'exhim_scholarship' => 'Y'
                    )
                );  
            }
            $resp['code']='200'; 
        }
        return json_encode($resp);
    }
    
    
     public function deletecourse()
          {
                $tdetail=Session('tdetail');
                $profileDetail=Session('profileDetail');
                $eventDetails=Session('selectedEvent');
                if(!empty(request('epmId'))){
                $epmId=request('epmId');
                $updateuser = DB::table($tdetail['exhibitor_product_mapping'])
                         ->where('epm_id',request('epmId'))
                        ->update(
                              array(  
                                  'epm_status' => 'inactive'
                            )
                      );
                
                }
          }
    
     public function RemoveBrochure(){
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
              if(!empty(request('exhim_id'))){
                  $updateuser = DB::table('1_exhibitor_master')
                     ->where('exhim_id',request('exhim_id'))
                    ->update(
                          array(  
                              'exhim_brochure' => null
                        )
                  );
              }
        }
    
        public function RemoveGalleryItem(){
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
              if(!empty(request('egid'))){
                      
                          $updateuser = DB::table('1_exhibitor_gallery')
                            ->where('eg_id',request('egid'))
                             ->where('exhim_id',$pdetail->exhim_id)
                            ->update(
                                  array(  
                                      'eg_status' => 'inactive'
                                )
                          );
            
        
              }
        }
        
        public function RemoveBusinessCardItem(){
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
              if(!empty(request('immId'))){
                      
                $updateuser = DB::table('1_interactive_map_master')->where('id',request('immId'))->delete();
        
              }
        }
        
        public function RemoveBoothStaffUser(){
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
              if(!empty(request('ebsmId'))){
                      
                DB::table($tdetail['exhibitor_boothstaff'])->where('ebsm_id',request('ebsmId'))->delete();
                DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])->where('ebsm_id',request('ebsmId'))->delete();
              }
        }
        
        public function RemoveBsmUser(){
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
              if(!empty(request('ebsmId'))){
                      
                DB::table($tdetail['exhibitor_boothstaff'])->where('ebsm_id',request('ebsmId'))->delete();
              }
        }
        
        
        
        
        
        
        
        
        public function saveThumbnaildata (){
            
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
                    
                if(!null==request('thumbnail') && request('thumbnailimg')=='thumbnailimg'){    
                    $data = request('thumbnail');
                    
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    
                    
                    $data = base64_decode($data);
                    $image_name= 'thumbnail-'.date('Y-m-d').time().'.jpg';
                    $imagePath='/assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/thumbnail/';
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    $path = public_path() . $imagePath . $image_name;
                    
                    
                    file_put_contents($path, $data);
                    
              
              
                        $update = DB::table('1_exhibitor_master')
                             ->where('exhim_id',$pdetail->exhim_id)
                            ->update(
                                  array(  
                                      'section_head' => request('section_head')
                                )
                          );
                          
                              $updateuser = DB::table('1_exhibitor_thumbnail_data')
                           
                                ->insert(
                                      array(  
                                          
                                          'exhim_id'=>$pdetail->exhim_id,
                                          'etd_caption'=>request('thumbnail_Caption'),
                                          'etd_link'=>request('external_url'),
                                           'etd_image'=>$image_name
                                    )
                              );
                    
                }
        
        return redirect($this->getBaseUrl.'/profile');
        
        }
        
        public function saveThumbnailSocialdata (Request $request){
            
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
            //dd($request->all());
                    
                //if(!null==request('thumbnail') && request('thumbnailimg')=='thumbnailimg'){    
                    // $data = request('thumbnail');
                    
                    // list($type, $data) = explode(';', $data);
                    // list(, $data)      = explode(',', $data);
                    
                    // $upload_image=request('upload_dthumbnail');
                    // $ext = $upload_image->getClientOriginalExtension();
                    
                    // $data = base64_decode($data);
                    
                    // $image_name= 'thumbnail-'.date('Y-m-d').time().$ext;
                    // $imagePath='/assets/images/'.Session('session')[0]->bm_id.'/'.$pdetail->exhim_id.'/thumbnail/';
                    // File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    // $path = public_path() . $imagePath . $image_name;
                    
                    // file_put_contents($path, $data);
                    
              
              
                        $update = DB::table('1_exhibitor_master')
                             ->where('exhim_id',$pdetail->exhim_id)
                            ->update(
                                  array(  
                                      'section_head' => request('section_head')
                                )
                          );
                          
                              $updateuser = DB::table('1_exhibitor_thumbnail_social_data')
                           
                                ->insert(
                                      array(  
                                          
                                          'exhim_id'=>$pdetail->exhim_id,
                                          'etd_caption'=>request('thumbnail_Caption'),
                                          'etd_link'=>request('external_url'),
                                           'etd_image'=>request('linktype')
                                    )
                              );
                    
                //}
        
        return redirect($this->getBaseUrl.'/profile');
        
        }
        
        
        public function removethumbnail(){
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
              if(!empty(request('etdid'))){
                      
                          $updateuser = DB::table('1_exhibitor_thumbnail_data')
                            ->where('etd_id',request('etdid'))
                             ->where('exhim_id',$pdetail->exhim_id)
                            ->update(
                                  array(  
                                      'etd_status' => 'N'
                                )
                          );
            
        
              }
        }
        
        public function removeSocialthumbnail(){
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
              if(!empty(request('etdid'))){
                      
                          $updateuser = DB::table('1_exhibitor_thumbnail_social_data')
                            ->where('etd_id',request('etdid'))
                             ->where('exhim_id',$pdetail->exhim_id)
                            ->update(
                                  array(  
                                      'etd_status' => 'N'
                                )
                          );
            
        
              }
        }
        
        
        
        		public function change_password(){
		        $tdetail=Session('tdetail');
		        $sessDetails=Session('profileDetail');
		        $current_password = request('current_password');
		        $new_password = request('new_password');
		        $new_password_confirmation = request('new_password_confirmation');
		        $check =  DB::table($tdetail['exhibitor_boothstaff'])
		        ->where('ebm_login_pwd', $current_password)
		        ->where('ebsm_id', $sessDetails->ebsm_id)
		        ->first();
		      	if (!empty($check)){
		        $update =  	DB::table($tdetail['exhibitor_boothstaff'])
	                    	->where('ebsm_id', $sessDetails->ebsm_id)
	                    	->update([
	                    	'ebm_login_pwd'=>$new_password           
	                  	]);
		                  
		        return 'true';
		 
		        }else{
		          return 'false';
		        }
		      
		    }
		    
		           public function getCity(){  
                $id = request('cityId');
                $tdetail=Session('tdetail');
                $city = DB::table($tdetail['master_city'])
                    ->where("sm_id",$id)
                    ->pluck("cm_name","cm_id")->all(); 
                return response()->json($city);   
                 }
 public function showEnquiry() {
      
      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');
    //dd(request('leem_mobile'));
      $leem_mobile = request('leem_mobile');
      $leem_email = request('leem_email');
      
 
                     $showEnquirys = DB::table('1_inquiry_data as ind')
                        ->leftJoin(\DB::raw("(
                            SELECT 
                            distinct epm.`epm_id`,
                            expm.`epm_text`,
                            em.exhim_organization_name
                            FROM 
                                 `1_exhibitor_product_mapping` as epm 
                            join `1_exhibitor_product_master` as expm ON expm.`exhipm_id`=epm.`exhipm_id` 
                            left join `1_exhibitor_master` as em on em.exhim_id=epm.exhim_id
                            WHERE epm.epm_status='active'
                            ) as ep"),
                                  function ($join) {
                                      $join->on('ep.epm_id', '=', 'ind.epm_id');
                        })
                        
                        ->where(function($query) use ($leem_email, $leem_mobile) {
                                    $query->orwhere('ind.ind_email',$leem_email)
                                          ->orwhere('ind.ind_mobile',$leem_mobile);
                            })
                        ->where('ind.exhim_id', $profileDetail->exhim_id)
                        //->where('ind.ind_type', 'enquiry')
                        ->get();
      //dump($showEnquirys);
      return view('exhibitors.showEnquiry',['showEnquirys'=>$showEnquirys, 'prefix_url' => $this->getBaseUrl ]);
  }
  
  
  public function showQuotation() {
      
      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');
    //dd(request('leem_mobile'));
      $leem_mobile = request('leem_mobile');
      $leem_email = request('leem_email');
      
 
                     $showEnquirys = DB::table('1_inquiry_data as ind')
                        ->leftJoin(\DB::raw("(
                            SELECT 
                            distinct epm.`epm_id`,
                            expm.`epm_text`,
                            em.exhim_organization_name
                            FROM 
                                 `1_exhibitor_product_mapping` as epm 
                            join `1_exhibitor_product_master` as expm ON expm.`exhipm_id`=epm.`exhipm_id` 
                            left join `1_exhibitor_master` as em on em.exhim_id=epm.exhim_id
                            WHERE epm.epm_status='active'
                            ) as ep"),
                                  function ($join) {
                                      $join->on('ep.epm_id', '=', 'ind.epm_id');
                        })
                        
                        ->where(function($query) use ($leem_email, $leem_mobile) {
                                    $query->orwhere('ind.ind_email',$leem_email)
                                          ->orwhere('ind.ind_mobile',$leem_mobile);
                            })
                        ->where('ind.exhim_id', $profileDetail->exhim_id)
                        ->where('ind.ind_type', 'quotation')
                        ->get();
      //dump($showEnquirys);
      return view('datatables.showQuotation',['showEnquirys'=>$showEnquirys, 'prefix_url' => $this->getBaseUrl ]);
  }
  
  
 public function sendsms(){
    
        $eventDetails=Session('selectedEvent');
        $profileDetail=Session('profileDetail');
        $SMS_TEMPLATE_BASED='SMS_TEMPLATE_BASED';
        $SMS_PROMOTIONAL_BASED='SMS_PROMOTIONAL_BASED';
        $SMS_API_URL=HelperController::SMS_API_URL($SMS_TEMPLATE_BASED);
        ### Create four digit random OTP ###
 
         $F1=urlencode(ucwords(request('Name')));
        
        // $F3=urlencode($eventDetails->aem_date);
        
        $F2=urlencode(substr($profileDetail->exhim_organization_name, 0, 30));
        $F3=urlencode(substr($profileDetail->exhim_organization_name, 31, 60));
        $F4=urlencode(substr($profileDetail->exhim_organization_name, 61, 90));
        $F5=urlencode(ucwords($eventDetails->aem_event_nickname));
        $F6=urlencode("https://virtualadmissionsfair");
        $F7=urlencode(".com/".$eventDetails->aem_event_nickname);
        $F8=urlencode(".php?reg=".request('lemmid')."&univsty=".base64_encode($profileDetail->exhim_id));
        $phone=request('mobile');
       // $phone="8602088466";
        
        $templateId['tempid']="78519";
        
        ## PROMOTIONAL SMS ##
        // $SMSRES=HelperController::smsApiGlobe($SMS_API_URL,$phone,$message);
        
        ## TRANSACTIONAL SMS ##
        $SMSRES=HelperController::callSmsApi($SMS_API_URL,$phone,$templateId,$F1,$F2,$F3,$F4,$F5,$F6,$F7,$F8);
        return $SMSRES;
}



public function sendMail(){
    
    $eventDetails=Session('selectedEvent');
    $profileDetail=Session('profileDetail');
    $content['aem_event_nickname']=$eventDetails->aem_event_nickname;
    $content['lm_fullname']=request('Name');
    $content['aem_date']=$eventDetails->aem_date;
    $content['lemmid']=request('lemmid');
     $content['exhim_organization_name']=$profileDetail->exhim_organization_name;

 $content['exhim_id']=$profileDetail->exhim_id;
    $email_to=request('email');

    //$email_to="anup.pandey@brandappz.com";
            Mail::send('mailer', ['list' => $content], function ($m) use ($email_to) {
             $m->from('harpreet@ibentos.com', 'DMTS 2022');
             $m->to($email_to)->subject('DMTS 2022');
            });
}

  
  
  
  ### NoPaperForms Data Sync ###
  
  public function SynctoNoPaperForms(){
      $pdetail=Session('profileDetail');
         $tdetail=Session('tdetail');
         
     $profileDetail = DB::table('1_exhibitor_master'.' as em')
            ->leftJoin('master_city as mc', 'mc.cm_id', 'em.cm_id')
            ->leftJoin('master_state as ms', 'ms.sm_id', 'em.sm_id')
            ->select('em.*','ms.sm_name','mc.cm_name')
            ->where('em.exhim_id', '=', $pdetail->exhim_id)
            ->first();
            
   
       $API_URL="https://api.nopaperforms.com/dataPorting/".$profileDetail->exhim_np_college_id."/afairs";
      
            $leemId=request('leem_id');
            
            $getleadsdetails=DB::table($tdetail['lead_master'].' as lm')
                                ->join($tdetail['lead_event_master_mapping'].' as lemm' ,'lm.lm_id','lemm.lm_id')
                                ->leftJoin(\DB::raw("(

          SELECT 
            lemm.`lemm_id`, 
            GROUP_CONCAT(ppm.`ppm_text` SEPARATOR ' ' ) as 'course'

            FROM 
                `".$tdetail['lead_event_master_mapping']."` as lemm
            join `".$tdetail['parent_product_master']."` as ppm ON  FIND_IN_SET(ppm.`ppm_id`, lemm.`ppm_id`)
            WHERE 1
            group by lemm.lemm_id) as pm"),
                function ($join) {
                    $join->on('pm.lemm_id', '=', 'lemm.lemm_id');
        })
                                ->join($tdetail['lead_event_exhibitor_mapping'].' as leem' ,'lemm.lemm_id','leem.lemm_id')
                                ->leftJoin($tdetail['master_city'].' as mc'  ,'lm.city_id','mc.cm_id')
                                ->leftJoin($tdetail['master_state'].' as ms'  ,'mc.sm_id','ms.sm_id')
                                ->select('lm.*','ms.sm_name',DB::raw("case when mc.cm_name is null then lm.city_id else mc.cm_name end as city,pm.course"))
                                ->where('leem.leem_id',$leemId)
                                ->groupby('leem.leem_id')
                                ->first();

            $syncDataArray=array();
            ### Set Required FIELDS ###
            $syncDataArray ['college_id']=$profileDetail->exhim_np_college_id;
            $syncDataArray['name'] =$getleadsdetails->lm_fullname;
            $syncDataArray['email'] =$getleadsdetails->lm_email;
            $syncDataArray['country_dial_code'] = "+91";
            $syncDataArray['mobile']  = $getleadsdetails->lm_mobile;
            $syncDataArray['source'] = "afairs";
            $syncDataArray['state']  =$getleadsdetails->sm_name;
            $syncDataArray['City']  =$getleadsdetails->city;
            $syncDataArray['course']  =$getleadsdetails->course;
            $syncDataArray['secret_key']  =$profileDetail->exhim_np_secret_key;

//echo json_encode($syncDataArray); die;
            ### Send Data Array Through Curl #####

                    $curl = curl_init();
                    
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => $API_URL,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => "",
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => "POST",
                      CURLOPT_POSTFIELDS => json_encode($syncDataArray),
                      CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json"
                      ),
                    ));
                    
                    $response = curl_exec($curl);
                    
                    curl_close($curl);
                    $res= json_decode($response,true);
                    
                   if($res['status']!='Fail'){
                       
                        $update =  	DB::table($tdetail['lead_event_exhibitor_mapping'])
	                    	->where('leem_id', $leemId)
	                    	->update([
	                    	'leem_nopaper_sync'=>'Y'           
	                  	]);
                    }
                    
                    return $response;
      
  }
  
  
  public function change()
  {
      $pdetail=Session('profileDetail');
      $tdetail=Session('tdetail');
      $eewbm_id = (request('eewbm_id'));

    $check = DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
                    ->where('eewbm_id',request('eewbm_id'))
                    ->pluck('eewbm_priority_in_list');
                    //dd($check);
              if ($check[0] == 'N') {

                $updateuser = DB::table($tdetail['exhibitor_event_with_boothstaff_mapping']) 
                    ->update(
                          array(                       
                                'eewbm_priority_in_list'=>'N'         
                        )
                  );

                 $updateuser = DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
                    ->where('eewbm_id',request('eewbm_id'))
                    ->update(
                          array(                       
                                'eewbm_priority_in_list'=>'Y'               
                                
                        )
                  );
                
              }else{
                $updateuser = DB::table($tdetail['exhibitor_event_with_boothstaff_mapping'])
                    ->where('eewbm_id',request('eewbm_id'))
                    ->update(
                          array(                       
                                'eewbm_priority_in_list'=>'N',
                                
                                
                        )
                  );

              }

     
    return 'true';
  }

  public function bsmRepresentative(){
    $tdetail=Session('tdetail');
   $pdetail=Session('profileDetail');
   $eventDetails=Session('selectedEvent');
   $selectedEvent=Session('selectedEvent');
   $counm_code=DB::table($tdetail['master_country'])->where('counm_id',$pdetail->counm_id)->first();
   $leadList = DB::table($tdetail['exhibitor_boothstaff'])->select('*')->where('at_id',8)->where('exhim_id',$pdetail->exhim_id)->limit(1)->orderby('ebsm_id','DESC')->get();
   return view('datatables.bsm-representative',['leadList'=>$leadList,'counm_code'=>$counm_code]);
   
}

public function adduserbsm(){
  $tdetail=Session('tdetail');
  $pdetail=Session('profileDetail');
  $eventDetails=Session('selectedEvent');
  $selectedEvent=Session('selectedEvent');

  //  $updateuser = DB::table($tdetail['exhibitor_boothstaff'])
  //                 ->where('ebsm_id',request('ebsmId'))
  //                 ->update(
  //                       array(                       
  //                             'exhim_id'=>$pdetail->exhim_id,
  //                             'ebsm_name'=>request('edit_usser_name'),
  //                             'ebsm_mobile'=>request('edit_user_phone'),
  //                             'ebm_login_user'=>request('edit_user_email'),
  //                             'ebm_login_pwd'=>request('edit_user_password'),
  //                              'ebsm_country_code'=>request('c_code'),
  //                             'ebsm_designation'=>request('ex_designation')
  //                     )
  //               );
   
              
                 $ebsmId= DB::table($tdetail['exhibitor_boothstaff'])
                              ->insertGetId(
                                  array( 
                                      'exhim_id'=>$pdetail->exhim_id,
                                      'ebsm_name'=>request('name'),
                                      'ebsm_mobile'=>request('phone'),
                                      'ebm_login_user'=>request('email'),
                                      'ebm_login_pwd'=>request('password'),
                                      'ebsm_designation'=>request('designation'),
                                      'at_id'=>'8'
                                  )
                              );
    return "sucess";                          
                              
}

public function edituserbsm(){
  $tdetail=Session('tdetail');
$pdetail=Session('profileDetail');
$eventDetails=Session('selectedEvent');
$selectedEvent=Session('selectedEvent');

$updateuser = DB::table($tdetail['exhibitor_boothstaff'])
             ->where('ebsm_id',request('ebsmId'))
             ->update(
                   array(                       
                         'exhim_id'=>$pdetail->exhim_id,
                         'ebsm_name'=>request('name'),
                         'ebsm_mobile'=>request('phone'),
                         'ebm_login_user'=>request('email'),
                         'ebm_login_pwd'=>request('password'),
                         'ebsm_designation'=>request('designation'),
                         'at_id'=>request('at_id')
                 )
           );
}

public function saveinteractivedata (){
           
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
            $imageNameF = '';
            $imageNameB = '';
            
            $company_name = $pdetail->exhim_organization_name;
            
            if(request('card_mode')=='Landscape') {
            
                if(!null==request('imteractive_image1')){
                    $upload_image=request('imteractive_image1');
                    
                    $data = request('logoimage');
        
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
            
                    $data = base64_decode($data);
                    
                    $imageNameF= date('YmdHis') . "f." . $upload_image->getClientOriginalExtension();
                    $imagePath='/assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive/';
                    $path = public_path() . $imagePath . $imageNameF;
            
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    file_put_contents($path, $data);
                    
                    $image_url1 = $imagePath.$imageNameF;
                    $arrayToUpdateSave['interactive_image']=$image_url1;
                }
                
                
                if(!null==request('imteractive_image_back')){
                    $upload_image=request('imteractive_image_back');
                    
                    $data = request('logoimage2');
        
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
            
                    $data = base64_decode($data);
                    
                    $imageNameB= date('YmdHis') . "b." . $upload_image->getClientOriginalExtension();
                    $imagePath='/assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive_back/';
                    $path = public_path() . $imagePath . $imageNameB;
            
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    file_put_contents($path, $data);
                    
                    $image_url1 = $imagePath.$imageNameB;
                    $arrayToUpdateSave['interactive_image_back']=$image_url1;
                }
            }
            else{
                if(!null==request('imteractive_imageP')){
                    $upload_image=request('imteractive_imageP');
                    
                    $data = request('logoimageP');
        
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
            
                    $data = base64_decode($data);
                    
                    $imageNameF= date('YmdHis') . "f." . $upload_image->getClientOriginalExtension();
                    $imagePath='/assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive/';
                    $path = public_path() . $imagePath . $imageNameF;
            
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    file_put_contents($path, $data);
                    
                    $image_url1 = $imagePath.$imageNameF;
                    $arrayToUpdateSave['interactive_image']=$image_url1;
                }
                
                
                if(!null==request('imteractive_image_backP')){
                    $upload_image=request('imteractive_image_backP');
                    
                    $data = request('logoimagebackP');
        
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
            
                    $data = base64_decode($data);
                    
                    $imageNameB= date('YmdHis') . "b." . $upload_image->getClientOriginalExtension();
                    $imagePath='/assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive_back/';
                    $path = public_path() . $imagePath . $imageNameB;
            
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    file_put_contents($path, $data);
                    
                    $image_url1 = $imagePath.$imageNameB;
                    $arrayToUpdateSave['interactive_image_back']=$image_url1;
                }
                
            }
            
            //start zip business card front & back images
            $zipfilename = $company_name.' '.request('name');
            
            // $zip = new \ZipArchive;
            $fileName= str_replace(' ', '_',$zipfilename).'_'.date('YmdHis').".".'zip';
            $imagePathZip='/assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive_zip/';
            // File::makeDirectory(public_path() . $imagePathZip, 0777, true, true);
            // if ($zip->open(public_path($imagePathZip.$fileName), \ZipArchive::CREATE) === TRUE)
            // {
            //     $imagePath ='/assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive_back/'.$imageNameB;
            //     $zip->addFile(public_path($imagePath), $imageNameB);
                
            //     $imagePath ='/assets/images/'.$pdetail->exhim_id.'/'.$pdetail->ebsm_id.'/inetractive/'.$imageNameF;
            //     $zip->addFile(public_path($imagePath), $imageNameF);
                 
            //     $zip->close();
            // }
            
            $zip_url=$imagePathZip.$fileName;
            //$arrayToUpdateSave['interactive_image_zip']=$zip_url;
            $arrayToUpdateSave['interactive_image_zip']='';
            
            //end zip business card front & back images
            
            $arrayToUpdateSave['imm_name'] = request('name');
            $arrayToUpdateSave['imm_designation'] = request('designation');
            $arrayToUpdateSave['imm_department'] = request('department');
            $arrayToUpdateSave['card_mode'] = request('card_mode');
            
            $arrayToUpdateSave['exhim_id']=$pdetail->exhim_id;
            $updateuser = DB::table('1_interactive_map_master')
                            ->insert(
                                  $arrayToUpdateSave
                            );
         
       
        //   $data= DB::table('1_interactive_map_master')->where('exhim_id',$pdetail->exhim_id);
        //                 if($data->count()==0){
        //                      $arrayToUpdateSave['exhim_id']=$pdetail->exhim_id;
        //                       $updateuser = DB::table('1_interactive_map_master')
                           
        //                         ->insert(
        //                               $arrayToUpdateSave
        //                       );
        //                 }else{
        //                     $updateuser = DB::table('1_interactive_map_master')->where('exhim_id',$pdetail->exhim_id)
                           
        //                         ->update(
        //                               $arrayToUpdateSave
        //                       );
        //                 }
                    
                
        
        return redirect($this->getBaseUrl.'/profile');
        
        }
        
        
        public function ViewVisitingCard(Request $request){
      
            $data=null;
            if(Input::has('ajaxRequset')){
              $data=Input::all();
            }
           
     

            $stateId=null;
            $countryId=null;

            $tdetail=Session('tdetail');
            $sessDetail=Session('profileDetail');
            
            //dd($sessDetail);
            $eventDetails=Session('selectedEvent');

            $profileDetail = DB::table('1_exhibitor_master'.' as em')
            ->leftJoin('1_exhibitor_event_mapping as eem', 'eem.exhim_id', 'em.exhim_id')
            ->leftJoin('master_city as mc', 'mc.cm_id', 'em.cm_id')
            ->leftJoin('master_state as ms', 'ms.sm_id', 'em.sm_id')
            ->leftJoin('master_country as mcon', 'em.counm_id', 'mcon.counm_id')
            ->select('ms.sm_name','mc.cm_name','mcon.counm_name','em.*','eem.*')
            ->where('em.exhim_id', '=', $sessDetail->exhim_id)
            ->where('eem.aem_id', '=', $eventDetails->aem_id)
            ->first();

            
             $interactivedata=DB::table('1_interactive_map_master')->where('exhim_id',$profileDetail->exhim_id)->get();
             
             $counselorDetail = DB::table($tdetail['exhibitor_boothstaff'].' as ebs')
                    ->join($tdetail['exhibitor_event_with_boothstaff_mapping'].' as eewbm', 'eewbm.ebsm_id','ebs.ebsm_id')
                    ->where('ebs.ebsm_id',$sessDetail->ebsm_id)
                    ->where('ebs.exhim_id',$sessDetail->exhim_id)
                    ->first();

     
            $tergetBlade='others.visiting-card';
            if(!empty(request('ajaxRequset'))) {
              $tergetBlade='others.basicdetail-form';
            }
            

            return view($tergetBlade, [
                'bmid'=>Session('session')[0]->bm_id,
            'profileDetail' => $profileDetail,
              'interactivedata'=>$interactivedata,
              'userData' => $profileDetail,
              'counselorDetail' => $counselorDetail
            ]);
    }
    
    public function scrollerdata (){
            
            $tdetail=Session('tdetail');
            $pdetail=Session('profileDetail');
            $eventDetails=Session('selectedEvent');
            $selectedEvent=Session('selectedEvent');
            
                        $update = DB::table('1_exhibitor_master')
                             ->where('exhim_id',$pdetail->exhim_id)
                            ->update(
                                  array(  
                                      'exhim_scroller_text' => request('scroller')
                                )
                          );
        
        return redirect($this->getBaseUrl.'/profile');
        
        }
        
        
    public function ActivityReport(){

      $tdetail=Session('tdetail');
      $pdetail=Session('profileDetail');
      $eventDetail=Session('evntDetail');
      $selectedEvent=Session('selectedEvent');
     
      $aem_id=1;
     
      $profileDetail = DB::table('1_exhibitor_master as em')
            ->leftJoin('master_city as mc', 'mc.cm_id', 'em.cm_id')
            ->leftJoin('master_state as ms', 'ms.sm_id', 'em.sm_id')
            ->select('em.*','ms.sm_name','mc.cm_name')
            ->where('em.exhim_id', '=', $pdetail->exhim_id)
            ->first();
      
        $qualification = request('qm');
        $course = request('course');
        $city = request('city');
        $state = request('state');
        $datefrom = request('datefrom');
        $dateto = request('dateto');
        $leadstage = request('leadstage');
        $leadtype = request('leadtype');


      if(Session::has('paginate')){
          $paginate = Session::get('paginate');
      } else{
        $paginate = 10;
      }

      if (null !==(request('pagination'))){
          $paginate = request('pagination');
          Session::put('paginate', $paginate);
      }
      $searchText="";
      if (null !==(request('search_text'))){
          $searchText = request('search_text');
          //Session::put('search_text', $search_text);
      }

      $leadList=DB::table('1_lead_master as lm')
      ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
      ->join('1_lead_event_exhibitor_mapping as leem', 'leem.lemm_id','lemm.lemm_id')
      ->leftjoin('1_organization_type_master as otm', 'otm.otm_id','lemm.otm_id')
      ->leftjoin('1_organization_type as ot', 'ot.ot_id','lemm.ot_id')
      ->leftJoin(\DB::raw("(

          SELECT 
          leema.`leem_id`,
          GROUP_CONCAT(CONCAT('<li>',am.`am_text`,'</a>') SEPARATOR ' ' ) as 'activity'
          FROM 
                    `1_lead_event_exhibitor_mapping_activity` as leema
               join `1_lead_event_exhibitor_mapping` as leem on leem.`leem_id`=leema.`leem_id`
          left join `1_activity_master`  as am ON am.`am_id`=leema.`am_id`
          WHERE leem.`exhim_id`='".$pdetail->exhim_id."'
          group by leema.`leem_id` ) as leema"),
                function ($join) {
                    $join->on('leema.leem_id', '=', 'leem.leem_id');
        })
        ->leftJoin(\DB::raw("(

          SELECT 
            lemm.`lemm_id`, 
            GROUP_CONCAT(CONCAT('<li>',ppm.`ppm_text`,'</a>') SEPARATOR ' ' ) as 'pm_text'

            FROM 
                `1_lead_event_master_mapping` as lemm
            join `1_parent_product_master` as ppm ON  FIND_IN_SET(ppm.`ppm_id`, lemm.`ppm_id`)
            WHERE 1
            group by lemm.lemm_id) as pm"),
                function ($join) {
                    $join->on('pm.lemm_id', '=', 'lemm.lemm_id');
        })


      ->leftJoin('master_city as mc'  ,'lm.city_id','mc.cm_id')
      ->leftJoin('master_country as counm'  ,'counm.counm_id','lm.country_id')
      ->leftJoin('1_qualification_master as qm' ,'lemm.qm_id','qm.qm_id')
      ->leftJoin('1_lead_categorization as lc' ,'lc.lc_id','leem.lc_id')
      ->leftJoin('1_exhibitor_boothstaff as ebstf' ,'ebstf.ebsm_id','leem.leem_updateby');
      
       

      $leadList->select('ot.*','otm.*','lm.*',  'lemm.lemm_id as lemmid', 'lemm.*', 'leem.*','leema.activity','mc.*','counm.*','qm.*','pm.*','lc.*','ebstf.ebsm_name as last_interaction_by',DB::raw("case when mc.cm_name is null then lm.city_id else mc.cm_name end as cm_name"));
      ## Set Event Filter ##
      $leadList->where('lemm.aem_id', $aem_id);
       ## Set Exhibitor ##
      $leadList->where('leem.exhim_id',$pdetail->exhim_id);

      if(!empty($leadtype)){
         $leadList->where('lemm.lemm_reg_type',$leadtype);
        }

      if(!empty($searchText)){
            $leadList->where(function($query) use ($searchText) {
                $query->orwhere('lm.lm_email',$searchText)
                    ->orwhere('lm.lm_mobile',$searchText)
                    ->orwhere('mc.cm_name',$searchText)
                    ->orwhere('qm.qm_text','like','%'.$searchText.'%')
                    ->orwhere('pm.pm_text','like','%'.$searchText.'%')
                    ->orwhere('lm.lm_fullname','like','%'.$searchText.'%');
            });
      }
     
         if (!empty($qualification)){
          //dump($qualification);
            $leadList->where('lemm.qm_id', $qualification);

          }if (!empty($course)){
            $leadList->whereRaw("FIND_IN_SET(?, lemm.ppm_id) > 0", [$course]);
          }if (!empty($city)){
           
            $leadList->where('lm.city_id', $city)->groupBy('lm.city_id');
          }if (!empty($leadstage)){
            
            $leadList->where('leem.lc_id', $leadstage);
            
          }
            if (!empty($datefrom) &&  empty($dateto) ){
                            
      $leadList->whereDate('lemm.lemm_insert_date','=',$datefrom);
                            
    }
    else if (!empty($dateto) && !empty($datefrom)){
                            
        $leadList->whereDate('lemm.lemm_insert_date','>=', $datefrom)->whereDate('lemm.lemm_insert_date','<=', $dateto);
                            
     }
                            else if (!empty($dateto) && empty($datefrom)){
                            
                                $leadList->whereDate('lemm.lemm_insert_date','<=', $dateto);
                            
                            }

         //dump(date("Y-m-d"));

        
      $leadList->orderby('leem.leem_datetime','DESC');

      $res=$leadList ->paginate($paginate);
      
      ## Lead Categorization ##
      $leadcat=ComModel::getLeadCategorization();
      $eewbmdetail="";
      
      if($pdetail->at_id=='4'){
                $eewbmdetail=DB::table('1_exhibitor_event_with_boothstaff_mapping as eewbm')
                ->join('1_exhibitor_boothstaff as eb','eewbm.ebsm_id','eb.ebsm_id')

                ->join('1_exhibitor_event_mapping as eem',function($join){
                $join->on('eewbm.eem_id', 'eem.eem_id')
                  ->on('eb.exhim_id','eem.exhim_id');
                })
                ->where('eewbm.ebsm_id',$pdetail->ebsm_id)
                ->where('eb.exhim_id',$pdetail->exhim_id)
                ->where('eem.aem_id',$selectedEvent->aem_id)
                ->get();
                if(isset($eewbmdetail[0])){
                  $eewbmdetail=$eewbmdetail[0];
                }
      }
          $productdata = DB::table('1_parent_product_master')->select('ppm_id','ppm_text')->get();
          $qualificationdata = DB::table('1_qualification_master')->select('qm_id','qm_text')->get();
          $statedata = DB::table('master_state')->select('sm_id','sm_name')->get();
          $leadcategorization = DB::table('1_lead_categorization')->select('lc_id','lc_text')->get();

          $qualifications = DB::table('1_qualification_master')->where('qm_id',$qualification)->select('qm_text','qm_id')->first();
          $courses = DB::table('1_parent_product_master')->where('ppm_id',$course)->select('ppm_text','ppm_id')->first();
          $citys = DB::table('master_city')->where('cm_id',$city)->select('cm_name','cm_id')->first();
          $leadstages = DB::table('1_lead_categorization')->where('lc_id',$leadstage)->select('lc_text','lc_id')->first();
          $states = DB::table('master_state')->where('sm_id',$state)->select('sm_name','sm_id')->first();
     // dd($res);
     
     $filename = 'exhibitors.activity_report';
     if(request('action')=='download') {
         $filename = 'exhibitors.download_activity_report';
     }

      return view($filename,['leadList'=>$res, 'leadcat'=>$leadcat, 'eewbmdetail'=>$eewbmdetail,  'prefix_url' => $this->getBaseUrl,
            'qualificationdata'=>$qualificationdata,
            'leadcategorization'=>$leadcategorization,
            'qualification'=>$qualifications,
            'statedata'=>$statedata,
            'datefrom'=>$datefrom,
            'dateto'=>$dateto,
            'leadstage'=>$leadstages,
            'citys'=>$citys,
            'states'=>$states,
            'productdata'=>$productdata,
            'courses'=>$courses,
            'leadtype'=>$leadtype,
            'profileDetail'=>$profileDetail,
            'userData' => $pdetail,
            'exhim_email'=>$pdetail->exhim_contact_email
          ]);
    }
    
    
    public function Updateconvaiid(Request $request)
    {
       $exhim_id = request('boothId');
       $convai_id = request('convai_id');
       $status = ComModel::UpdateConvaiId($exhim_id,$convai_id);
       return $status;
    }

###########
}
