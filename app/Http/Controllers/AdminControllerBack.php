<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Models\MasterCountry;
use App\Models\CustomerData;
use App\Models\EventMaster;
use App\Models\LeadMaster;
use App\Models\AppFeatureMaster;
use App\Models\FeatureSettingAgainstAnEvent;
use App\Models\AppLandingpageMaster;
use App\Models\SettingMapping;
use App\Models\CmsMaster;
use Session;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{

    
    protected $request;
	
    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::adminBaseUrl($request);
    }

    public function dashboard(){
         return view('dashboard.dashboardv2');
    }
    
   public function lpage(){
       $cms = CmsMaster::get();
       //dd($cms);
        $options = view("lpage.index10")->render();
        // dd($options);
         return view('lpage.lindex',['options'=>$options]);
     
    }
    
    
    public function lpage1(){
        $options = view("lpage.index101")->render();
        // dd($options);
         return view('lpage.index101');//,['options'=>$options]);
     
    }
   public function getlpage(){
       
           if(request('name')=='simple'){
                $options = view("lpage.index10")->render();
           }
           else{
                $options = view('lpage.index9')->render();
           }
            //dd($options);
         echo $options;
    }
    public function Campaign(){
               
        return view('url-builder.campaign-manager');

    }
    
      public function Addspk(Request $request)
      {
        dd($request->all());
      }
    public function manage_events()

      {
            $selectedEvent=Session('A_Session');
            $all_eventList= EventMaster::where('bm_id',$selectedEvent->bm_id)->get();
            $Allcountry = MasterCountry::all();
            //   if(Session::has('paginate')){

            //   $paginate = Session::get('paginate');

            //     } else{

            //       $paginate = 10;

            //     }

            //     if (null !==(request('pagination'))){

            //         $paginate = request('pagination');

            //         Session::put('paginate', $paginate);

            //     }

            //     $searchText="";

            //     if (null !==(request('search_text'))){

            //         $searchText = request('search_text');

            //     }



            //     $all_eventList = DB::table($tdetail['event_master'])->get();

                //$res=$all_eventList->paginate($paginate);

                //dump($all_eventList);

                return view('datatables.eventMaster',['eventList'=>$all_eventList,'Allcountry'=>$Allcountry ]);



      }



      public function Addevent(Request $request)

      {  
        
            // $request->validate([
            //       'aem_name' => 'required',
            //     ]);
        $selectedEvent=Session('A_Session');
       
        if(!empty(request('aem_id'))){

        $datas  = array();

            $datas['bm_id']= $selectedEvent->bm_id;
            
            $datas['aem_name']= request('ex_name');

            $datas['aem_event_nickname']= request('ex_nickname');

            $datas['aem_full_address']= request('ex_address');  



            $datas['aem_location']= request('ex_location');

            $datas['aem_start_date']= request('ex_startdates');

            $datas['aem_end_date']= request('e_enddate');



            $datas['aem_day']= request('ex_day');

            $datas['aem_time']= request('ex_time');
            
            $datas['aem_timezones']= request('ex_timezones');
            
            $datas['aem_mail_subject']= request('ex_subject');



            $datas['aem_sms_text']= request('ex_sms');

            $datas['aem_mail_html']= request('ex_eventmail');



            $datas['aem_date']= request('ex_date');

            $datas['aem_event_date']= request('ex_eventdate');

            $datas['aem_status']= request('status');

           

            $h_image=request('he_image');

            $image=request('ex_file');



            if (!empty($image)) {

            $destinationPath = 'assets/images/eventImg/'; // upload path

            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

            $image_url = $destinationPath.$profileImage;

            $success = $image->move($destinationPath, $profileImage);

            $datas['aem_logo_image']=$image_url;

            }   

                    

            if (!empty($h_image)) {

            $destination_Path = 'assets/images/eventImg/'; // upload path

            $profile_Image = date('YmdHis') . "." . $h_image->getClientOriginalExtension();

            $h_image_url = $destination_Path.$profile_Image;

            $h_success = $h_image->move($destination_Path, $profile_Image);

            $datas['aem_header_img']=$h_image_url;

            } 



            $insert = EventMaster::where('aem_id',request('aem_id'))->update($datas);



          }else {

          

          $datas  = array();

            $datas['bm_id']= $selectedEvent->bm_id;
            
            $datas['aem_name']= request('name');
            
            $datas['aem_event_nickname']= request('nickname');

            $datas['aem_full_address']= request('address');  



            $datas['aem_location']= request('location');

            $datas['aem_start_date']= request('picker3');

            $datas['aem_end_date']= request('enddate');



            $datas['aem_day']= request('day');

            $datas['aem_time']= request('time');
            
            $datas['aem_timezones']= request('timezones');

            $datas['aem_mail_subject']= request('subject');



            $datas['aem_sms_text']= request('sms');

            $datas['aem_mail_html']= request('mail');



            $datas['aem_date']= request('between');

            $datas['aem_event_date']= request('eventdate');

           



            $image=request('file');

            $h_image=request('header_img');

            if (!empty($image)) {



                $destinationPath = 'assets/images/eventImg/'; // upload path

                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();

                $image_url = $destinationPath.$profileImage;

                $success = $image->move($destinationPath, $profileImage);

                $datas['aem_logo_image']=$image_url;

              

            }

           

            if (!empty($h_image)) {

              $destination_Path = 'assets/images/eventImg/'; // upload path

              $profile_Image = date('YmdHis') . "." . $h_image->getClientOriginalExtension();

              $h_image_url = $destination_Path.$profile_Image;

              $h_success = $h_image->move($destination_Path, $profile_Image);

              $datas['aem_header_img']=$h_image_url;

             

            }

            

          $insert = EventMaster::insert($datas);
          

          }
            
          if ($insert == true){                 
            return 'true';
            // $arr = array('msg' => 'Event Added Successfully ', 'status' => true);
            // return response()->json($arr);
          }else{

        //   $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' =>false);
        //         return response()->json($arr);
        return 'false';
        }

      }

    public function editevent(){
       
            if(!empty(request('aem_id'))){
    
                $aem_id=request('aem_id');
                $eventlist =  EventMaster::findorfail($aem_id);
                $status =  EventMaster::where('aem_id',$aem_id)->select('aem_status','aem_id')->get();
                 $Allcountry = MasterCountry::all();
                return view('datatables.editevent',['eventlist'=>$eventlist,'status'=>$status,'Allcountry'=>$Allcountry ]);
    
            }
        }
     public function GetDataList(){
        
        $selectedEvent=Session('A_Session');
    
        $qualification = request('qm');

        $course = request('course');

        $city = request('city');

        $state = request('state');

        $datefrom = request('datefrom');

        $dateto = request('dateto');

        $leadstage = request('leadstage');

        $leadtype = request('leadtype');

        $leadsrc=request('leadsource');

        $univrsty=request('univrsty');

        $adid=request('adid');

        $serch_by_company=request('serch_by_company');

        

        if(Session::has('paginate')){

            $paginate = Session::get('paginate');

        } else{

            $paginate = 1;

        }

        if (null !==(request('pagination'))){

            $paginate = request('pagination');

            Session::put('paginate', $paginate);

        }

        $searchText="";

        if (null !==(request('search_text'))){

            $searchText = request('search_text');

            Session::put('search_text', $searchText);

        }

   $res=LeadMaster::where(function($query) use ($searchText) {

                  $query->where('lm_fullname','like','%'.$searchText.'%')
                  ->orwhere('lm_email','like','%'.$searchText.'%');
                  })->paginate($paginate);

//         $leadList=DB::table($tdetail['lead_master'].' as lm')

//         ->join($tdetail['lead_event_master_mapping'].' as lemm', 'lemm.lm_id','lm.lm_id')

//          ->join($tdetail['event_master'].' as evm', 'lemm.aem_id','evm.aem_id')
//          ->join('1_registration_type_master as rtm','lemm.rtem_id','rtm.rtm_id')

//         ->leftjoin($tdetail['lead_event_exhibitor_mapping'].' as leem', 'leem.lemm_id','lemm.lemm_id')

//         ->leftjoin($tdetail['exhibitor_master'].' as em', 'em.exhim_id','leem.exhim_id')

//         ->leftjoin('1_organization_type_master as otm', 'otm.otm_id','lemm.otm_id')

//         ->leftjoin('1_organization_type as ot', 'ot.ot_id','lemm.ot_id')

//         ->leftJoin(\DB::raw("(

  

//             SELECT 

//             `leem_id`,alloted_by,

//             GROUP_CONCAT(CONCAT('<li>',am.`am_text`,'</a>') SEPARATOR ' ' ) as 'activity'

//             FROM

//                      `".$tdetail['lead_event_exhibitor_mapping_activity']."` as leema

//             left join `".$tdetail['activity_master']."`  as am ON am.`am_id`=leema.`am_id`

//             WHERE 1

//             group by leema.`leem_id` ) as leema"),

//                   function ($join) {

//                       $join->on('leema.leem_id', '=', 'leem.leem_id');

//           })

//           ->leftJoin(\DB::raw("(

  

//             SELECT 

//               lemm.`lemm_id`, 

//               GROUP_CONCAT(CONCAT('<li>',ppm.`ppm_text`,'</a>') SEPARATOR ' ' ) as 'pm_text'

  

//               FROM 

//                   `".$tdetail['lead_event_master_mapping']."` as lemm

//               join `".$tdetail['parent_product_master']."` as ppm ON  FIND_IN_SET(ppm.`ppm_id`, lemm.`ppm_id`)

//               WHERE 1

//               group by lemm.lemm_id) as pm"),

//                   function ($join) {

//                       $join->on('pm.lemm_id', '=', 'lemm.lemm_id');

//           })

  

//         ->leftJoin($tdetail['master_city'].' as mc'  ,'lm.city_id','mc.cm_id')
//         ->leftJoin('master_state as ms'  ,'lm.state_id','ms.sm_id')

//         ->leftJoin('master_country as counm'  ,'counm.counm_id','lm.country_id')

//         ->leftJoin($tdetail['qualification_master'].' as qm' ,'lemm.qm_id','qm.qm_id')

//         ->leftJoin($tdetail['lead_categorization'].' as lc' ,'lc.lc_id','leem.lc_id')

//         ->leftJoin($tdetail['exhibitor_boothstaff'].' as ebstf' ,'ebstf.ebsm_id','leem.leem_updateby')

//         ->leftJoin($tdetail['master_lead_source'].' as mls' ,'mls.ls_id','lemm.ls_id');

  

//         $leadList->select('ot.*','ms.*','otm.*','rtm.*','em.exhim_organization_name', 'leem.*','leema.activity','leema.alloted_by','mc.*','counm.*','qm.*','pm.*','lc.*','ebstf.ebsm_name as last_interaction_by','lm.*', 'lemm.*','evm.aem_name','mls.ls_text',DB::raw("case when mc.cm_name is null then lm.city_id else mc.cm_name end as cm_name,case when mls.ls_text is null then lemm.ls_id else  mls.ls_text end as ls_text"));

//         if(!empty($selectedEvent) && $AllEvent==false){

//          $leadList->where('lemm.aem_id', $selectedEvent->aem_id);

//         }

//         if(!empty($leadsrc)){

//          $leadList->where('mls.ls_id', $leadsrc);

//         }

//         if(!empty($univrsty)){

//          $leadList->where('leem.exhim_id', $univrsty);

//         }





//       if(!empty($leadtype)){

//          $leadList->where('lemm.lemm_reg_type',$leadtype);

//         }

//          if(!empty($adid)){

//          $leadList->where('lemm.lemm_adid',$adid);

//         }

       

//         if(!empty($searchText)){

//               $leadList->where(function($query) use ($searchText) {

//                   $query->orwhere('lm.lm_email',$searchText)

//                       ->orwhere('lm.lm_mobile',$searchText)

//                       ->orwhere('mc.cm_name',$searchText)

//                       ->orwhere('em.exhim_organization_name','like','%'.$searchText.'%')

//                       ->orwhere('qm.qm_text','like','%'.$searchText.'%')

//                       ->orwhere('pm.pm_text','like','%'.$searchText.'%')

//                       ->orwhere('mls.ls_text','like','%'.$searchText.'%')

//                       ->orwhere('lemm.lemm_adid','like','%'.$searchText.'%')

//                       ->orwhere('lm.lm_fullname','like','%'.$searchText.'%');

//               });

//         }


//           if (!empty(request('serch_by_company'))){

//             $leadList->where('lm.lm_company_name', request('serch_by_company'));

//           }

//           if (!empty($qualification)){

//             $leadList->where('lemm.qm_id', $qualification);

//           }

//           if (!empty($course)){

//             $leadList->whereRaw("FIND_IN_SET(?, lemm.ppm_id) > 0", [$course]);

//           }

//           if (!empty($city)){

//             $leadList->where('lm.city_id', $city)->groupBy('lm.city_id');

//           }

//           if (!empty($leadstage)){

//             $leadList->where('leem.lc_id', $leadstage);

//           }





//           if (!empty($datefrom) &&  empty($dateto) ){              

//               $leadList->whereDate('lemm.lemm_insert_date','=',$datefrom);                 

//           }

//           else if (!empty($dateto) && !empty($datefrom)){                 

//               $leadList->whereDate('lemm.lemm_insert_date','>=', $datefrom)->whereDate('lemm.lemm_insert_date','<=', $dateto);                  

//           }

//                             else if (!empty($dateto) && empty($datefrom)){

                            

//                                 $leadList->whereDate('lemm.lemm_insert_date','<=', $dateto);

                            

//                             }

          

          

          

          

      

//         $leadList->orderby('lm.lm_id','DESC');

//         $res=$leadList  ->paginate($paginate);

//   //dd($res);

//         $leadcat=ComModel::getLeadCategorization();

        

//           $productdata = DB::table($tdetail['parent_product_master'])->select('ppm_id','ppm_text')->get();

//           $qualificationdata = DB::table($tdetail['qualification_master'])->select('qm_id','qm_text')->get();

//           $statedata = DB::table($tdetail['master_state'])->select('sm_id','sm_name')->get();

//           $leadcategorization = DB::table($tdetail['lead_categorization'])->select('lc_id','lc_text')->get();



//           $qualifications = DB::table($tdetail['qualification_master'])->where('qm_id',$qualification)->select('qm_text','qm_id')->first();

//           $courses = DB::table($tdetail['parent_product_master'])->where('ppm_id',$course)->select('ppm_text','ppm_id')->first();

//           $citys = DB::table($tdetail['master_city'])->where('cm_id',$city)->select('cm_name','cm_id')->first();

//           $leadstages = DB::table($tdetail['lead_categorization'])->where('lc_id',$leadstage)->select('lc_text','lc_id')->first();

//           $states = DB::table($tdetail['master_state'])->where('sm_id',$state)->select('sm_name','sm_id')->first();

          

//           $universitylist = DB::table($tdetail['exhibitor_master'].' as em')

//             // ->join($tdetail['exhibitor_boothstaff'].' as ebs','em.exhim_id','ebs.exhim_id')

//             ->join($tdetail['exhibitor_event_mapping'].' as eem','em.exhim_id','eem.exhim_id')

//             ->where('eem.eem_status','active')

//             ->where('exhim_status','active');

//             if(!empty($selectedEvent) && $AllEvent==false){

//               $universitylist->where('eem.aem_id', $selectedEvent->aem_id);

//             }

//             $ulist= $universitylist->orderby('em.exhim_organization_name','ASC')->get();



//           $leadsource=DB::table($tdetail['master_lead_source'])->where('ls_status','active')->orderby('ls_text','ASC')->get();

//           $ad_id=DB::table($tdetail['lead_event_master_mapping'])->select('lemm_adid')->where('lemm_status','active')->where('lemm_adid','!=','')->whereNotNull('lemm_adid')->orderby('lemm_adid','ASC')->distinct()->get();

          

          $companyList= LeadMaster::all();

//           ->leftJoin($tdetail['lead_event_master_mapping'].' as lemm' , 'lm.lm_id','lemm.lm_id')

//           ->where('lm.lm_statue','active')

//           ->where('lemm.lemm_status','active')

//           ->where('lemm.aem_id', $selectedEvent->aem_id)

//           ->select('lm.lm_company_name')

//           ->groupby('lm.lm_company_name')

//           ->get();

        

       // dd($res);

  

        return view('datatables.visitor-tables-all',[

             'leadList'=>$res,

            'leadcat'=>'',

            'prefix_url' => $this->getBaseUrl,

            'qualificationdata'=>[],

            'leadcategorization'=>[],

            'qualification'=>'',

            'statedata'=>'',

            'datefrom'=>'',

            'dateto'=>'',

            'leadstage'=>'',

            'citys'=>'',

            'states'=>'',

            'productdata'=>[],

            'courses'=>'',

            'leadtype'=>'',

            'leadsource'=>[],

            'leadsrc'=>'',

            'universitylist'=>[],

            'univrstyId'=>'',

            'ad_id'=>[],

            'adid'=>[],

             'companyList' => $companyList,

             'serch_by_company' => '',

            

            ]);

      }
    #####======================= Set Session ===================================#####
    public function seteventasrequest()
    {
          $resp=Array();
          $resp['code']='404';
          $sessDetails=Session('profileDetail');
    
        if(request('eventid')){
    
              $eventid=request('eventid');
              $allevent=false;
              if($eventid=='all'){
                 $allevent=true; 
              }
              Session::put('AllEvent', $allevent);
              ## Current : Event Detail #
              $evntDetail = EventMaster::where('aem_id', '=', request('eventid'))
                 ->orderBy('aem_orderby', 'asc')
              ->first();
              if(isset($evntDetail)){
                  Session::put('selectedEvent', $evntDetail);
                  
                  $resp['code']='200'; 
                  $resp['data']= $evntDetail;
              }
            
        }
        return Redirect::to('/'.base64_decode(request('targetpage'))); 
      }
     public function packageManger(){
        
        $selectedEvent=Session('A_Session');
        dd('hjhg');



      $respArray = array();



      $planData = DB::table('1_participation_plans_master')->select('*')->get();



      foreach($planData as $data)

      {

        $otherDataSql = "SELECT

    `1_participation_plans_subscription_mapping`.`ppsm_count`,

    `1_participation_plans_subscription_mapping`.`ppsm_id`,

    `1_participation_plans_subscription`.`pps_name`,

    `1_participation_plans_subscription_mapping`.`ppm`

FROM

    `1_participation_plans_subscription_mapping`

LEFT JOIN `1_participation_plans_subscription` ON `1_participation_plans_subscription_mapping`.`pps_id` = `1_participation_plans_subscription`.`pps_id`

WHERE

    `ppm` = '$data->ppm_id' ORDER BY `1_participation_plans_subscription`.`pps_id` ASC";

        

        $respArray[$data->ppm_text] = DB::select($otherDataSql);

  

      }



    return view('datatables.packageManager',['leadList'=>$respArray,'planData'=>$planData]);

  }



  public function getPackageData(){

    $ppm_id = request('ppm_id');

    $plans = DB::table('1_participation_plans_subscription')->select('*')->get();
    $packageData = DB::table('1_participation_plans_master')->select('ppm_text')->where('ppm_id',$ppm_id)->first();
    $leadlist = array();

    for ($i=0; $i < count($plans); $i++) { 

      $leadlist = DB::table('1_participation_plans_subscription_mapping')->select('*')->where('ppm',$ppm_id)->where('pps_id',$plans[$i]->pps_id)->first();

      echo $content =  view('datatables.packageGenerate',['ppsName'=>$plans[$i]->pps_name,'ppsm_count'=>$leadlist->ppsm_count,'ppm_text'=>$packageData->ppm_text])->render(); 

    }

  }



  public function updatePackage(){

    $plansSubscription = request('plansSubscription');

    $ppm_id = request('ppmId');

    for($i=0,$k=1;$i<count($plansSubscription);$i++,$k++){

      DB::table('1_participation_plans_subscription_mapping')->where('ppm',$ppm_id)->where('pps_id',$k)->update(array(

        'ppsm_count'=>$plansSubscription[$i]

      ));

    }

  }
   
    public function settings(){
                           
        //  $selectedEvent=Session('evntDetail');
          $selectedEvent=Session('selectedEvent');
          $bm_id=Session('bm_id');
         
        //   dd($bm_id); 
       
        $settinngsList=AppFeatureMaster::leftJoin('setting_mappings', function($join) {
      $join->on('1_app_feature_master.afm_id', '=', 'setting_mappings.afm_id');
  })->where('sm_status','active')->where('bm_id',$bm_id)->get(); 

        //  dd($settinngsList);
        $LandingPage=AppLandingpageMaster::where('alm_status','active')->get(); 
       
        //  $FeatureSetting=FeatureSettingAgainstAnEvent::where('fsae_status','active')
        $FeatureSetting=SettingMapping::where('sm_status','active')
        //  ->where('aem_id',$selectedEvent->aem_id)->where('bm_id',$selectedEvent->bm_id)
         ->get();  
          //dd($FeatureSetting);                      
       return view('settings.settings',['settinngsList'=>$settinngsList,
                                        'LandingPage'=>$LandingPage,
                                        'FeatureSetting'=>$FeatureSetting,
                                        'prefix_url' => $this->getBaseUrl
                                        ]);
    }
    
    public function saveSettings(){
       
        $selectedEvent=Session('selectedEvent');
        $bm_id=Session('bm_id');
       // dd($selectedEvent); 
        // $check=FeatureSettingAgainstAnEvent::where('afm_id',request('AfmId'))
        $check=SettingMapping::where('afm_id',request('AfmId'))
        ->where('bm_id',$bm_id)->get(); 
//   dd($check);
        if(count($check)!=0){
            // FeatureSettingAgainstAnEvent::where('aem_id',$selectedEvent->aem_id)
            SettingMapping::where('afm_id',request('AfmId'))
                ->where('bm_id',$bm_id)
                ->update(
                array(
                    'alm_id'=>request('AlmId'),
                    'sm_status'=>request('reqText')
                    )
                );
        }
        // else{
        //     FeatureSettingAgainstAnEvent::insert(
        //         array(
        //             'afm_id'=>request('AfmId'),
        //             'aem_id'=>$selectedEvent->aem_id,
        //             'alm_id'=>request('AlmId'),
        //             'fsae_status'=>request('reqText')
        //             )
        //         );
        // }
        
        return 'success';
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
##===================================================================== MY SECTION ==========================================================================##
    
    
    
    public function landingPage(){
     
     $selectedEvent=Session('selectedEvent');
     
     $setpage = 'lpage.landingPage';
     
     if(request('template') == base64_encode(1)){
        $setpage = 'lpage.landingPage';    
     }
     
     if(request('template') == 'two'){
        $setpage = 'lpage.landingPage2';    
     }
     
         $data = DB::table('1_cms_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->get();
        
        $galleryData = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->where('lgm_type','image')
        ->where('lgm_caption','gallery')
        ->where('lgm_status','active')
        ->get();
        
        $goldSponsor = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->where('lgm_type','image')
        ->where('lgm_caption','Gold Sponsor')
        ->where('lgm_status','active')
        ->get();
        
        $silverSponsor = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->where('lgm_type','image')
        ->where('lgm_caption','Silver Sponsor')
        ->where('lgm_status','active')
        ->get();
        
        $videoData = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->where('lgm_type','video')
        ->where('lgm_caption','Youtube Video')
        ->where('lgm_status','active')
        ->first();
        
        $spkData = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->where('lgm_type','image')
        ->where('lgm_caption','Speaker')
        ->where('lgm_status','active')
        ->get();
        
        
        $agendaDate=array();
        $agenda=array();
        $age=array();
        
        $sqlagendaDate="SELECT Distinct DATE_FORMAT(lccs_start_datewtime, '%Y-%m-%d') as date  FROM 1_live_career_counseling_sessions
        WHERE lccs_status = 'active' and aem_id='".$selectedEvent->aem_id."' and template_name='".request('template')."'
              order by date asc";
              $agendaDate=DB::select($sqlagendaDate);
              
    foreach($agendaDate as $date){
        
            $sqlagenda = "select * from `1_live_career_counseling_sessions` as `lccs` left join (
            SELECT 
              lccss.`lccs_id`, 
              GROUP_CONCAT(lccss.`lccss_name` SEPARATOR ',' ) as 'spk_name',
              GROUP_CONCAT(lccss.`lccss_company_name` SEPARATOR ',' ) as 'spk_cmp_name',
              GROUP_CONCAT(lccss.`lccss_pic` SEPARATOR ',' ) as 'spk_img_name'
              FROM 
                  `1_live_career_counseling_sessions` as lccs
              join `1_live_career_counseling_sessions_speaker` as lccss ON  lccs.`lccs_id` = lccss.`lccs_id`
              WHERE lccss.lccss_status = 'active'
              group by lccss.lccs_id) as spk on `spk`.`lccs_id` = `lccs`.`lccs_id` where aem_id='".$selectedEvent->aem_id."' and template_name='".request('template')."' 
              and `lccs`.`lccs_status` = 'active'  and lccs.lccs_start_datewtime LIKE '%".$date->date."%'  ";
        
        $agenda = DB::select($sqlagenda);
        $age[$date->date]=$agenda;
              
      }

        $respReq['dateWiseAgenda']=  $age;
        
        
        
        
        $bannerImg = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->where('lgm_type','image')
        ->where('lgm_caption','Banner')
        ->where('lgm_status','active')
        ->get();
        
        $milestoneImg = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->where('lgm_type','image')
        ->where('lgm_caption','Milestone')
        ->where('lgm_status','active')
        ->get();
        
        $sponsorBgImg = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        ->where('template_name',request('template'))
        ->where('lgm_type','image')
        ->where('lgm_caption','Sponsor Bg-Image')
        ->where('lgm_status','active')
        ->get();
        
        $sectionData = DB::table('1_section_master')
                    ->where('sm_status','active')
                    ->get();
                    
        $sectionMapData = DB::table('1_section_master_mapping')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('template_name',request('template'))
                    ->get();
                    
        $sectionIsEnabled = DB::table('1_section_master_mapping as smm')
                    ->leftJoin('1_section_master as sm','smm.sm_id','sm.sm_id')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('template_name',request('template'))
                    ->get();
        
        $commonFields = DB::table('1_registration_field_master as rfm')
                    ->leftJoin('1_registration_field_master_mapping as rfmm','rfm.rfm_id','rfmm.rfm_id')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('rfm.rfm_status','active')
                    ->where('rfmm.rfmm_status','active')
                    ->get();
                    
        $customFields = DB::table('1_registration_field_custom')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('rfc_status','active')
                    ->orderBy('rfc_orderby','ASC')
                    ->get();
     
     
     return view($setpage,['data'=>$data,
        'galleryData'=>$galleryData,
        'goldSponsor'=>$goldSponsor,
        'silverSponsor'=>$silverSponsor,
        'videoData'=>$videoData,
        'spkData'=>$spkData,
        'agenda'=>$respReq,
        'bannerImg'=>$bannerImg,
        'milestoneImg'=>$milestoneImg,
        'sponsorBgImg'=>$sponsorBgImg,
        'sectionData'=>$sectionData,
        'sectionMapData'=>$sectionMapData,
        'sectionIsEnabled'=>$sectionIsEnabled,
        'commonFields'=>$commonFields,
        'customFields'=>$customFields
        
        ]);
    }
    
    public function logoUpload(Request $request){
        
        $selectedEvent=Session('selectedEvent');
        
        if (isset($_POST['uploadlogo'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'logo-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
                
                $data['logo_image']=$image_url;
            }
        }

        if (isset($_POST['uploadlogoFoo'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'logoFoo-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
                
                $data['logo_foo_image']=$image_url;
            }
        }
        
        if (isset($_POST['socialMedia'])) {
            
            $data['facebook']= request('facebook');
            
            $data['instagram']= request('instagram');
            
            $data['twitter']= request('twitter');
        }
        
        
            
            $data['aem_id']= $selectedEvent->aem_id;
            
            $data['template_name']=request('template');
            
            $check = DB::table('1_cms_master')
                ->where('aem_id',$selectedEvent->aem_id)
                ->where('template_name',request('template'))
                ->first();
                
            if($check !== null){
                $insert = DB::table('1_cms_master')->where('aem_id',$selectedEvent->aem_id)->where('template_name',request('template'))->update($data);    
            }else{
                $insert = DB::table('1_cms_master')->insert($data);
            }
            
            return Redirect::back();

    }
    
    
    public function photoUpload(Request $request){
        
        $selectedEvent=Session('selectedEvent');
        
        if (isset($_POST['uploadphoto'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'gallery-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
                
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='gallery';
            }
        }

        if (isset($_POST['uploadgSponsor'])) {
            
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'gSpon-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
                
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Gold Sponsor';
            }
        }

        if (isset($_POST['uploadsSponsor'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'sSpon-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
                
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Silver Sponsor';
            }
        }
        
        if (isset($_POST['uploadvideo'])) {
            
            $check = DB::table('1_lpage_gallery_master')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('template_name',request('template'))
                    ->where('lgm_type','video')
                    ->where('lgm_caption','Youtube Video')
                    ->where('lgm_status','active')
                    ->get();
            
                if(!empty($check)){
    
                    foreach($check as $ch){
                         $update = DB::table('1_lpage_gallery_master')->where('aem_id',$selectedEvent->aem_id)->where('lgm_id',$ch->lgm_id)->update(array(
                            'lgm_status'=>'inactive'
                            ));   
                    }
                }
            
            // $image = request('thumbnail_img');
            
            // $destinationPath = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'; // upload path

            // $profileImage = 'thumb-'.date('YmdHis') . "." . $image->getClientOriginalExtension();

            // $image_url = $destinationPath.$profileImage;

            // $success = $image->move('public/'.$destinationPath, $profileImage);
            
            if(strpos(request('video_url'), '?v') == true){
                
                 $newurl=explode('?v=',request('video_url'));
                 $videoUrl="https://www.youtube.com/embed/".$newurl[1];
            } 
            else if(strpos(request('video_url'), 'youtu.be/') == true){
                
                $newurl=explode('youtu.be/',request('video_url'));
                $videoUrl="https://www.youtube.com/embed/".$newurl[1];
            }
            
            // $data['lgm_name']=$image_url;
            
            $data['lgm_video_url']=$videoUrl;
            
            $data['lgm_type']='video';
            
            $data['lgm_caption']='Youtube Video';
            
            $data['lgm_video_type']='Youtube';
        }
        
        if (isset($_POST['addSpeaker'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'spk-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
                
                $data['lgm_name']=$image_url;
            
                $data['lgm_type']='image';
                $data['lgm_spk_name']=request('spk_name');
                $data['lgm_spk_des']=request('spk_des');
                $data['lgm_caption']='Speaker';
            }
        }
        
        if (isset($_POST['uploadBanner'])) {
            
            if(!null==request('croppedImage')){
            
            $check = DB::table('1_lpage_gallery_master')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('template_name',request('template'))
                    ->where('lgm_type','image')
                    ->where('lgm_caption','Banner')
                    ->where('lgm_status','active')
                    ->get();
            
                if(!empty($check)){
    
                    foreach($check as $ch){
                         $update = DB::table('1_lpage_gallery_master')->where('aem_id',$selectedEvent->aem_id)->where('lgm_id',$ch->lgm_id)->update(array(
                            'lgm_status'=>'inactive'
                            ));   
                    }
                }
            
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'banner-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
    
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Banner';
                
            }
            
            
        }
        
        
        if (isset($_POST['uploadMile'])) {
            
            if(!null==request('croppedImage')){
            
            $check = DB::table('1_lpage_gallery_master')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('template_name',request('template'))
                    ->where('lgm_type','image')
                    ->where('lgm_caption','Milestone')
                    ->where('lgm_status','active')
                    ->get();
            
                if(!empty($check)){
    
                    foreach($check as $ch){
                         $update = DB::table('1_lpage_gallery_master')->where('aem_id',$selectedEvent->aem_id)->where('lgm_id',$ch->lgm_id)->update(array(
                            'lgm_status'=>'inactive'
                            ));   
                    }
                }
                
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'milestone-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
    
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Milestone';
            
            }
            
        }
        
        
        if (isset($_POST['uploadSpon'])) {
            
            if(!null==request('croppedImage')){
            
            $check = DB::table('1_lpage_gallery_master')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('template_name',request('template'))
                    ->where('lgm_type','image')
                    ->where('lgm_caption','Sponsor Bg-Image')
                    ->where('lgm_status','active')
                    ->get();
            
                if(!empty($check)){
    
                    foreach($check as $ch){
                         $update = DB::table('1_lpage_gallery_master')->where('aem_id',$selectedEvent->aem_id)->where('lgm_id',$ch->lgm_id)->update(array(
                            'lgm_status'=>'inactive'
                            ));   
                    }
                }
                
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'sponBg-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'.$imageName;
    
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Sponsor Bg-Image';
                
            }
            
        }

        




            
            $data['aem_id']= $selectedEvent->aem_id;
            
            $data['template_name']=request('template');
            
            
            $insert = DB::table('1_lpage_gallery_master')->insert($data);
            
            return Redirect::back();

    }


public function removegalleryitem(){
        
        $selectedEvent=Session('selectedEvent');
        
            $update = DB::table('1_lpage_gallery_master')->where('aem_id',$selectedEvent->aem_id)->where('lgm_id',request('lgm_id'))->update(array(
                'lgm_status'=>'inactive'
                )); 
        
    }
    
    
    public function Addcms(){

        $selectedEvent=Session('selectedEvent');

        $data  = array();
        
        $data['aem_id']= $selectedEvent->aem_id;
        $data['template_name']= request('template');
        
        //banner section
        $data['baner_subtitle']= request('baner_subtitle');
        $data['baner_title']= request('baner_title');
        $data['baner_date']= request('baner_date');
        $data['baner_location']= request('baner_location');
        
        //about section
        $data['about_head']= request('about_head');
        $data['about_subhead']= request('about_subhead');
        $data['about_content']= request('about_content');
        
        //count section
        $data['count_one']= request('count_one');
        $data['count_one_name']= request('count_one_name');
        $data['count_two']= request('count_two');
        $data['count_two_name']= request('count_two_name');
        $data['count_three']= request('count_three');
        $data['count_three_name']= request('count_three_name');
        $data['count_four']= request('count_four');
        $data['count_four_name']= request('count_four_name');
        
        //speaker section
        $data['speaker_title']= request('speaker_title');
        $data['speaker_subtitle']= request('speaker_subtitle');
        
        //event section
        $data['event_title']= request('event_title');
        $data['event_subtitle']= request('event_subtitle');
        
        //sponsor section
        $data['sponsor_title']= request('sponsor_title');
        $data['sponsor_subtitle']= request('sponsor_subtitle');
        
        //gallery section
        $data['gallery_title']= request('gallery_title');
        $data['gallery_subtitle']= request('gallery_subtitle');
        
        //blog section
        $data['blog_title']= request('blog_title');
        $data['blog_subtitle']= request('blog_subtitle');
        
        //footer section
        $data['foo_title']= request('foo_title');
        $data['foo_date']= request('foo_date');
        $data['foo_address']= request('foo_address');
        
        //socialMedia section
        $data['social_title']= request('social_title');
        $data['social_subtitle']= request('social_subtitle');
        
        $check = DB::table('1_cms_master')
                ->where('aem_id',$selectedEvent->aem_id)
                ->where('template_name',request('template'))
                ->first();
                
        if($check !== null){
            $insert = DB::table('1_cms_master')->where('aem_id',$selectedEvent->aem_id)->where('template_name',request('template'))->update($data);    
        }else{
            $insert = DB::table('1_cms_master')->insert($data);
        }
        
        
        return $insert;
        
        // dd($data);

    }
    
    
    
    public function addcareersessions(Request $request){

        $selectedEvent=Session('selectedEvent');
        $moderatorImage="";
        $hostImage="";
        $sbannerImage="";
        
        // $roomId=  RoomController::createRoom();
        // $room_id=json_decode($roomId->getContent(),TRUE)['room']['room_id'];
        // $room_id='';
        // $pastvideourl="";
                //  if(!null==request('pastvideo_url')){
                //     $imageName = request('pastvideo_url');
                //     if(strpos(request('pastvideo_url'), '/embed/') == false){
                //         $newurl=explode('?v=',request('pastvideo_url'));
                //          $imageName="https://www.youtube.com/embed/".$newurl[1];
                //           //dump($imageName);
                //           $pastvideourl=$imageName;
                //     }
                //  }
                 
                 
                //  if(!null==request("moderatorpic")){
                //       $destinationMPath = 'assets/images/'.$bmid.'/Moderator/'.$selectedEvent->aem_id; // upload path        
                //           $moderatorImage = date('YmdHis') . "." . request("moderatorpic")->getClientOriginalExtension();
                //           $successM = request("moderatorpic")->move(public_path($destinationMPath), $moderatorImage);  
                     
                //  }
               
                //   if(!null==request("hostpic")){
                //         $destinationHPath = 'assets/images/'.$bmid.'/Host/'.$selectedEvent->aem_id; // upload path        
                //           $hostImage = date('YmdHis') . "." . request("hostpic")->getClientOriginalExtension();
                //           $successH = request("hostpic")->move(public_path($destinationHPath), $hostImage);  
                     
                //  }
                 
                //   if(!null==request("sbanner")){
                         
                //             $destinationsbannerPath = 'assets/images/counseling_sessions_banner/'.$bmid.'/'.$selectedEvent->aem_id; // upload path        
                //           $sbannerImage = date('YmdHis') . "." . request("sbanner")->getClientOriginalExtension();
                //           $successsbanner = request("sbanner")->move(public_path($destinationsbannerPath), $sbannerImage);  
                //  }
                           
                          
    
                    $insert=DB:: table('1_live_career_counseling_sessions')
                    ->insertGetId(
                      array(
                                    'aem_id'=>$selectedEvent->aem_id, 
                                    'template_name'=>request('template'), 
                                    'lccs_name'=>request('name'),
                                   
                                    'lccs_type'=>request('type'),
                                    'lccs_sub_title'=>request('sub_title'),
                                    
                                    // 'lccs_moderator_name'=>request('moderator'),
                                    // 'lccs_moderator_pic'=>$moderatorImage,
                                    // 'lccs_moderator_designation'=>request('mdesignation'),
                                    // 'lccs_moderator_desc'=>request('mdesc'),
                                    // 'lccs_host_name'=>request('host'),
                                    //  'lccs_host_pic'=>$hostImage,
                                    // 'lccs_host_designation'=>request('hdesignation'),
                                    // 'lccs_host_desc'=>request('hdesc'),
                                    'lccs_start_datewtime'=>request('picker3'),
                                    'lccs_end_datewtime'=>request('enddate'),
                                   
                                    // 'lccs_zoom_id'=>request('zoomid'),
                                    //  'lcss_room_id'=>request('roomid'),
                                    // 'lccs_zoom_pwd'=>request('zoompass'),
                                    // 'lccs_past_session_video_url'=>$pastvideourl
                                  
                                  )
                          );

        //  DB::table('1_live_career_counseling_sessions_banner')->insert(array(
          
        //                 'lccsd_type'=>request('type'),
        //                 'aem_id'=>$selectedEvent->aem_id,
        //                 'lccsb_name'=>$sbannerImage
        //   ));
             

						for($j=0;$j<=request('row_count_speaker');$j++){
						     $insrtarray=array();
                            $insrtarray['lccs_id']=$insert;
							if(!empty(request("sname-$j")) ){
						        $insrtarray['lccss_name']=request("sname-$j");

							}
							
							if(!empty(request("scname-$j")) ){
						        $insrtarray['lccss_company_name']=request("scname-$j");

							}
								if(!empty(request("stime-$j")) ){
						        $insrtarray['lccss_time']=request("stime-$j");

							}
							
							if(!empty(request("sdesig-$j"))){
								 $insrtarray['lccss_designation']=request("sdesig-$j");
							}
							if(!empty(request("sdesc-$j"))){
								 $insrtarray['lccss_description']=request("sdesc-$j");
							}
							if(!empty(request("spic-$j"))){
						    $destinationPath = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'; // upload path        
                          $profileImage = date('YmdHis') . "-".$j."." . request("spic-$j")->getClientOriginalExtension();
                          $success = request("spic-$j")->move(public_path($destinationPath), $profileImage);  
							    
								 $insrtarray['lccss_pic']=$destinationPath.$profileImage;
							}
                                 DB::table('1_live_career_counseling_sessions_speaker')->insert($insrtarray);

						}	
                 
         return "true";

        }
        
public function editcareersessions(){

          $dataList=DB::table('1_live_career_counseling_sessions')
            ->where('lccs_id',request('lccs_id'))->first();
            $speaker_data=DB::table('1_live_career_counseling_sessions as lccs')
                  ->join('1_live_career_counseling_sessions_speaker','lccs.lccs_id','1_live_career_counseling_sessions_speaker.lccs_id')
                  ->where('lccs.lccs_id',request('lccs_id'))->where('1_live_career_counseling_sessions_speaker.lccss_status','active')->get();
            //   dd($dataList);
            return view('lpage.editcareersessions',[
                  'dataList'=>$dataList,'speaker_data'=>$speaker_data
              ]);
        }
        
        
public function updatecareersessions(){
    
        $selectedEvent=Session('selectedEvent');
        $moderatorImage="";
        $hostImage="";
        $sbannerImage="";
          
            //  $pastvideourl="";
            //      if(!null==request('pastvideo_url')){
            //         $imageName = request('pastvideo_url');
            //         if(strpos(request('pastvideo_url'), '/embed/') == false){
            //             $newurl=explode('?v=',request('pastvideo_url'));
            //              $imageName="https://www.youtube.com/embed/".$newurl[1];
            //               //dump($imageName);
            //               $pastvideourl=$imageName;
            //         }
            //      }
                 
                 
                    
            //      if(!null==request("e_moderatorpic")){
            //           $destinationMPath = 'assets/images/'.$bmid.'/Moderator/'.$selectedEvent->aem_id; // upload path        
            //               $moderatorImage = date('YmdHis') .request('lccs_id'). "." . request("e_moderatorpic")->getClientOriginalExtension();
            //               $successM = request("e_moderatorpic")->move(public_path($destinationMPath), $moderatorImage);  
            //                       $insertData=DB::table($tdetail['live_career_counseling_sessions'])
            //                     ->where('lccs_id',request('lccs_id'))
            //                     ->update(
            //                           array( 
                                           
                                          
            //                                 'lccs_moderator_pic'=>$moderatorImage
                                           
            //                               )
            //                         );
                                  
                     
            //      }
               
            //       if(!null==request("e_hostpic")){
            //             $destinationHPath = 'assets/images/'.$bmid.'/Host/'.$selectedEvent->aem_id; // upload path        
            //               $hostImage = date('YmdHis') .request('lccs_id'). "." . request("e_hostpic")->getClientOriginalExtension();
            //               $successH = request("e_hostpic")->move(public_path($destinationHPath), $hostImage); 
                          
                                    
            //                  $insertData=DB::table($tdetail['live_career_counseling_sessions'])
            //                             ->where('lccs_id',request('lccs_id'))
            //                             ->update(
            //                                   array( 
                                                   
                                                  
            //                                          'lccs_host_pic'=>$hostImage
                                                   
            //                                       )
            //                                 );

                     
            //      }
            //       if(!null==request("e_sbanner")){
                         
            //                 $destinationsbannerPath = 'assets/images/counseling_sessions_banner/'.$bmid.'/'.$selectedEvent->aem_id; // upload path        
            //               $sbannerImage = date('YmdHis') .request('lccs_id'). "." . request("e_sbanner")->getClientOriginalExtension();
            //               $successsbanner = request("e_sbanner")->move(public_path($destinationsbannerPath), $sbannerImage);  
            //      }
          
          
          $insertData=DB::table('1_live_career_counseling_sessions')
                        ->where('lccs_id',request('lccs_id'))
                        ->update(
                              array( 
                                    'aem_id'=>$selectedEvent->aem_id, 
                                    'template_name'=>request('template'),               
                                    'lccs_name'=>request('e_name'),
                                    // 'lccs_speaker_name'=>request('es_name'),
                                    'lccs_type'=>request('e_type'),
                                    'lccs_sub_title'=>request('e_sub_title'),
                                    // 'lccs_moderator_name'=>request('e_moderator'),
                                   
                                    // 'lccs_moderator_designation'=>request('e_mdesignation'),
                                    // 'lccs_moderator_desc'=>request('e_mdesc'),
                                    // 'lccs_host_name'=>request('e_host'),
                                    
                                    // 'lccs_host_designation'=>request('e_hdesignation'),
                                    // 'lccs_host_desc'=>request('e_hdesc'),
                                    'lccs_start_datewtime'=>request('e_startdates'),
                                    'lccs_end_datewtime'=>request('e_enddate'),
                                    //   'lcss_room_id'=>request('e_roomid'),
                                    // 'lccs_zoom_id'=>request('e_zoomid'),
                                    // 'lccs_zoom_pwd'=>request('e_zoompass'),
                                    // 'lccs_past_session_video_url'=>$pastvideourl
                                  )
                            );
                            
                            
                
        //  DB::table('1_live_career_counseling_sessions_banner')->insert(array(
          
        //                 'lccsd_type'=>request('type'),
        //                 'aem_id'=>$selectedEvent->aem_id,
        //                 'lccsb_name'=>$sbannerImage
        //   ));
             

						for($j=0;$j<=request('row_count_nspeaker');$j++){
						    
						      $updtarray=array();
                           
							if(!empty(request("esname-$j")) ){
						        $updtarray['lccss_name']=request("esname-$j");

							}
							
								if(!empty(request("escname-$j")) ){
						        $updtarray['lccss_company_name']=request("escname-$j");

							}
								if(!empty(request("estime-$j")) ){
						        $updtarray['lccss_time']=request("estime-$j");

							}
							
							if(!empty(request("esdesig-$j"))){
								 $updtarray['lccss_designation']=request("esdesig-$j");
							}
							if(!empty(request("esdesc-$j"))){
								 $updtarray['lccss_description']=request("esdesc-$j");
							}
							if(!empty(request("espic-$j"))){
					  
						    $destinationPath = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'; // upload path        
                          $profileImage = date('YmdHis') . "-".$j."." . request("espic-$j")->getClientOriginalExtension();
                          $success = request("espic-$j")->move(public_path($destinationPath), $profileImage);  
						
								 $updtarray['lccss_pic']=$destinationPath.$profileImage;
							}
							
						if(!null==request("lccss_id-$j") && !empty($updtarray)){
						    DB::table('1_live_career_counseling_sessions_speaker')->where('lccss_id',request("lccss_id-$j"))->update($updtarray);
						}
                                 
                                 
                                 
                                 
                        ###insert ###
                         $insrtarray=array();
                        
                        if(!empty(request("new_sname-$j")) ){
						        $insrtarray['lccss_name']=request("new_sname-$j");
						         $insrtarray['lccs_id']=request('lccs_id');

							}
							
							if(!empty(request("new_scname-$j")) ){
						        $insrtarray['lccss_company_name']=request("new_scname-$j");

							}
							if(!empty(request("new_stime-$j")) ){
						        $insrtarray['lccss_time']=request("new_stime-$j");

							}
							
							if(!empty(request("new_sdesig-$j"))){
								 $insrtarray['lccss_designation']=request("new_sdesig-$j");
							}
							if(!empty(request("new_sdesc-$j"))){
								 $insrtarray['lccss_description']=request("new_sdesc-$j");
							}
							if(!empty(request("new_spic-$j"))){
						    $new_destinationPath = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.request('template').'/'; // upload path        
                          $new_profileImage = date('YmdHis') . "-".$j."." . request("new_spic-$j")->getClientOriginalExtension();
                          $new_success = request("new_spic-$j")->move(public_path($new_destinationPath), $new_profileImage);  
							    
								 $insrtarray['lccss_pic']=$new_destinationPath.$new_profileImage;
							}
							if(!empty($insrtarray)){
							       DB::table('1_live_career_counseling_sessions_speaker')->insert($insrtarray);
							}
                              
                                 

						}	            
                            
    
                        return "Updated";
        }
    
    
public function deleteSessionspeaker(){
        
        DB::table('1_live_career_counseling_sessions_speaker')->where('lccss_id',request('del_id'))->update(array('lccss_status'=>'inactive'));
    }
    
    
public function deletecareersessions(){
        
        DB::table('1_live_career_counseling_sessions')->where('lccs_id',request('lccs_id'))->update(array('lccs_status'=>'inactive'));
    }

public function sectionToggle(){
    
        $selectedEvent=Session('selectedEvent');
        
        $check = DB::table('1_section_master_mapping')
                ->where('aem_id',$selectedEvent->aem_id)
                ->where('template_name',request('template'))
                ->where('sm_id',request('sm_id'))
                ->first();
                
        // dd($check);
  
        $data['sm_id']=request('sm_id');
        $data['aem_id']=$selectedEvent->aem_id;
        $data['template_name']=request('template');
        $data['smm_status']=request('reqText');
  
        if($check !== null){
                $insert = DB::table('1_section_master_mapping')
                ->where('aem_id',$selectedEvent->aem_id)
                ->where('template_name',request('template'))
                ->where('sm_id',request('sm_id'))
                ->update($data);    
            }else{
                $insert = DB::table('1_section_master_mapping')->insert($data);
            }
        
        return 'success';

    }
    
    
public function manageRegistration(){
        $selectedEvent=Session('selectedEvent');
        
        $commonFields = DB::table('1_registration_field_master')
                    ->where('rfm_status','active')
                    ->get();
                    
        $commonFieldsMapp = DB::table('1_registration_field_master_mapping')
                    ->where('aem_id',$selectedEvent->aem_id)
                    // ->where('template_name',request('template'))
                    ->get();
                    
        $customFields = DB::table('1_registration_field_custom')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->get();
        
        return view('lpage.manage-registration-page',[
            'selectedEvent'=>$selectedEvent,
            'commonFields'=>$commonFields,
            'commonFieldsMapp'=>$commonFieldsMapp,
            'customFields'=>$customFields
            
            ]);
    }
    
    
    
public function fieldToggle(){
    
        $selectedEvent=Session('selectedEvent');
        
        $check = DB::table('1_registration_field_master_mapping')
                ->where('aem_id',$selectedEvent->aem_id)
                ->where('rfm_id',request('rfm_id'))
                ->first();
  
        $data['rfm_id']=request('rfm_id');
        $data['aem_id']=$selectedEvent->aem_id;
        $data['rfmm_status']=request('reqText');
  
        if($check !== null){
                $insert = DB::table('1_registration_field_master_mapping')
                ->where('aem_id',$selectedEvent->aem_id)
                // ->where('template_name',request('template'))
                ->where('rfm_id',request('rfm_id'))
                ->update($data);    
            }else{
                $insert = DB::table('1_registration_field_master_mapping')->insert($data);
            }
        
        return 'success';

    }
    
    
    
public function addCustomField(Request $request){

        $selectedEvent=Session('selectedEvent');

			for($j=0;$j<=request('row_count_field');$j++){
			    
			    $insrtarray=array();
                
				if(!empty(request("flabel-$j")) ){
				    $insrtarray['aem_id']=$selectedEvent->aem_id;
			        $insrtarray['rfc_label']=request("flabel-$j");
				}
				
				if(!empty(request("ftype-$j")) ){
			        $insrtarray['rfc_type']=request("ftype-$j");
				}
				
				if(!empty(request("fvalue-$j")) ){
			        $insrtarray['rfc_values']=request("fvalue-$j");
				}
				
				if(!empty(request("freq-$j")) ){
			        $insrtarray['is_mandatory']=request("freq-$j");
				}

                DB::table('1_registration_field_custom')->insert($insrtarray);

			}	
			
// 			dd($insrtarray);
                 
         return "true";

        }
        
        
public function updatecustomfield(){
    
        $selectedEvent=Session('selectedEvent');
             

		for($j=0;$j<=request('row_count_nfield');$j++){
		    
		      $updtarray=array();
           
			if(!empty(request("eflabel-$j")) ){
			        $updtarray['rfc_label']=request("eflabel-$j");
				}
				
				if(!empty(request("eftype-$j")) ){
			        $updtarray['rfc_type']=request("eftype-$j");
				}
				
				if(!empty(request("efvalue-$j")) ){
			        $updtarray['rfc_values']=request("efvalue-$j");
				}else{
				    $updtarray['rfc_values']=null;
				}
				
				if(!empty(request("efreq-$j")) ){
			        $updtarray['is_mandatory']=request("efreq-$j");
				}else{
				    $updtarray['is_mandatory']='off';
				}
			
		if(!null==request("rfc_id-$j") && !empty($updtarray)){
		    DB::table('1_registration_field_custom')->where('rfc_id',request("rfc_id-$j"))->update($updtarray);
		}                        

	}	            
                            
    
                        return "Updated";
}


public function cfToggle(){
        $selectedEvent=Session('selectedEvent');
        
            $update = DB::table('1_registration_field_custom')->where('aem_id',$selectedEvent->aem_id)->where('rfc_id',request('rfc_id'))->update(array(
                request('reqColumn')=>request('reqText')
                ));   
    }


public function cfEdit(){
    
    $selectedEvent=Session('selectedEvent');
    
        $commonFields = DB::table('1_registration_field_master')
                    ->where('rfm_status','active')
                    ->get();
                    
        $commonFieldsMapp = DB::table('1_registration_field_master_mapping')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->get();
                    
        $customFields = DB::table('1_registration_field_custom')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('rfc_id',request('rfc_id'))
                    ->first();
            
            return view('lpage.editcustomfields',[
                  'commonFields'=>$commonFields,
                  'commonFieldsMapp'=>$commonFieldsMapp,
                  'cust'=>$customFields
              ]);
        }

public function setOrderBy(){
    $selectedEvent=Session('selectedEvent');
    
    $update = DB::table('1_registration_field_custom')->where('aem_id',$selectedEvent->aem_id)->where('rfc_id',request('rfc_id'))->update(array(
                'rfc_orderby'=>request('orderVal')
                )); 
    
}    

public function cropperJs()
    {
        return view('lpage.crop-image-upload');
    }



public function uploadCropImage(Request $request){
        $folderPath = public_path('upload/');
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
 
        $imageName = uniqid() . '.' .$image_type;
 
        $imageFullPath = $folderPath.$imageName;
        
        if (!is_dir($folderPath)) {
            // dd('does not exist');
          mkdir($folderPath);
        }
 
        file_put_contents($imageFullPath, $image_base64);
        
        dd($imageFullPath);
 
        //  $saveFile = new Picture;
        //  $saveFile->name = $imageName;
        //  $saveFile->save();
    
        // return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }

    
##======================================================================MY SECTION END===========================================================================##
}
