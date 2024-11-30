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
use App\ComModel;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class AdminController extends Controller
{

    
    protected $request;
	
    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::adminBaseUrl($request);
    }

    public function dashboard(){
        $today=date('Y-m-d');
        $bm_id = Session('bm_id');
        
        $totalLead= DB::table('1_lead_master as lm')
                    ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id', 'lm.lm_id')
                     ->where('lemm.bm_id', $bm_id)
                    //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
                    ->count();
        
        $todayLead= DB::table('1_lead_master as lm')
                    ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id', 'lm.lm_id')
                    //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
                    ->where('lemm.bm_id', $bm_id)
                    ->where('lm.lm_create_date','like','%'.$today.'%')
                    ->count();
        
        $leadsource=DB::table('1_lead_master as lm')
                    ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id', 'lm.lm_id')
                    ->join('1_master_lead_source as mls','mls.ls_id','lemm.ls_id');
        
        $ieadtotsource=$leadsource->select(DB::raw("count(lemm.lm_id) as TotalCount,mls.ls_text as Name"))
                            ->groupBy('lemm.ls_id')
                            //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
                            ->where('lemm.bm_id', $bm_id)
                            ->get();
                            
        $lineChart = $leadsource->select(DB::raw("count(lemm.lm_id) as TotalCount, date(lm.lm_create_date) as Name"))
                    ->groupBy('lm.lm_create_date')
                    //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
                    ->where('lemm.bm_id', $bm_id)
                    ->get();
        
        $Dtotal = $leadsource->select(DB::raw("date(lm.lm_create_date) as createdate, count(lm.lm_create_date) as TotalCount"))
                          ->groupby(DB::raw("date(lm.lm_create_date)"))
                          //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
                          ->where('lemm.bm_id', $bm_id)
                          ->get(); 
                          
        $tempDetail = CustomerData::select('etm_ids')->where('bm_id',$bm_id)->first();
        $totalTemplates = count(explode(',',$tempDetail->etm_ids));
        
        $totalExhib = DB::table('1_exhibitor_master')->where('bm_id',$bm_id)->count();
        
        //dd($Dtotal);
        
         return view('dashboard.dashboardv2',[
            'totalLead'=>$totalLead,
            'todayLead'=>$todayLead,
            'leadsource'=>$ieadtotsource,
            'lineChart'=>$lineChart,
            'Dtotal'=>$Dtotal,
            'totalTemp'=>$totalTemplates,
            'totalExhib'=>$totalExhib
             ]);
    }
    
//   public function lpage(){
//       $cms = CmsMaster::get();
//       //dd($cms);
//         $options = view("lpage.index10")->render();
//         // dd($options);
//          return view('lpage.lindex',['options'=>$options]);
     
//     }
    
    
//     public function lpage1(){
//         $options = view("lpage.index101")->render();
//         // dd($options);
//          return view('lpage.index101');//,['options'=>$options]);
     
//     }
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
    
    //   public function Addspk(Request $request)
    //   {
    //     dd($request->all());
    //   }
    public function manage_events()

      {
            $selectedEvent=Session('A_Session');
            
            // $selectedEvent=Session('selectedEvent');
            // dd($selectedEvent);
            $all_eventList= EventMaster::where('bm_id',$selectedEvent->bm_id)->get();
            
            $brand = DB::table('brand_organizer_master')
                    ->where('bm_id',$selectedEvent->bm_id)
                    ->first();
            
            $Allcountry = MasterCountry::all();
            
            $templateData = DB::table('1_template_master')
                    // ->where('aem_id',$selectedEvent->aem_id)
                    ->where('tm_status','active')
                    ->get();
                    
                    // dd($selectedEvent);
            
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

                return view('datatables.eventMaster',['eventList'=>$all_eventList,
                            'Allcountry'=>$Allcountry,
                            'templateData'=>$templateData,
                            'brand'=>$brand
                            ]);



      }



      public function Addevent(Request $request)

      {  
            $validator = Validator::make($request,[
                        'aem_id' => 'required|numeric',
                        'ex_name' => 'required',
                        'ex_nickname' => 'required',
                        'ex_address' => 'required',
                        'ex_location' => 'required',
                        'ex_livedt' => 'required',
                        'ex_startdates' => 'required',
                        'e_enddate' => 'required',
                        'ex_day' => 'required',
                        'ex_time' => 'required',
                        'ex_timezones' => 'required',
                        'ex_subject' => 'required',
                        'ex_sms' => 'required',
                        'ex_eventmail' => 'required',
                        'ex_date' => 'required',
                        'ex_eventdate' => 'required',
                        'status' => 'required',
                        'he_image' => 'required',
                        'ex_file' => 'required',
                    ]);
                    
            if($validator->fails())
            {
                abort(404);
            }
            else
            {
            $selectedEvent=Session('A_Session');
           
            if(!empty(request('aem_id'))){
    
            $datas  = array();
    
                $datas['bm_id']= $selectedEvent->bm_id;
                
                $datas['aem_name']= request('ex_name');
    
                $datas['aem_event_nickname']= request('ex_nickname');
    
                $datas['aem_full_address']= request('ex_address');  
    
    
    
                $datas['aem_location']= request('ex_location');
    
                $datas['aem_live_date_time']= request('ex_livedt');
                
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
    
                $datas['aem_live_date_time']= request('livedt');
                
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

      }

    public function editevent(){
        
        $validator = Validator::make(['aem_id' => request('aem_id')],[
                        'aem_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $aem_id=request('aem_id');
            $eventlist =  EventMaster::findorfail($aem_id);
            $status =  EventMaster::where('aem_id',$aem_id)->select('aem_status','aem_id')->get();
             $Allcountry = MasterCountry::all();
            return view('datatables.editevent',['eventlist'=>$eventlist,'status'=>$status,'Allcountry'=>$Allcountry ]);
    
        }
    }
     public function GetDataList(){
        
        $selectedEvent=Session('A_Session');
        $bm_id = Session('bm_id');
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
            $paginate = 10;
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
                  
        $res = DB::table('1_lead_master as lm')
                ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                ->leftJoin('master_country as counm'  ,'counm.counm_id','lm.country_id')
                ->leftJoin('1_ticket_data as td', function($leftJoin)use($bm_id)
                {
                    $leftJoin->on('lemm.lemm_id', '=', 'td.lemm_id')
                    ->where('td.bm_id', '=', $bm_id );
                })
                ->select('lemm.*','lm.*','td.is_treasure_hunt','counm.*')
                ->where('lemm.bm_id',$bm_id);
                //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id]);
                
        if(!empty($searchText)){
    
            $res->where(function($query) use ($searchText) {
                $query->where('lm_fullname','like','%'.$searchText.'%')
                      ->orwhere('lm_email','like','%'.$searchText.'%');
            });
        }
    
        $res = $res->orderBy('lm.lm_id','desc')->paginate($paginate);

        $companyList= LeadMaster::all();
        $featureList = Session('featurelist');

        if(request('action')=='download'){
            
            return view('customers.Reports.lead_report',[
                'leadList'=>$res
            ]);
        }
        else{
            return view('customers.visitor-tables-all',[
    
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
                'featureList'=>$featureList
            ]);
        }

      }
    #####======================= Set Session ===================================#####
    public function seteventasrequest()
    {
          $resp=Array();
          $resp['code']='404';
          $sessDetails=Session('profileDetail');
          
          $validator = Validator::make(['event_id' => request('eventid')],[
                        'event_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
    
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
             return Redirect::to('/'.base64_decode(request('targetpage')));
        }
        
      }
     
   
    public function settings()
    {
        $selectedEvent=Session('selectedEvent');
        $bm_id=Session('bm_id');
        
        $settinngsList=AppFeatureMaster::leftJoin('setting_mappings', function($join) {
                            $join->on('1_app_feature_master.afm_id', '=', 'setting_mappings.afm_id');
                        })->where('sm_status','active')->where('bm_id',$bm_id)->get(); 
    
        $LandingPage=AppLandingpageMaster::where('alm_status','active')->get(); 
        
        $FeatureSetting=SettingMapping::where('sm_status','active')->get();  
                          
        return view('settings.settings',['settinngsList'=>$settinngsList,
            'LandingPage'=>$LandingPage,
            'FeatureSetting'=>$FeatureSetting,
            'prefix_url' => $this->getBaseUrl
        ]);
    }
    
    public function saveSettings(){
       
        $selectedEvent=Session('selectedEvent');
        $bm_id=Session('bm_id');
       
        $check=SettingMapping::where('afm_id',request('AfmId'))->where('bm_id',$bm_id)->get(); 

        if(count($check)!=0){
            SettingMapping::where('afm_id',request('AfmId'))
                ->where('bm_id',$bm_id)
                ->update(
                array(
                    'alm_id'=>request('AlmId'),
                    'sm_status'=>request('reqText')
                    )
                );
        }
        return 'success';
    }
    
   
##===================================================================== MY SECTION ==========================================================================##
    
    
    
    public function landingPage(){
     
     $selectedEvent=Session('selectedEvent');
     
     $setpage = 'lpage.landingPage';
     
     if(base64_decode(request('template')) == 1){
        $setpage = 'lpage.landingPage';    
     }
     
     if(base64_decode(request('template')) == '2'){
        $setpage = 'lpage.landingPage2';    
     }
     
         $data = DB::table('1_cms_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('cms_status','active')
        ->get();
        
        $galleryData = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('lgm_type','image')
        ->where('lgm_caption','gallery')
        ->where('lgm_status','active')
        ->get();
        
        $goldSponsor = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('lgm_type','image')
        ->where('lgm_caption','Gold Sponsor')
        ->where('lgm_status','active')
        ->get();
        
        $silverSponsor = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('lgm_type','image')
        ->where('lgm_caption','Silver Sponsor')
        ->where('lgm_status','active')
        ->get();
        
        $videoData = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('lgm_type','video')
        ->where('lgm_caption','Youtube Video')
        ->where('lgm_status','active')
        ->first();
        
        $spkData = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('lgm_type','image')
        ->where('lgm_caption','Speaker')
        ->where('lgm_status','active')
        ->get();
        
        
        $agendaDate=array();
        $agenda=array();
        $age=array();
        
        $sqlagendaDate="SELECT Distinct DATE_FORMAT(lccs_start_datewtime, '%Y-%m-%d') as date  FROM 1_live_career_counseling_sessions
        WHERE lccs_status = 'active' and aem_id='".$selectedEvent->aem_id."'
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
              group by lccss.lccs_id) as spk on `spk`.`lccs_id` = `lccs`.`lccs_id` where aem_id='".$selectedEvent->aem_id."' 
              and `lccs`.`lccs_status` = 'active'  and lccs.lccs_start_datewtime LIKE '%".$date->date."%'  ";
        
        $agenda = DB::select($sqlagenda);
        $age[$date->date]=$agenda;
              
      }

        $respReq['dateWiseAgenda']=  $age;
        
        
        
        
        $bannerImg = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('lgm_type','image')
        ->where('lgm_caption','Banner')
        ->where('lgm_status','active')
        ->get();
        
        $milestoneImg = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('lgm_type','image')
        ->where('lgm_caption','Milestone')
        ->where('lgm_status','active')
        ->get();
        
        $sponsorBgImg = DB::table('1_lpage_gallery_master')
        ->where('aem_id',$selectedEvent->aem_id)
        // ->where('tm_id',base64_decode(request('template')))
        ->where('lgm_type','image')
        ->where('lgm_caption','Sponsor Bg-Image')
        ->where('lgm_status','active')
        ->get();
        
        $sectionData = DB::table('1_section_master')
                    ->where('sm_status','active')
                    ->get();
                    
        $sectionMapData = DB::table('1_section_master_mapping')
                    ->where('aem_id',$selectedEvent->aem_id)
                    // ->where('tm_id',base64_decode(request('template')))
                    ->get();
                    
        $sectionIsEnabled = DB::table('1_section_master_mapping as smm')
                    ->leftJoin('1_section_master as sm','smm.sm_id','sm.sm_id')
                    ->where('aem_id',$selectedEvent->aem_id)
                    // ->where('tm_id',base64_decode(request('template')))
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
        
        $templateData = DB::table('1_template_master')
                    // ->where('aem_id',$selectedEvent->aem_id)
                    ->where('tm_status','active')
                    ->get();
        
    //  dd($data);
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
        'customFields'=>$customFields,
        'templateData'=>$templateData
        
        ]);
    }
    
    public function logoUpload(Request $request){
        
        $selectedEvent=Session('selectedEvent');
        
        if (isset($_POST['uploadlogo'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'logo-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                  mkdir($folderPath, 0777, true);
                //   dd($folderPath);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
                
                $data['logo_image']=$image_url;
            }
        }

        if (isset($_POST['uploadlogoFoo'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'logoFoo-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath, 0777, true);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
                
                $data['logo_foo_image']=$image_url;
            }
        }
        
        if (isset($_POST['socialMedia'])) {
            
            $data['facebook']= request('facebook');
            
            $data['instagram']= request('instagram');
            
            $data['twitter']= request('twitter');
        }
        
        
            
            $data['aem_id']= $selectedEvent->aem_id;
            
            // $data['tm_id']=base64_decode(request('template'));
            
            $check = DB::table('1_cms_master')
                ->where('aem_id',$selectedEvent->aem_id)
                // ->where('tm_id',base64_decode(request('template')))
                ->first();
                
            if($check !== null){
                $insert = DB::table('1_cms_master')->where('aem_id',$selectedEvent->aem_id)
                // ->where('tm_id',base64_decode(request('template')))
                ->update($data);    
            }else{
                $insert = DB::table('1_cms_master')->insert($data);
            }
            
            return Redirect::back();

    }
    
    
    public function photoUpload(Request $request){
        
        $selectedEvent=Session('selectedEvent');
        
        if (isset($_POST['uploadphoto'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'gallery-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath, 0777, true);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
                
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='gallery';
            }
        }

        if (isset($_POST['uploadgSponsor'])) {
            
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'gSpon-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath, 0777, true);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
                
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Gold Sponsor';
            }
        }

        if (isset($_POST['uploadsSponsor'])) {
            
            if(!null==request('croppedImage')){
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'sSpon-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath, 0777, true);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
                
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Silver Sponsor';
            }
        }
        
        if (isset($_POST['uploadvideo'])) {
            
            $check = DB::table('1_lpage_gallery_master')
                    ->where('aem_id',$selectedEvent->aem_id)
                    // ->where('tm_id',base64_decode(request('template')))
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
            
            // $destinationPath = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'; // upload path

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
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'spk-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath, 0777, true);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
                
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
                    // ->where('tm_id',base64_decode(request('template')))
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
            
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'banner-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath, 0777, true);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
    
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Banner';
                
            }
            
            
        }
        
        
        if (isset($_POST['uploadMile'])) {
            
            if(!null==request('croppedImage')){
            
            $check = DB::table('1_lpage_gallery_master')
                    ->where('aem_id',$selectedEvent->aem_id)
                    // ->where('tm_id',base64_decode(request('template')))
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
                
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'milestone-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath, 0777, true);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
    
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Milestone';
            
            }
            
        }
        
        
        if (isset($_POST['uploadSpon'])) {
            
            if(!null==request('croppedImage')){
            
            $check = DB::table('1_lpage_gallery_master')
                    ->where('aem_id',$selectedEvent->aem_id)
                    // ->where('tm_id',base64_decode(request('template')))
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
                
                $folderPath = public_path('assets/images/eventImg/'.$selectedEvent->aem_id.'/');
 
                $image_parts = explode(";base64,", request('croppedImage'));
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
         
                $imageName = 'sponBg-'.date('YmdHis') . ".png";
         
                $imageFullPath = $folderPath.$imageName;
                
                if (!is_dir($folderPath)) {
                    // dd('does not exist');
                  mkdir($folderPath, 0777, true);
                }
         
                file_put_contents($imageFullPath, $image_base64);
                
                $image_url = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'.$imageName;
    
                $data['lgm_name']=$image_url;
                $data['lgm_type']='image';
                $data['lgm_caption']='Sponsor Bg-Image';
                
            }
            
        }

        




            
            $data['aem_id']= $selectedEvent->aem_id;
            
            // $data['tm_id']=base64_decode(request('template'));
            
            
            $insert = DB::table('1_lpage_gallery_master')->insert($data);
            
            return Redirect::back();

    }


public function removegalleryitem(){
    
    $validator = Validator::make(['lgm_id' => request('lgm_id')],[
                        'lgm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $selectedEvent=Session('selectedEvent');
        
            $update = DB::table('1_lpage_gallery_master')->where('aem_id',$selectedEvent->aem_id)->where('lgm_id',request('lgm_id'))->update(array(
                'lgm_status'=>'inactive'
                )); 
        }
        
    }
    
    
    public function Addcms(){

        $selectedEvent=Session('selectedEvent');

        $data  = array();
        
        $data['aem_id']= $selectedEvent->aem_id;
        // $data['tm_id']= base64_decode(request('template'));
        
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
                // ->where('tm_id',base64_decode(request('template')))
                ->first();
                
        if($check !== null){
            $insert = DB::table('1_cms_master')->where('aem_id',$selectedEvent->aem_id)
            // ->where('tm_id',base64_decode(request('template')))
            ->update($data);    
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
        
        
                           
                          
    
                    $insert=DB:: table('1_live_career_counseling_sessions')
                    ->insertGetId(
                        array(
                            'aem_id'=>$selectedEvent->aem_id,
                            'lccs_name'=>request('name'),
                            'lccs_type'=>request('type'),
                            'lccs_sub_title'=>request('sub_title'),
                            'lccs_start_datewtime'=>request('picker3'),
                            'lccs_end_datewtime'=>request('enddate'),
                        )
                    );

        

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
						    $destinationPath = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'; // upload path        
                          $profileImage = date('YmdHis') . "-".$j."." . request("spic-$j")->getClientOriginalExtension();
                          $success = request("spic-$j")->move(public_path($destinationPath), $profileImage);  
							    
								 $insrtarray['lccss_pic']=$destinationPath.$profileImage;
							}
                                 DB::table('1_live_career_counseling_sessions_speaker')->insert($insrtarray);

						}	
                 
         return "true";

        }
        
    public function editcareersessions(){
    
        $validator = Validator::make(['lccs_id' => request('lccs_id')],[
                            'lccs_id' => 'required|numeric'
                        ]);
                        
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
    
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
    }
        
        
    public function updatecareersessions(){
    
        $selectedEvent=Session('selectedEvent');
        $moderatorImage="";
        $hostImage="";
        $sbannerImage="";
          
        
          
      $insertData=DB::table('1_live_career_counseling_sessions')
                    ->where('lccs_id',request('lccs_id'))
                    ->update(
                          array( 
                                'aem_id'=>$selectedEvent->aem_id, 
                                // 'tm_id'=>base64_decode(request('template')),               
                                'lccs_name'=>request('e_name'),
                                // 'lccs_speaker_name'=>request('es_name'),
                                'lccs_type'=>request('e_type'),
                                'lccs_sub_title'=>request('e_sub_title'),
                                'lccs_start_datewtime'=>request('e_startdates'),
                                'lccs_end_datewtime'=>request('e_enddate'),
                              )
                        );
                        
                        
            
         

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
				  
					    $destinationPath = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'; // upload path        
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
					    $new_destinationPath = 'assets/images/eventImg/'.$selectedEvent->aem_id.'/'; // upload path        
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
        
        $validator = Validator::make(['lccss_id' => request('del_id')],[
                            'lccss_id' => 'required|numeric'
                        ]);
                        
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            DB::table('1_live_career_counseling_sessions_speaker')->where('lccss_id',request('del_id'))->update(array('lccss_status'=>'inactive'));
        }
    }
    
    
    public function deletecareersessions(){
        
        $validator = Validator::make(['lccs_id' => request('lccs_id')],[
                            'lccs_id' => 'required|numeric'
                        ]);
                        
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            DB::table('1_live_career_counseling_sessions')->where('lccs_id',request('lccs_id'))->update(array('lccs_status'=>'inactive'));
        }
    }

    public function sectionToggle(){
    
        $selectedEvent=Session('selectedEvent');
        
        $validator = Validator::make(['sm_id' => request('sm_id'),'status'=>request('reqText')],[
                        'sm_id' => 'required|numeric',
                        'status'=>'required'
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
        
        $check = DB::table('1_section_master_mapping')
                ->where('aem_id',$selectedEvent->aem_id)
                // ->where('tm_id',base64_decode(request('template')))
                ->where('sm_id',request('sm_id'))
                ->first();
                
        // dd($check);
  
        $data['sm_id']=request('sm_id');
        $data['aem_id']=$selectedEvent->aem_id;
        // $data['tm_id']=base64_decode(request('template'));
        $data['smm_status']=request('reqText');
  
        if($check !== null){
                $insert = DB::table('1_section_master_mapping')
                ->where('aem_id',$selectedEvent->aem_id)
                // ->where('tm_id',base64_decode(request('template')))
                ->where('sm_id',request('sm_id'))
                ->update($data);    
            }else{
                $insert = DB::table('1_section_master_mapping')->insert($data);
            }
        
        return 'success';
        }

    }
    
    
    public function manageRegistration(){
        $selectedEvent=Session('selectedEvent');
        
        $commonFields = DB::table('1_registration_field_master')
                    ->where('rfm_status','active')
                    ->get();
                    
        $commonFieldsMapp = DB::table('1_registration_field_master_mapping')
                    ->where('aem_id',$selectedEvent->aem_id)
                    // ->where('tm_id',base64_decode(request('template')))
                    ->get();
                    
        $customFields = DB::table('1_registration_field_custom')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->get();
        
        $fieldType = DB::table('1_registration_field_type')
                    ->where('rft_status','active')
                    ->get();
        
        return view('lpage.manage-registration-page',[
            'selectedEvent'=>$selectedEvent,
            'commonFields'=>$commonFields,
            'commonFieldsMapp'=>$commonFieldsMapp,
            'customFields'=>$customFields,
            'fieldType'=>$fieldType
            
            ]);
    }
    
    
    
    public function fieldToggle(){
    
        $selectedEvent=Session('selectedEvent');
        
        $validator = Validator::make(['rfm_id' => request('rfm_id'),'status'=>request('reqText')],[
                        'rfm_id' => 'required|numeric',
                        'status'=>'required'
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
        
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
                // ->where('tm_id',base64_decode(request('template')))
                ->where('rfm_id',request('rfm_id'))
                ->update($data);    
            }else{
                $insert = DB::table('1_registration_field_master_mapping')->insert($data);
            }
        
        return 'success';
        }

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
        
        $validator = Validator::make(['rfc_id' => request('rfc_id'),'status'=>request('reqText')],[
                        'rfc_id' => 'required|numeric',
                        'status' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $update = DB::table('1_registration_field_custom')->where('aem_id',$selectedEvent->aem_id)->where('rfc_id',request('rfc_id'))->update(array(
                request('reqColumn')=>request('reqText')
                ));   
        }
    }


public function cfEdit(){
    
    $selectedEvent=Session('selectedEvent');
    
    $validator = Validator::make(['rfc_id' => request('rfc_id')],[
                        'rfc_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
    
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
        
        $fieldType = DB::table('1_registration_field_type')
                    ->where('rft_status','active')
                    ->get();
            
            return view('lpage.editcustomfields',[
                  'commonFields'=>$commonFields,
                  'commonFieldsMapp'=>$commonFieldsMapp,
                  'cust'=>$customFields,
                  'fieldType'=>$fieldType
              ]);
        }
    }
        
public function cfEditOpt(){
    
    $selectedEvent=Session('selectedEvent');
    
    $validator = Validator::make(['rfc_id' => request('rfc_id')],[
                        'rfc_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
                    
        $customFields = DB::table('1_registration_field_custom')
                    ->where('aem_id',$selectedEvent->aem_id)
                    ->where('rfc_id',request('rfc_id'))
                    ->first();
            
            return view('lpage.editcustomfieldsOpt',[
                  'cust'=>$customFields
              ]);
        }
}


public function setOrderBy(){
    $selectedEvent=Session('selectedEvent');
    
    $validator = Validator::make(['rfc_id' => request('rfc_id')],[
                        'rfc_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
    
    $update = DB::table('1_registration_field_custom')->where('aem_id',$selectedEvent->aem_id)->where('rfc_id',request('rfc_id'))->update(array(
                'rfc_orderby'=>request('orderVal')
                )); 
        }
    
}    

public function setTemplate(){
    
    $validator = Validator::make(['aem_id' => request('aem_id'),'tm_id'=>request('tm_id')],[
                        'bm_id' => 'required|numeric',
                        'tm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
    
    $update = DB::table('1_event_master')->where('aem_id',request('aem_id'))->update(array(
                'tm_id'=>request('tm_id')
                ));
                
                
    $resp=Array();
          $resp['code']='404';
          $sessDetails=Session('profileDetail');
    
        if(request('aem_id')){
    
              $eventid=request('aem_id');
              $allevent=false;
              if($eventid=='all'){
                 $allevent=true; 
              }
              Session::put('AllEvent', $allevent);
              ## Current : Event Detail #
              $evntDetail = EventMaster::where('aem_id', '=', request('aem_id'))
                 ->orderBy('aem_orderby', 'asc')
              ->first();
              if(isset($evntDetail)){
                  Session::put('selectedEvent', $evntDetail);
                  
                  $resp['code']='200'; 
                  $resp['data']= $evntDetail;
              }
            
        }
    }
    
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
          mkdir($folderPath, 0777, true);
        }
 
        file_put_contents($imageFullPath, $image_base64);
        
        dd($imageFullPath);
 
        //  $saveFile = new Picture;
        //  $saveFile->name = $imageName;
        //  $saveFile->save();
    
        // return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }
    
    public function ManageUnityContent(Request $request)
    {
        $A_Session = Session('A_Session');
        return view('customers.manage-unity-content.index',[ 'prefix_url' => $this->getBaseUrl,'bm_name'=>$A_Session->bm_nickname]);
    }
    
    public function managehomepagecontent(Request $request) 
    {
        
        $bcm_id = '';
        $tdetail=Session('tdetail');

        $profileDetail=Session('profileDetail');
        $eventDetails=Session('selectedEvent');
        $A_Session = Session('A_Session');
        $bm_id = Session('bm_id');

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
        }
        
        $hallImgBaseUrl = 'https://'.request()->getHost().config('app.rootFolder').'/admin/public';
        
        $leadList=DB::table('1_homepage_setting as ehc')
                    ->Select(
                        DB::raw('CONCAT("'.$hallImgBaseUrl.'", ehc.ehc_hall_bgimage) AS logo'),
                        DB::raw('CONCAT("'.$hallImgBaseUrl.'", ehc.hp_video) AS bg_video'),
                        'ehc.ehc_id','ehc.ehc_color_code','ehc.hp_type','ehc.hs_metaverse_name as meta_name')
                        ->where('bm_id',$bm_id);
                    
        $res=$leadList->paginate($paginate);
        
        return view('customers.manage-homepage.index',[
              'leadList'=>$res,
              'prefix_url' => $this->getBaseUrl,
              'bm_name'=>$A_Session->bm_nickname
        ]);
    }
        
    public function AddHomePageContent(Request $request) 
    {
        
            $setArray['ehc_color_code'] = request('egcolor');
            $setArray['hp_type'] = request('file_type');
            $setArray['hs_metaverse_name'] = request('meta_name');
            $bm_id = Session('bm_id');
            
            $validator = Validator::make(['egcolor' => request('egcolor'),'file_type' => request('file_type'),'meta_name' => request('meta_name')],[
                        'egcolor' => 'required',
                        'file_type' => 'required',
                        'meta_name' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $existData = DB::table('1_homepage_setting')->where('bm_id',$bm_id)->count();
        
            if(!null==request('upload_photo') && request('photoupload')=='photoupload'){
              
                    $pdfFileData=request('product_image');
                    $data = request('logoimage');
                    
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    
                    $data = base64_decode($data);
                    $imageNames= 'himage-'.date('Y-m-d').time().'.jpg';
                    $imagePath='/assets/images/homepage/';
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    $path = public_path() . $imagePath . $imageNames;
                    
                    file_put_contents($path, $data);
                    
                    $imageNames = $imagePath . $imageNames; //Added For Metaverse Access
                    
                    $setArray['ehc_hall_bgimage'] = $imageNames;
            }
            
            
            if(!null==request('egapplylink')){
              
                $videoUrl = request('egapplylink');
                
                $vidName= 'video-'.date('Y-m-d').time().'.mp4';
                $vidPath='/assets/images/homepage/';
                $path = public_path() . $vidPath . $vidName;
                
                File::makeDirectory(public_path() . $vidPath, 0777, true, true);
                $videoUrl->move(public_path($vidPath), $vidName);
                
                $videoUrl = $vidPath.$vidName; //Added For Access File From Metaverse
                
                $setArray['hp_video'] = $vidPath.$vidName;
            }
          
        
            if(!empty(request('ehc_id')))
            {
                DB::table('1_homepage_setting')
                    ->where('ehc_id',request('ehc_id'))
                    ->where('bm_id',$bm_id)
                    ->update(
                      $setArray
                    );
            }
            
            if($existData < 1)
            {
                $setArray['bm_id']=$bm_id;
                $bmId = DB::table('1_homepage_setting')->insertGetId($setArray);
            }
            
            $A_Session = Session('A_Session');
            if($A_Session->map_id)
            {
                DB::table('customer_data')->where('bm_id',$A_Session->bm_id)->where('map_id',$A_Session->map_id)->update(['is_published'=>'Y']);
            }
            
            return redirect($this->getBaseUrl.'/managehomepage');
        }
    }
    
    public function EditHomePageContent(Request $request)
    {
        $hallImgBaseUrl = '';
        $res = array();
        $bm_id = Session('bm_id');
        $validator = Validator::make(['ehc_id' => request('ehc_id')],[
                        'ehc_id' => 'required|numeric',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
            $list = DB::table('1_homepage_setting AS ehc')
                        ->Select('ehc.ehc_color_code','ehc.hp_type','ehc.hs_metaverse_name')
                        ->where('ehc.ehc_id',request('ehc_id'))
                        ->where('bm_id',$bm_id)->first();
            
            if($list)
            {
                $res['code'] = 200;
                $res['color_code'] = $list->ehc_color_code;
                $res['hp_type'] = $list->hp_type;
                $res['meta_name'] = $list->hs_metaverse_name;
            }
            else{
                $res['code'] = 404;
            }
        }
            
        echo json_encode($res);
        
    }
    
    public function ChooseTemplate(Request $requst)
    {
        $res = array();
        
        $A_Session = Session('A_Session');
        
        $filebaseUrl = 'https://'.request()->getHost().config('app.rootFolder').'/admin/public';
        
        $cuList = DB::table('1_environment_template_master as etm')
                  ->select('etm.*','cu.etm_id as eid',
                  DB::raw('CONCAT("'.$filebaseUrl.'", etm.etm_image) AS image'),
                  DB::raw('CONCAT("'.$filebaseUrl.'", etm.etm_video) AS video')
                  )
                  ->leftjoin("customer_data as cu",\DB::raw("FIND_IN_SET(etm.etm_id,cu.etm_ids)"),">",\DB::raw("'0'"))
                  ->where('bm_id',$A_Session->bm_id)->where('map_id',$A_Session->map_id)->get();
        
        return view('customers.choose-templates.index',[
              'cuList'=>$cuList,
              'prefix_url' => $this->getBaseUrl
        ]);
    }
    
    public function ActivateTemplate(){
      
        $A_Session = Session('A_Session');

        $ActiveStreamData=array();
       
        $ActiveStreamData['etm_id']= request('etm_id');
        
        $validator = Validator::make(['etm_id' => request('etm_id')],[
                        'etm_id' => 'required|numeric',
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {

        DB::table('customer_data')->where('bm_id',$A_Session->bm_id)->where('map_id',$A_Session->map_id)
              ->update(
                $ActiveStreamData
              );
        }
    }
    
    ## ----------------------- exhibitor_master -----------------------------------##
    public function exhibitor_master()
    {

            $tdetail=Session('tdetail');

            $profileDetail=Session('AprofileDetail');
            $eventDetails=Session('selectedEvent');
            
            $bm_id = Session('bm_id');
        
            $aem_id = 1;
            
            $paginate = 10;
            if (null !==(request('pagination'))){
                $paginate = request('pagination');
            }
            $searchText="";
            if (null !==(request('search_text'))){
                $searchText = request('search_text');
            }
            
            $booth_type = '';
            if (null !==(request('booth_type'))){
                $booth_type = request('booth_type');
            }
            
            $etd_id = '';
            if (null !==(request('hall_cat_id'))){
                $etd_id = request('hall_cat_id');
            }

            $leadList=DB::table('1_exhibitor_master as em')
            ->join('1_exhibitor_boothstaff as ebs','em.exhim_id','ebs.exhim_id')
            ->leftJoin('1_exhibitor_profile_master as epmm', 'em.exhim_profile', 'epmm.epm_id')
            ->leftJoin(\DB::raw("(
                    SELECT 
                    eems.*,
                    ehc.ehc_name,
                    ehc.ehc_hall_name,
                    
                   
                    count(eewbm.eem_id) as 'counselor'
                    FROM 
                            1_exhibitor_event_mapping as eems
                   left Join 1_exhibitor_event_with_boothstaff_mapping as eewbm  ON eems.eem_id=eewbm.eem_id
                   left Join  `1_exhibitor_hall_category` as ehc ON ehc.ehc_id=eems.ehc_id
                   
                     
                     
                    WHERE eems.aem_id=$aem_id
                    group by eems.eem_id) as bsmm"),
                function ($join) {
                    $join->on('bsmm.exhim_id', '=', 'em.exhim_id');
                })
                
            ->leftJoin(\DB::raw("(
  
                SELECT
                  eem.`exhim_id`, 
                  GROUP_CONCAT(CONCAT('<li>',ehc.ehc_hall_name,' (', ehc.ehc_name, ')','</li>') SEPARATOR ' ' ) as 'selectedHallNames'
      
                  FROM 
                      `1_exhibitor_event_mapping` as eem
                  join `1_exhibitor_hall_category` as ehc ON  FIND_IN_SET(ehc.`ehc_id`, eem.`ehc_id`)
                  WHERE eem.aem_id=$aem_id
                  group by eem.exhim_id) as ehc"),
                      function ($join) {
                          $join->on('ehc.exhim_id', '=', 'em.exhim_id');
              })
              
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
              
              ->leftJoin(\DB::raw("(
  
                SELECT 
                  em.`exhim_id`, 
                  GROUP_CONCAT(CONCAT('<li>',pt.`pt_text`,'</a>') SEPARATOR ' ' ) as 'pt_text'
      
                  FROM 
                      `1_exhibitor_master` as em
                  join `1_project_type` as pt ON  FIND_IN_SET(pt.`pt_id`, em.`pt_id`)
                  WHERE 1
                  group by em.exhim_id) as ptot"),
                      function ($join) {
                          $join->on('ptot.exhim_id', '=', 'em.exhim_id');
              })
              
              ->leftJoin(\DB::raw("(
  
                SELECT 
                  em.`exhim_id`, 
                  GROUP_CONCAT(CONCAT('<li>',etd.`etd_name`,'</a>') SEPARATOR ' ' ) as 'door_name'
      
                  FROM 
                      `1_exhibitor_master` as em
                  join `1_environment_template_door_list` as etd ON  FIND_IN_SET(etd.`etd_id`, em.`etd_id`)
                  WHERE 1
                  group by em.exhim_id) as etdot"),
                      function ($join) {
                          $join->on('etdot.exhim_id', '=', 'em.exhim_id');
              })
              
            ->leftJoin('master_city as mc'  ,'em.cm_id','mc.cm_id')
            ->leftJoin('master_state as ms'  ,'em.sm_id','ms.sm_id')
            ->leftJoin('master_country as mco'  ,'em.counm_id','mco.counm_id')

            ->leftJoin('1_participation_plans_master as ppm' ,'ppm.ppm_id', 'bsmm.ppm_id');
            if(!empty($searchText)){
                  $leadList->where(function($query) use ($searchText) {
                      $query->orwhere('em.exhim_whatsapp','%'.$searchText.'%')
                          ->orwhere('em.exhim_organization_name','like','%'.$searchText.'%')
                          ->orwhere('ppm.ppm_text','like','%'.$searchText.'%')
                          ->orwhere('em.exhim_contact_us','like','%'.$searchText.'%')
                          ->orwhere('bsmm.ehc_hall_name','like','%'.$searchText.'%')
                          ->orwhere('ebs.ebm_login_user','like','%'.$searchText.'%')
                          ->orwhere('bsmm.ehc_name','like','%'.$searchText.'%');
                  });
            }
            
            
                
                
                
            
            $leadList->where('bsmm.aem_id',$aem_id);
            
            if(!empty($booth_type))
            {
               $leadList->where('bsmm.ppm_id',$booth_type); 
            }
            
            
            //$leadList->where('bsmm.ehc_id',1); //select only hall 1 data
            $leadList->where('em.bm_id',$bm_id);
            $leadList->select('mco.*','ebs.ebm_login_user','ot_name_ae','pt_text','door_name',
                    'ebm_login_pwd','bsmm.*','mc.cm_name','ms.sm_name','ehc.selectedHallNames','ppm.*','em.*','epmm.epm_text as epm_name');
            
            //$leadList->groupBy('em.exhim_id');
             $leadList->orderby('em.exhim_organization_name','asc');
            $res=$leadList->paginate($paginate);
            
            
            

            $category = DB::table('master_country')
            ->orderby('counm_orderby','asc')
            ->orderby('counm_name','asc')
            ->get();
            
            
            
            $plans = DB::table('1_participation_plans_master')
                        ->where('ppm_status','active')
                        ->orderby('ppm_orderby','asc')
                        ->orderby('ppm_text','asc')
                        ->get();
            #Exhibitor Hall Category#       
            $exhibitorHallCategory = DB::table('1_environment_template_door_list')
                        ->where('etd_status','active')
                        ->orderby('etd_id','asc')
                        ->orderby('etd_name','asc')
                        ->get();

        $industries = DB::table('1_industry_master')
                        ->where('im_status','active')
                        ->orderby('im_orderby','asc')
                        ->orderby('im_text','asc')
                        ->get();
                        
                $exhibitor_profiles = DB::table('1_exhibitor_profile_master')
                        ->where('epm_status','active')
                        ->orderby('epm_orderby','asc')
                        ->orderby('epm_text','asc')
                        ->get();
                        
            $productWithSubProductList = ComModel::getProductMasterWithMapping($aem_id);
                
            // $hall_list = DB::table('1_exhibitor_master as em')
            //             ->Join('1_exhibitor_event_mapping as eem','em.exhim_id','eem.exhim_id')
            //             ->Join('1_exhibitor_hall_category as ehc', 'eem.ehc_id','ehc.ehc_id')
            //             ->LeftJoin('1_participation_plans_master as ppm','eem.ppm_id','ppm.ppm_id')
            //             ->Select('ehc.ehc_hall_name','ppm.ppm_text',DB::raw('count(*) as total'))
            //             ->groupBy('eem.ehc_id')
            //             ->get();
            

            return view('customers.exhibitor-master',[
                  'leadList'=>$res,
                  'category'=>$category,
                  'plans'=>$plans,
                   'industries' => $industries,
                  'exhibitor_profiles' => $exhibitor_profiles,
                  'exhibitorHallCategory'=>$exhibitorHallCategory,
                  'productWithSubProductList' => $productWithSubProductList,
                  'prefix_url' => $this->getBaseUrl,
                  //'hall_list' => $hall_list,
                  'booth_type'=>$booth_type,
                  'etd_id'=>$etd_id,
                  'profile_detail'=>$profileDetail
            ]);
      
    }
    
    public function Addexhibitor(Request $request)
    {
          $tdetail=Session('tdetail');
          $pdetail=Session('profileDetail');
          $eventDetails=Session('selectedEvent');
          
          $bm_id = Session('bm_id');
          
          $sm_id = request('ex_sm_ids');
          $cm_id = request('ex_cm_ids');  
          
          $aem_id = 1;
          
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
			    $ppm_id_custom = $interestedIn;
				
			    ## ---Product master--- ##
				$interestedInCat=implode(',', $ppmIds);
				$ppm_id = $interestedInCat;
				
				## ---Product master mapping--- ##
				$interestedInSubCat=implode(',', $ppmmIds);
				$ppmm_id = $interestedInSubCat;
			}

            if(!empty(request('exhim_id'))){
                
                        $Getexhim_Id = DB::table('1_exhibitor_master')
                        ->where('exhim_id',request('exhim_id'))
                        ->update(
                              array( 
                                    'sm_id'=>$sm_id,
                                    'cm_id'=>$cm_id, 
                                    'counm_id'=>request('ex_country'),
                                    'exhim_organization_name'=>request('ex_name'),
                                    'exhim_contact_email'=>request('ex_email'),
                                    'exhim_contact_us'=>request('ex_phone'),
                                   // 'exhim_whatsapp'=>request('ex_whatsApp'),
                                    'exhim_address'=>request('ex_address'),
                                 
                                    'exhim_industry'=>request('industry'),
                                    'exhim_group'=>request('exhibitor_group'),
                                    'exhim_organisation_email'=>request('ex_organisation_email'),
                                    'contact_person_incharge' => request('ex_contact_person_incharge'),
                                    'exhim_designation' => request('ex_designation'),
                                    'office_phone_code' => request('ex_office_phone_code'),
                                    'office_contact_number' => request('ex_office_contact_number'),
                                    'fax_code' => request('ex_fax_code'),
                                    'fax_number' => request('ex_fax_number'),
                                    'ppm_id_custom' => isset($ppm_id_custom) ? $ppm_id_custom : '',
                                    'ppm_id' => isset($ppm_id) ? $ppm_id : '',
                                    'ppmm_id' => isset($ppmm_id) ? $ppmm_id : '',
                                    'etd_id' => implode(',',request('etd_ids')),
                                    'bm_id' => $bm_id
                                  )
                            );
                                 
                                
                         $checkIsExist = DB::table('1_exhibitor_event_mapping')
                            ->where('exhim_id',request('exhim_id'))
                            ->where('aem_id',$aem_id)
                            ->first();
                            
                       
                            $updateEem=array( 
                                /*'aem_id'=>$eventDetails->aem_id,*/
                                'exhim_id'=>request('exhim_id'),
                                'ppm_id'=>request('plan')
                               
                            );
                            
                            if(null!==request('exhiHallCategory')){
                             
                                $ehcId=implode(',', request('exhiHallCategory'));
                                $updateEem['ehc_id']=$ehcId;
                            }
                            
                            if(null!==request('custom_backtohall')){
                              $updateEem['eem_custom_backtohall']=request('custom_backtohall');
                            }
                            
                            if(null!==request('is_booth_list')){
                              $updateEem['eem_is_booth_list']=request('is_booth_list');
                            }else{
                              $updateEem['eem_is_booth_list']='N';
                            }
                            
                            if(null!==request('is_product_list')){
                              $updateEem['eem_is_product_list']=request('is_product_list');
                            }else {
                                 $updateEem['eem_is_product_list']='N';
                                if(null==request('is_booth_list')){
                                    $updateEem['eem_is_booth_list']='Y';
                                }
                            }
                            
                            if(!empty($checkIsExist)){   
                                
                                $update_eem = DB::table('1_exhibitor_event_mapping')
                                ->where('eem_id',$checkIsExist->eem_id)
                                ->update(
                                    $updateEem
                                );
                                
                            }else{
                                
                                $updateEem['aem_id']=$aem_id;
                                $insertData = DB::table('1_exhibitor_event_mapping')
                                ->insert( 
                                        $updateEem
                                    );
                            }
        
            }else {
              $sm_id = request('sm_id');
              $cm_id = request('cm_id');
              $check = DB::table('1_exhibitor_master')
                    ->where('exhim_contact_email',request('email'))
                    ->first();
                   
                    if ($check==true) {
                        return "exists";
                      }else{
                       
                     $ebm_login_pwd = rand(100000,999999);
                     $Getexhim_Id = DB::table('1_exhibitor_master')
                            ->insertGetId(
                                  array( 
                                        'sm_id'=>$sm_id,
                                        'cm_id'=>$cm_id,   
                                        'counm_id'=>request('country'),
                                        'exhim_organization_name'=>request('name'),
                                        'exhim_contact_email'=>request('email'),
                                        'exhim_contact_us'=>request('phone'),
                                        'exhim_whatsapp'=>request('whatsApp'),
                                        'exhim_address'=>request('address'),
                                        'exhim_profile'=>request('exhibitor_profile'),
                                        'exhim_industry'=>request('industry'),
                                        'exhim_group'=>request('exhibitor_group'),
                                        'exhim_organisation_email'=>request('organisation_email'),
                                        'contact_person_incharge' => request('contact_person_incharge'),
                                        'exhim_designation' => request('designation'),
                                        'office_phone_code' => request('office_phone_code'),
                                        'office_contact_number' => request('office_contact_number'),
                                        'fax_code' => request('fax_code'),
                                        'fax_number' => request('fax_number'),
                                        'ppm_id_custom' => isset($ppm_id_custom) ? $ppm_id_custom : '',
                                        'ppm_id' => isset($ppm_id) ? $ppm_id : '',
                                        'ppmm_id' => isset($ppmm_id) ? $ppmm_id : '',
                                        'bm_id' => $bm_id
                                      )
                                );
                                
                                $InsrtBootStaff = DB::table('1_exhibitor_boothstaff')
                            ->insertGetId(
                                  array( 
                                        'ebsm_name'=>request('name'),
                                        'ebsm_country_code'=>request('country_code'), 
                                        
                                        'ebsm_mobile'=>request('phone'),              
                                        'ebm_login_user'=>request('email'),
                                        'ebm_login_pwd'=>$ebm_login_pwd,
                                        'at_id'=>3,
                                        'exhim_id'=>$Getexhim_Id
                                      )
                                );
                                
                                
                    ## exhibitor profile transection ##

                     $exhabitorTransection = DB::table('1_exhibitor_profile_transection')

                            ->insertGetId(

                                  array( 
                                    'exid'=>$Getexhim_Id
                                      )

                                );           
                                
                    ## exhibitor event mapping ##
                            $insEem= array( 
                                'aem_id'=>$aem_id,
                                'ppm_id'=>request('plan'),
                                'ehc_id'=>request('exhiHallCategory'),
                                'exhim_id'=>$Getexhim_Id,
                                'eem_stall_number'=>$Getexhim_Id
                              );
                              
                            if(null!==request('is_booth_list')){
                              $insEem['eem_is_booth_list']=request('is_booth_list');
                            }else{
                              $insEem['eem_is_booth_list']='N';
                            }
                            
                            if(null!==request('is_product_list')){
                              $insEem['eem_is_product_list']=request('is_product_list');
                            }else{
                               $insEem['eem_is_product_list']='N';
                               if(null==request('is_booth_list')){
                                    $insEem['eem_is_booth_list']='Y';
                                }
                            }
                    
                    $insertData = DB::table('1_exhibitor_event_mapping')
                    ->insert( 
                            $insEem
                        );
                    }

                    $email_to = request('email');
                    $subject = 'Exhibitor Registration Confirmed: Virtual Wipro 2022';
                    
                    // Mail::send('datatables.exhibitor_email', ['organization_name'=>request('name'),
                    //     'email' => $email_to,
                    //     'password'=>$ebm_login_pwd],
                    //     function ($m) use ($email_to,$subject) {
                    //       $m->from('invitation@smartevents.in', 'Wipro');
                    //       $m->to($email_to)->subject($subject);
                    //     });

                    return 'Inserted';
            }
      }
      
      public function editexhibitor(){
        $tdetail=Session('tdetail');
        $profileDetail=Session('profileDetail');
        $eventDetails=Session('selectedEvent'); 
        $aem_id = 1;
        $exhim_id="";
        if(!empty(request('exhim_id'))){
          $exhim_id=request('exhim_id');
          $dataList =  DB::table('1_exhibitor_master as em')
                      ->leftJoin('1_exhibitor_event_mapping as eem' ,'em.exhim_id', 'eem.exhim_id' )
                      ->where('em.exhim_id',$exhim_id)
                      ->where('eem.aem_id',$aem_id)
                      ->select('em.*','eem.*')->first();

                      
          $id =  DB::table('1_exhibitor_master')->where('exhim_id',$exhim_id)->first();
          $categories = DB::table('master_country')->get();
          $subcategories = DB::table('master_city')
                    ->where("sm_id",$id->sm_id)
                    ->get();
                    
          $plan = DB::table('1_participation_plans_master')
                    ->where('ppm_status','active')
                    ->orderby('ppm_orderby','asc')
                    ->orderby('ppm_text','asc')
                    ->get();
         
         #Exhibitor Hall Category#       
        $exhibitorHallCategory = DB::table('1_exhibitor_hall_category')
                    ->where('ehc_status','active')
                    ->where('aem_id',$aem_id)
                    ->orderby('ehc_order','asc')
                    ->orderby('ehc_name','asc')
                    ->get();
         $industries = DB::table('1_industry_master')
                    ->where('im_status','active')
                    ->orderby('im_orderby','asc')
                    ->orderby('im_text','asc')
                    ->get();
                    
            $project_types = DB::table('1_project_type')
                    ->where('pt_status','active')
                    ->orderby('pt_orderby','asc')
                    ->orderby('pt_text','asc')
                    ->get();
                    
            $door_list = DB::table('1_environment_template_door_list')
                    ->where('etd_status','active')
                    ->orderby('etd_id','asc')
                    ->orderby('etd_name','asc')
                    ->get();
                    
            $exhibitor_profiles = DB::table('1_exhibitor_profile_master')
                    ->where('epm_status','active')
                    ->orderby('epm_orderby','asc')
                    ->orderby('epm_text','asc')
                    ->get();
                        
            $productWithSubProductList = ComModel::getProductMasterWithMapping($aem_id);

            
              return view('customers.editexhibitor',[
                'dataList'=>$dataList,
                'exhim_id'=>$exhim_id,
                'categories'=>$categories,
                'subcategories'=>$subcategories,
                'exhibitorHallCategory'=>$exhibitorHallCategory,
                'project_types'=>$project_types,
                'doors'=>$door_list,
                'id'=>$id,
                'plans'=>$plan,
                 'industries' => $industries,
                 'exhibitor_profiles' => $exhibitor_profiles,
                'prefix_url' => $this->getBaseUrl,
                'productWithSubProductList' => $productWithSubProductList
              ]);
        }

    }
    
    public function MySubscription(Request $request)
    {
        $bm_id = Session('bm_id');
        
        $custDetail = DB::table('customer_data')
                            ->select('pm_id')
                            ->where('bm_id',$bm_id)
                            ->first();
                            
        $pm_id = $custDetail->pm_id;
        
        $packageNameList = DB::table('1_package_master as pm')
                            ->select('pm_name','pm_id')
                            ->where('pm.pm_status','active')
                            ->get();
        
        $packageList = DB::table('1_package_master as pm')
                    ->join('1_package_user_master as pum','pum.pum_id','pm.pum_id')
                    ->join('1_package_video_master as pvm','pvm.pvm_id','pm.pvm_id')
                    ->join('1_package_access_master as pam','pam.pam_id','pm.pam_id')
                    ->leftJoin(\DB::raw("(
                            SELECT
                            pmm.`pm_id`,
                            GROUP_CONCAT(CONCAT('<li>',ppam.`ppam_name`,'</li>') SEPARATOR ' ' ) as 'ppam_name'
                            FROM 

                            `1_package_master` as pmm
                            join `1_package_platform_access_master` as ppam ON  FIND_IN_SET(ppam.`ppam_id`, pmm.`ppam_id`)

                          WHERE 1
            
                          group by pmm.pm_id) as pm2"),
            
                              function ($join) {
            
                                  $join->on('pm2.pm_id', '=', 'pm.pm_id');
                     })
                     
                    ->select('pm.*','pum.pum_name','pvm.pvm_name','pam.pam_name','ppam_name')
                    ->where('pm_status','active')
                    ->get();
                    
        
        $i=0;
        foreach($packageList as $detail)
        {
            
            $active = '<h3 class="text text-success">&#10003;</h3>';
            $inactive = '<h3 class="text text-danger">X</h3>';
            
            $res['No. Of Users'][$i]= $detail->pum_name;
            $res['Custom Landing Page'][$i]= $detail->pm_custom_landing_page=='yes' ? $active:$inactive;
            $res['Unique URL'][$i]= $detail->pm_unique_url=='yes' ? $active:$inactive;
            $res['Templates'][$i]= ucfirst($detail->pm_templates);
            $res['Branding & Personalized Content'][$i]= $detail->pm_branding_personalized_content=='yes' ? $active:$inactive;
            $res['Custom Avatars'][$i]= $detail->pm_custom_avatars=='yes' ? $active:$inactive;
            $res['NPCs'][$i]= $detail->pm_npc=='yes'? $active:$inactive;
            $res['Videos'][$i]= $detail->pvm_name;
            $res['Access'][$i]= $detail->pam_name;
            $res['Live Voice & Text Interactions'][$i]= $detail->pm_live_voice_text_interaction=='yes'? $active:$inactive;
            $res['Breakout rooms for one to one Interactions'][$i]= $detail->pm_breakout_room=='yes'? $active:$inactive;
            $res['Platforms'][$i]= $detail->ppam_name;
            $res['Analytics'][$i]= $detail->pm_analytics=='yes'? $active:$inactive;
            $res['Preferred Support'][$i]= $detail->pm_preferred_support=='yes'? $active:$inactive;
            $i++;
        }
        
        return view('customers.mysubscription',[
                'pData'=>$res,
                'pm_id'=>$pm_id,
                'packagenamelist'=>$packageNameList,
                'prefix_url' => $this->getBaseUrl,
              ]);
                    
        
    }
    
    public function UpgradePackage(Request $request)
    {
        $pm_id = request('pm_id');
        $bm_id = Session('bm_id');
        
        $validator = Validator::make(['pm_id'=>$pm_id],[
                        'pm_id'=>'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
            $packageDetails = DB::table('1_package_master')
                                ->where('pm_id',$pm_id)
                                ->first();
                                
            if($packageDetails)
            {
                $customerDetails = DB::table('customer_data as cd')
                                    ->Select('cd.*')
                                    ->where('cd.bm_id',$bm_id)
                                    ->first();
                                    
                DB::table('customer_package_mapping')->insertGetId([
                        'cd_id'=>$customerDetails->id,
                        'pm_id'=>$pm_id,
                        'cpm_amount'=>$packageDetails->pm_amount
                    ]);
                
                Session::put('userid',$customerDetails->id);
                Session::put('alreadypaid', 'no');   
        
                $res['redirect_link'] = './step-two';
                $res['code'] = 200;
            }
        }
        
        return json_encode($res);
        
    }
    
    
    public function ChoosePackagePlan(Request $request)
    {
        $custId=Session::get('userid');
        $brandData=Session::get('A_Session');
            
        if(empty($custId)){
            $url='https://'.request()->getHost().'/admin/'.$brandData->bm_nickname.'/mysubscription';
        	header("Location: $url");
        	exit;
        }
        
        $packageBuy=Db::table('customer_package_mapping')->where('cd_id',$custId)->first();
        
        $custDetail=DB::table('customer_data as cd')
                    ->where('cd.id',$custId)
                    ->first();
        
        $packageDetail = DB::table('1_package_master as pm')
                            ->select('pm.*')
                            ->where('pm.pm_id',$packageBuy->pm_id)
                            ->first();
        
        return view('customers.payment.step-two',['custDetail'=>$custDetail, 'packageDetail'=>$packageDetail]);
    }
    
    public function SavePackagePlan(Request $request)
    {
        
        $pm_id = request('pmid');
        $custId=Session::get('userid');
        
        $getpackage=DB::table('customer_package_mapping')->where('cd_id',$custId)->where('pm_id',$pm_id)->first();
        
        if($getpackage)
        {
            $DeletePackage=DB::table('customer_package_mapping')->where('cd_id',$custId)->where('pm_id',$pm_id)->delete();
        }
        
        $Insertpass=DB::table('customer_package_mapping')->insert(array('cd_id'=>$custId,'pm_id'=>$pm_id,'cpm_amount'=>request('amount-'.$pm_id)));
        
       $res['code']=200;
       $res['redirect_link'] = './verify';
     
       return json_encode($res);
    }
    
    
    public function VerifyPackagePlan()
    {
	     
	    $custId=Session::get('userid');
	   
        if(empty($custId)){

            $url='https://'.request()->getHost().'/registration';
    	    header("Location: $url");
    	    exit;
        }

        $AllEvent=DB::table('1_event_master')->where('aem_status','!=','old')->get();
        
        $packages=DB::table('customer_data as cd')
                ->join('brand_organizer_master as bm','cd.bm_id','bm.bm_id')
                ->join('customer_package_mapping as cpm','cpm.cd_id','cd.id')
            	->join('1_package_master as pm','cpm.pm_id','pm.pm_id')
            	->join('master_countries as mc','cd.cd_country_code','mc.counm_code')
            	->select('cd.*','pm.pm_amount','bm.bm_nickname as brand_name','mc.counm_name','mc.counm_code')
            	->where('cd.id',$custId)
            	->first();
        	
        if(!isset($packages)){
            return redirect()->back();
            exit;
        }
      
        
        # $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 10).'~'.$custId;
                
                
        $discount=0;
		$gst=0;
		 if($packages->counm_name=='India'){
            $gst=18;
        }
		
		$chargeable_amount=0;
		$gst_amount=0;
		$discount_amount=0;
		$TotalAmount=0;
		$TotalADAmount=0;
        // $chargeable_amount=$rtemid->rtem_amont;
        
        $chargeable_amount=$chargeable_amount+$packages->pm_amount;
                    
                    
        // $chargeable_amount=$userFees->user_fee;
        
        ## Calculate Discount Amount ##
        $discount_amount=($chargeable_amount*$discount)/100;
        $TotalADAmount=$chargeable_amount-$discount_amount;
        ## Calculate GST Amount ##
        $gst_amount=($TotalADAmount*$gst)/100;
        
        ## Calculate Final Amount ##
        $TotalAmount=$TotalADAmount+$gst_amount;
         
        $paymentPayload=array();
        $hashData=array();
        
        $groupQtyIds=$custId;
        $groupQtyCount=1;
     
	    $paymentPayload['userids']=$custId;
	    
	    $paymentPayload['group_qty_ids']=$groupQtyIds;
        $paymentPayload['group_qty_count']=$groupQtyCount;
	            
        $paymentPayload['type']='customer';
        $paymentPayload['chargeable_amount']=$chargeable_amount;
        $paymentPayload['discount']=$discount;
        $paymentPayload['discount_amount']=$discount_amount;
        $paymentPayload['gst']=$gst;
        $paymentPayload['gst_amount']=$gst_amount;
		$paymentPayload['amount']=$TotalAmount;

        $paymentPayload['redirect']='no';
                
        $name = trim($packages->cd_full_name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );

        $paymentPayload['firstname']=$first_name;
        $paymentPayload['email']=$packages->cd_email;
        $paymentPayload['phone']=$packages->cd_mobile;
        $paymentPayload['productinfo']='MEGASPACE PACKAGE UPGRADE';
        $paymentPayload['lastname']=$last_name;
        $paymentPayload['address1']=$packages->cd_company_name;
        $paymentPayload['address2']='';
        $paymentPayload['city']=$packages->cd_company_name;
        $paymentPayload['state']='';
        $paymentPayload['country']=$packages->counm_name;
        $paymentPayload['zipcode']='';
        $paymentPayload['txnid']=$txnid;
        $paymentPayload['udf1']='MEGASPACE PACKAGE UPGRADE';
        $paymentPayload['udf2']=$packages->cd_email;
        $paymentPayload['udf3']=$packages->cd_mobile;
        $paymentPayload['udf4']=$packages->cd_company_name;
        $paymentPayload['udf5']=$txnid;
        $paymentPayload['surl']='https://'.request()->getHost().'/admin/'.$packages->brand_name.'/mysubscription/response';
        $paymentPayload['furl']='https://'.request()->getHost().'/admin/'.$packages->brand_name.'/mysubscription/response';
        $paymentPayload['service_provider']='STRIPE';
               
        Session::put('txnid',$paymentPayload['txnid']);
                
        $itemsArray['price']=$packages->pm_amount;
        $itemsArray['quantity']=1;
        if($packages->counm_name=='India'){
            $itemsArray['price']=$packages->pm_amount;
            $itemsArray['quantity']=1;
            $itemsArray['tax_rates']=array('txr_1NpnoOSJaol54vvFztwFj05H');
        }
        
        //dd($itemsArray);
              
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $checkout_session = \Stripe\Checkout\Session::create([
           'payment_method_types' => ['card'],
           'line_items' => [$itemsArray,],
           'mode' => 'payment',
           'allow_promotion_codes' => true,
           'success_url' =>  $paymentPayload['surl'],
           'cancel_url' => $paymentPayload['furl'],
         ]);

                
        $paymentPayload['action']=$checkout_session->url;
        
        // $paymentPayload['action']='stripepayment';
        $TransactionIds=AdminController::insertpackagetransactionlog($paymentPayload);
        $paymentPayload['tpl_id'] =$TransactionIds['tpl_id'];
        $paymentPayload['ptd_id'] =$TransactionIds['ptd_id'];
        
        
        $response_log = $checkout_session->toArray();
        $response_log = print_r($response_log,true);
        
        
        Session::put('checkoutid', $checkout_session->id);
                
        DB::table('1_package_transaction_log')->where('txnid',$txnid)->update(['response_log'=>$response_log]);
  
        return view('customers.payment.verify',['paymentPayload'=>$paymentPayload,'passes'=>$packages]);
      
    }
    
    
    public static function insertpackagetransactionlog($paymentPayload){

        $returnArray=array();
        $request_log = print_r($paymentPayload, true);
        $ptlSqlAppend="";
        $pdtSqlAppend="";
        
        if(isset($paymentPayload['response_verify_txn_status']) && !empty($paymentPayload['response_verify_txn_status'])){
            $ptlSqlAppend .=" , response_verify_txn_status='".$paymentPayload['response_verify_txn_status']."'";
        }
        if(isset($paymentPayload['status']) && !empty($paymentPayload['status'])){
            $pdtSqlAppend .=" ,status='".$paymentPayload['status']."'";
        }
        if(isset($paymentPayload['error_Message']) && !empty($paymentPayload['error_Message'])){
            $pdtSqlAppend .=" ,error_Message='".$paymentPayload['error_Message']."'";
        }
        if(isset($paymentPayload['productinfo']) && !empty($paymentPayload['productinfo'])){
            $pdtSqlAppend .=" ,productinfo='".$paymentPayload['productinfo']."'";
        }
        
        if(isset($paymentPayload['msmids']) && !empty($paymentPayload['msmids'])){
            $pdtSqlAppend .=" ,msmids='".$paymentPayload['msmids']."'";
        }
        
         $sql="insert into 1_package_transaction_log
                set
                txnid='".$paymentPayload['txnid']."',
                request_log='".$request_log."'
				$ptlSqlAppend
				";

        $inserttplId=DB::insert($sql);
        $tpl_id = DB::getPdo()->lastInsertId();


        $sqlpl="insert into 1_package_transaction_details
                set
                userids='".$paymentPayload['userids']."',aem_id='1',
                 group_qty_ids='".$paymentPayload['group_qty_ids']."',
                group_qty_count='".$paymentPayload['group_qty_count']."',
                txnid='".$paymentPayload['txnid']."',status='cancelled'
				$pdtSqlAppend
				";
        $insertpl=DB::insert($sqlpl);
        $ptd_id = DB::getPdo()->lastInsertId();

        $returnArray['tpl_id']=$tpl_id;
        $returnArray['ptd_id']=$ptd_id;

        return $returnArray;
    } 
    
    public function SelfieWall(Request $request)
    {
                
        $today=date('Y-m-d');
        $bm_id = Session('bm_id');
                    
        $selfieurl='https://'.request()->getHost().config('app.rootFolder').'/admin/';

        $datefrom="";
        $dateto="";
        if(!empty(request('datefrom'))){
            $datefrom = date('Y-m-d',strtotime(request('datefrom')));
        }
        if(!empty(request('dateto'))){
             $dateto = date('Y-m-d',strtotime(request('dateto')));
        }
                    
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
        }
                                        
        $SelfieUploaded = DB::table('1_selfie_wall as sf')
                            ->Join('1_lead_event_master_mapping as lemm' ,'sf.lemm_id', 'lemm.lemm_id')
                            ->Join('1_lead_master as lm' ,'lm.lm_id', 'lemm.lm_id');
                            
                            
        if (!empty($datefrom) &&  empty($dateto) ){
            $SelfieUploaded->whereDate('sf.sf_insert_time','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $SelfieUploaded->whereDate('sf.sf_insert_time','>=', $datefrom)->whereDate('sf.sf_insert_time','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $SelfieUploaded->whereDate('sf.sf_insert_time','>=', $datefrom);
        }
                            
        $TotalSelfieUploaded = $SelfieUploaded->where('sf.bm_id',$bm_id)->count();
                            
        //dd($TotalSelfieUploaded);
                
        $selfieData = DB::table('1_selfie_wall as sf')
                    ->Join('1_lead_event_master_mapping as lemm' ,'sf.lemm_id', 'lemm.lemm_id')
                    ->Join('1_lead_master as lm' ,'lm.lm_id', 'lemm.lm_id')
                    ->Select('lm.lm_firstname','lm.lm_lastname','lm.lm_fullname','lm.lm_email',DB::raw('CONCAT("'.$selfieurl.'", sf.sf_name) AS selfie_url'),'sf.sf_insert_time')
                    ->where('sf.bm_id',$bm_id);
        
        if(!empty($searchText)){
              $selfieData->where(function($query) use ($searchText) {
                  $query->orwhere('lm.lm_email',$searchText)
                      ->orwhere('lm.lm_lastname','like','%'.$searchText.'%')
                      ->orwhere('lm.lm_firstname','like','%'.$searchText.'%')
                      ->orwhere('lm.lm_fullname','like','%'.$searchText.'%');
              });
        }
        
        if (!empty($datefrom) &&  empty($dateto) ){
            $selfieData->whereDate('sf.sf_insert_time','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $selfieData->whereDate('sf.sf_insert_time','>=', $datefrom)->whereDate('sf.sf_insert_time','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $selfieData->whereDate('sf.sf_insert_time','>=', $datefrom);
        }
                                
        $selfieData = $selfieData->orderBy('sf.sf_id','desc');
                    
        $res=$selfieData ->paginate($paginate);
        
        
        return view('customers.selfie-wall.index',[
            'leadlist'=>$res,
            'TotalSelfieUploaded'=>$TotalSelfieUploaded,
            'datefrom'=>request('datefrom'),
            'dateto'=>request('dateto')
        ]);
        
    }
    
    
    ## Manage Launch Events ##
    public function ManageEvents()
    {
        $bm_id = Session('bm_id');
        $eventLaunch = DB::table('1_event_launch as el')
                        ->leftJoin('1_event_launch_mapping as elm', function($leftJoin)use($bm_id)
                        {
                            $leftJoin->on('el.el_id', '=', 'elm.el_id')
                            ->where('elm.bm_id', '=', $bm_id );
                        })
                        ->Select('el.*','el.el_id as elId','elm.*')
                        ->orderBy('el.el_id','asc')
                        ->get();
        
        return view('customers.manage-events.events',[
              'eventLaunch'=>$eventLaunch
        ]);
      
    }        
            
    public function LaunchEvent(Request $request)
    {
        $notifyText=array();
        
        $selectedEvent=Session('A_Session');
        
        $streamData = DB::table('1_event_launch as el')
                        ->join('1_event_launch_mapping as elm','elm.el_id','el.el_id')
                        ->select('el.*','elm.elm_youtube_url','elm.elm_daily_co_url as daily_url','elm.elm_active_url','elm.bm_id')
                        ->where('elm.elm_id',request('elmId'))
                        ->where('elm.bm_id',$selectedEvent->bm_id)
                        ->first();
        if($streamData)
        {
            $elm_status = request('elmStatus')=='active' ? 'inactive' : 'active';
            
            $notifyText['is_start'] = request('elmStatus')=='inactive'?'yes':'no';
            $notifyText['brand_name'] = $selectedEvent->bm_nickname;
            $notifyText['event_start'] = $streamData->elm_active_url;
            
            if($streamData->elm_active_url=='daily-co')
            {
                 $notifyText['daily_co_url'] = $streamData->daily_url;
            }
            else
            {
                $notifyText['youtube_url'] = $streamData->elm_youtube_url;
            }
            
            $notifyTextMsg=json_encode($notifyText, true);
           
            $options = array(
                            'cluster' => env('PUSHER_APP_CLUSTER'),
                            'encrypted' => true
                            );
            $pusher = new Pusher(
                                env('PUSHER_APP_KEY'),
                                env('PUSHER_APP_SECRET'),
                                env('PUSHER_APP_ID'), 
                                $options
                            );
                            
            $triggerEvent = $streamData->el_notify_name;
            $data['message'] = $notifyTextMsg;
            
            $pusher->trigger($triggerEvent, 'App\\Events\\Notify', $data);
            DB::table('1_event_launch_mapping')->where('elm_id',request('elmId'))->update(['elm_start_date'=>date('Y-m-d H:i:s'),'elm_status'=>$elm_status]);
            
            $res['code']=200;
            $res['notify-event']=$streamData->el_notify_name;
        }
        else
        {
            $res['code']=404;
        }
        
        return json_encode($res);
    }
    
    public function AddEventLaunch()
    {
        $insertPosterData = array();
        $bm_id = Session('bm_id');
        
        if(!empty(request('elm_youtube_url')))
        {
           $insertPosterData['elm_youtube_url']=request('elm_youtube_url'); 
        }
        
        if(!empty(request('elm_daily_co_url')))
        {
           $insertPosterData['elm_daily_co_url']=request('elm_daily_co_url'); 
        }
        
        if(!empty(request('elm_daily_co_name')))
        {
           $insertPosterData['elm_daily_co_name']=request('elm_daily_co_name'); 
        }
        
        ## End : poster Insert ##
        if(!null==request('elm_id') && !empty($insertPosterData)){
        
            DB::table('1_event_launch_mapping')
                ->where('elm_id',request('elm_id'))
                ->where('bm_id',$bm_id)
                ->update(
                    $insertPosterData
                );
                
            $res['code']=200;
            $res['msg']='updated';
        }
        else
        {
            $insertPosterData['bm_id']=$bm_id;
            $insertPosterData['el_id']=request('el_id');
            DB::table('1_event_launch_mapping')->insertGetId($insertPosterData);
            
            $res['code']=200;
            $res['msg']='Added';
        }
        return json_encode($res);
    }
    
    public function EditEventLaunch()
    {
        $bm_id = Session('bm_id');
          
        $elm_id=request('elm_id');
        $el_id=request('el_id');
        
        $dataList =  DB::table('1_event_launch as el')
            ->leftJoin('1_event_launch_mapping as elm', 'elm.el_id','el.el_id')
            ->where('el.el_id',$el_id)
            ->where('elm.elm_id',$elm_id)
            ->where('elm.bm_id',$bm_id)
            ->select('el.*','el.el_id as elId','elm.*')
            ->first();
        
        return view('customers.manage-events.edit_event_launch',[
            'elId'=>$el_id,
            'dataList'=>$dataList
        ]);
    }
    
    public function ActivateStreamVideo(Request $request)
    {
       $ActiveStreamData=array();
       
        $ActiveStreamData['elm_active_url']= request('el_active_url');
        
        $validator = Validator::make(['el_active_url' => request('el_active_url'),'elm_id' => request('elm_id')], [
                        'el_active_url' => 'required',
                        'elm_id'=>'required'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            DB::table('1_event_launch_mapping')
              ->where('elm_id',request('elm_id'))
              ->update($ActiveStreamData);
        }
    }
    
    public function GenerateMeetingLink(Request $request)
    {
        $sessData=Session('A_Session');
        $bmName = $sessData->bm_nickname;
        
        $random_name = rand(100000, 999999);
        
        $name=$bmName.$random_name;
       
        /* Create Room Meta */
        $Room = array(
            
            "properties" => array(
                "max_participants" => "10",
                //"enable_chat"=>true,
                "autojoin"=>true,
                "owner_only_broadcast"=>true,
                "enable_screenshare"=>true,
                
            ),
            "name" => "$name",
             //"privacy"=>"private"
            "privacy"=>"public"
            
        );

        $Room_Meta = json_encode($Room);
        
        $response = ComModel::curlOperations(['type' => 'POST', 'url' => 'rooms', 'data' => $Room_Meta]);
        DB::table('1_daily_meeting_data')->insertGetId(['dmd_response'=>$response,'bm_id'=>$sessData->bm_id]);
        return response(json_decode($response,TRUE));
    }
    
    public function GenerateMeetingToken(Request $request)
    {
        $lemmId = request('lemm_id');
        $bm_id = Session('bm_id');
        $leadData = ComModel::GetBrandMeetingData($lemmId,$bm_id);
        if($leadData['status']=='success')
        {
            $Token = array(
                "properties" => array(
                    "eject_at_token_exp" => true,
                    "room_name"=>$leadData['room_name'],
                    "is_owner"=>true,
                    "user_name"=>$leadData['user_name'],
                    //"user_id"=>"10"
                    //"role"=> "participant",
                )
            );
            
            $Token_Payload = json_encode($Token);
            
            $response = ComModel::curlOperations(['type' => 'POST', 'url' => "meeting-tokens", 'data' => $Token_Payload]);
            ComModel::UpdateTokenData($lemmId,$bm_id,$response);
            return response($response);
        }
        else
        {
            return 'failed';
        }
    }
    ##======================================================================MY SECTION END===========================================================================##

    
    public function ResetTreasureHunt(Request $request)
    {
        $lemm_id = request('lemm_id');
        
        DB::table('1_ticket_data')
            ->where('lemm_id',$lemm_id)
            ->update([
                'l_exercise'=>0,
                'l_exercise_time'=>NULL,
                'l_hydration'=>0,
                'l_hydration_time'=>NULL,
                'l_meditation'=>0,
                'l_meditation_time'=>NULL,
                'l_mindfullness'=>0,
                'l_mindfullness_time'=>NULL,
                'l_nutrition'=>0,
                'l_nutrition_time'=>NULL,
                'l_pledge'=>0,
                'l_pledge_time'=>NULL,
                'l_selfieselfcare'=>0,
                'l_selfieselfcare_time'=>NULL,
                'is_treasure_hunt'=>'active'
            ]);
        
        //DB::table('1_lead_event_master_mapping')->where('lemm_id',$lemm_id)->update(['is_treasure_hunt'=>'active']);
        
        return true;
    }
    
    public function TreasureHuntReport(Request $request)
    {
                
        $today=date('Y-m-d');
        $bm_id = Session('bm_id');
        $datefrom="";
        $dateto="";
        if(!empty(request('datefrom'))){
            $datefrom = date('Y-m-d',strtotime(request('datefrom')));
        }
        if(!empty(request('dateto'))){
             $dateto = date('Y-m-d',strtotime(request('dateto')));
        }
                    
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
        }
                                        
        $treasureHuntPlayed = DB::table('1_ticket_data as td');
                            
        if (!empty($datefrom) &&  empty($dateto) ){
            $treasureHuntPlayed->whereDate('td.td_insert_time','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $treasureHuntPlayed->whereDate('td.td_insert_time','>=', $datefrom)->whereDate('td.td_insert_time','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $treasureHuntPlayed->whereDate('td.td_insert_time','>=', $datefrom);
        }
                            
        $TotalSelfieUploaded = $treasureHuntPlayed->where('td.bm_id',$bm_id)->count();
                            
        //dd($TotalSelfieUploaded);
                
        $treasureData = DB::table('1_ticket_data as td')
                    ->Join('1_lead_event_master_mapping as lemm' ,'td.lemm_id', 'lemm.lemm_id')
                    ->Join('1_lead_master as lm' ,'lm.lm_id', 'lemm.lm_id')
                    ->Select('lm.lm_firstname','lm.lm_lastname','lm.lm_fullname','lm.lm_email',DB::raw('SUM(IFNULL(`l_exercise_time`,0) + IFNULL(`l_hydration_time`,0) + IFNULL(`l_meditation_time`,0) + IFNULL(`l_mindfullness_time`,0) + IFNULL(`l_nutrition_time`,0) + IFNULL(`l_pledge_time`,0) + IFNULL(`l_selfieselfcare_time`,0)) AS total_points'))
                    ->where('td.bm_id',$bm_id);
        
        if(!empty($searchText)){
              $treasureData->where(function($query) use ($searchText) {
                  $query->orwhere('lm.lm_email',$searchText)
                      ->orwhere('lm.lm_lastname','like','%'.$searchText.'%')
                      ->orwhere('lm.lm_firstname','like','%'.$searchText.'%')
                      ->orwhere('lm.lm_fullname','like','%'.$searchText.'%');
              });
        }
        
        if (!empty($datefrom) &&  empty($dateto) ){
            $treasureData->whereDate('td.td_insert_time','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $treasureData->whereDate('td.td_insert_time','>=', $datefrom)->whereDate('td.td_insert_time','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $treasureData->whereDate('td.td_insert_time','>=', $datefrom);
        }
                                
        $treasureData = $treasureData->groupBy('td.lemm_id')->orderBy('total_points','asc');
                    
        $res = $treasureData->paginate($paginate);
        
        return view('customers.Reports.treasure_hunt_report',[
            'leadlist'=>$res,
            'TotalSelfieUploaded'=>$TotalSelfieUploaded,
            'datefrom'=>request('datefrom'),
            'dateto'=>request('dateto')
        ]);
        
    }
    
    
    public function VerifyUser(Request $request)
    {
        $bm_id = Session('bm_id');
        $lemmId = request('lemm_id');
        $status = request('status');
        $status = $status=='active'?'Y':'N';
        
        $isExist= DB::table('1_lead_master as lm')
                    ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id', 'lm.lm_id')
                    //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
                    ->where('lemm.bm_id',$bm_id)
                    ->where('lemm.lemm_id',$lemmId)
                    ->first();
                    
        if($isExist){
            DB::table('1_lead_event_master_mapping')->where('lemm_id',$lemmId)->update(['is_verified'=>$status]);
            return true;
        }
        else{
            return false;
        }
    }
    
    public function attendance_report()
    {
        $eventDetails=Session('A_Session'); 
        $eventDetails->aem_id = 1;
        $AllEvent = false;
        $datefrom="";
        $dateto="";
        $bm_id=Session('bm_id');
        //dd($bm_id);
        if(!empty(request('datefrom'))){
            $datefrom = date('Y-m-d',strtotime(request('datefrom')));
        }
        if(!empty(request('dateto'))){
             $dateto = date('Y-m-d',strtotime(request('dateto')));
        }
                    
                    
                   
        $leadstage = request('leadstage');
        $leadtype = request('leadtype');
        $leadsrc=request('leadsource');
        $univrsty=request('univrsty');


        if(Session::has('paginate')){
            $paginate = Session::get('paginate');
        } else{
             $paginate = 10;
        }
            
        if (null !==(request('pagination'))){
            $paginate = request('pagination');
            Session::put('paginate', $paginate);
        }
        //$paginate=80;
        
        $searchText="";
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
        
        ### Attendance Lead List
        $leadList=DB::table('1_lead_master as lm')
                    ->join('1_lead_event_master_mapping as lemm', 'lemm.lm_id','lm.lm_id')
                    ->join('1_event_master as evm', 'lemm.aem_id','evm.aem_id')
                    ->join('1_lead_event_master_mapping_attendance as lemma','lemm.lemm_id','lemma.lemm_id')
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
                    ->leftJoin('1_qualification_master as qm' ,'lemm.qm_id','qm.qm_id')
                    ->leftJoin('1_master_lead_source as mls' ,'mls.ls_id','lemm.ls_id')
                    ->select('mc.*','qm.*','pm.*','lm.*', 'lemm.*','lemma.*','evm.aem_name',DB::raw("case when mc.cm_name is null then lm.city_id else mc.cm_name end as cm_name"));
        
        // $leadList->where('lm.lm_is_verified','Y');
        $leadList->where('lemm.bm_id',$bm_id);
        if(!empty($eventDetails) && $AllEvent==false){
            $leadList->where('lemm.aem_id', $eventDetails->aem_id);
        }
        if(!empty($leadsrc)){
            $leadList->where('mls.ls_id', $leadsrc);
        }


        if(!empty($leadtype)){
            $leadList->where('lemm.lemm_reg_type',$leadtype);
        }
        
        if(!empty($searchText)){
            $leadList->where(function($query) use ($searchText) {
                $query->orwhere('lm.lm_email',$searchText)
                    ->orwhere('lm.lm_mobile',$searchText)
                    ->orwhere('mc.cm_name',$searchText)
                    ->orwhere('lm.lm_fullname','like','%'.$searchText.'%');
            });
        }
        
          
        if (!empty($leadstage)){
            $leadList->where('leem.lc_id', $leadstage);
        }
          
        if (!empty($datefrom) &&  empty($dateto) ){
            $leadList->whereDate('lemma.lemma_datetime','=',$datefrom);
        }
        
        else if (!empty($dateto) && !empty($datefrom)){
            $leadList->whereDate('lemma.lemma_datetime','>=', $datefrom)->whereDate('lemma.lemma_datetime','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $leadList->whereDate('lemma.lemma_datetime','>=', $datefrom);
        }
        
        $leadList->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id]);
          
        $leadList->orderby('lemma.lemma_id','DESC');
        $res=$leadList ->paginate($paginate);



        #### PIE CHART DATA
        $Pre_reg = DB::table('1_lead_master as lm')
                    ->Join('1_lead_event_master_mapping as lemm' ,'lm.lm_id', 'lemm.lm_id')
                    ->join('1_lead_event_master_mapping_attendance as lemma','lemm.lemm_id','lemma.lemm_id')
                    ->where('lemm.lemm_reg_type','pre-reg')
                    //->where('lm.lm_is_verified','Y')
                    ->where('lemm.bm_id',$bm_id)
                    ->where('lemm.aem_id',$eventDetails->aem_id);  
        
        if (!empty($datefrom) &&  empty($dateto) ){
            $Pre_reg->whereDate('lemma.lemma_datetime','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $Pre_reg->whereDate('lemma.lemma_datetime','>=', $datefrom)->whereDate('lemma.lemma_datetime','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $Pre_reg->whereDate('lemma.lemma_datetime','>=', $datefrom);
        }
        
        $pre= $Pre_reg->select(DB::raw("count(lemma.lemm_id) as TotalCount, lemm.lemm_reg_type"))
                    ->groupby(DB::raw("lemm.lemm_reg_type"));
                              
                              
        $Du_reg = DB::table('1_lead_master as lm')
                ->Join('1_lead_event_master_mapping as lemm' ,'lm.lm_id', 'lemm.lm_id')
                ->join('1_lead_event_master_mapping_attendance as lemma','lemm.lemm_id','lemma.lemm_id')
                ->where('lemm.lemm_reg_type','during-event')
                ->where('lemm.bm_id',$bm_id)
                //->where('lm.lm_is_verified','Y')
                ->where('lemm.aem_id',$eventDetails->aem_id);
        
        if (!empty($datefrom) ){
            $Du_reg->whereDate('lemma.lemma_datetime','=',$datefrom);
        }
        if (!empty($datefrom) &&  empty($dateto) ){
            $Du_reg->whereDate('lemma.lemma_datetime','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $Du_reg->whereDate('lemma.lemma_datetime','>=', $datefrom)->whereDate('lemma.lemma_datetime','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $Du_reg->whereDate('lemma.lemma_datetime','>=', $datefrom);
        }
        
        $Du_reg ->union($pre);
        $pre_with_du= $Du_reg->select(DB::raw("count(lemma.lemm_id) as TotalCount, lemm.lemm_reg_type"))
                            ->groupby(DB::raw("lemm.lemm_reg_type"))
                            ->get();
                
                              
                              
        ### Total Pregistered OTP Verified Attendance
        $prereg_visitorss = DB::table('1_lead_master as lm')
                            ->Join('1_lead_event_master_mapping as lemm' ,'lm.lm_id', 'lemm.lm_id')
                            ->join('1_lead_event_master_mapping_attendance as lemma','lemm.lemm_id','lemma.lemm_id')
                            ->where('lemm.aem_id',$eventDetails->aem_id)
                            //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
                            ->where('lemm.bm_id',$bm_id)
                            ->where('lemm.lemm_reg_type','pre-reg');
                            //->where('lm.lm_is_verified','Y');
        
        if (!empty($datefrom) &&  empty($dateto) ){
            $prereg_visitorss->whereDate('lemma.lemma_datetime','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $prereg_visitorss->whereDate('lemma.lemma_datetime','>=', $datefrom)->whereDate('lemma.lemma_datetime','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $prereg_visitorss->whereDate('lemma.lemma_datetime','>=', $datefrom);
        }
          
        $prereg_visitors= $prereg_visitorss->count(); 
                              
        ### Total During EVent OTP Verified Attendance
        $tduringevent_visitorss = DB::table('1_lead_master as lm')
            ->Join('1_lead_event_master_mapping as lemm' ,'lm.lm_id', 'lemm.lm_id')
            ->join('1_lead_event_master_mapping_attendance as lemma','lemm.lemm_id','lemma.lemm_id')
            ->where('lemm.aem_id',$eventDetails->aem_id)
            ->where('lemm.bm_id',$bm_id)
            //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
            ->where('lemm.lemm_reg_type','during-event');
            //->where('lm.lm_is_verified','Y');
        
        if (!empty($datefrom) &&  empty($dateto) ){
                $tduringevent_visitorss->whereDate('lemma.lemma_datetime','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
                $tduringevent_visitorss->whereDate('lemma.lemma_datetime','>=', $datefrom)->whereDate('lemma.lemma_datetime','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
                $tduringevent_visitorss->whereDate('lemma.lemma_datetime','>=', $datefrom);
        }
        $tduringevent_visitors=$tduringevent_visitorss->count(); 
                         
                         
        ### Total OTP Verified Attendace 
        $total_visitorss = DB::table('1_lead_master as lm')
                        ->Join('1_lead_event_master_mapping as lemm' ,'lm.lm_id', 'lemm.lm_id')
                        ->join('1_lead_event_master_mapping_attendance as lemma','lemm.lemm_id','lemma.lemm_id')
                        //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id])
                        ->where('lemm.bm_id',$bm_id)
                        ->where('lemm.aem_id',$eventDetails->aem_id);
                        //->where('lm.lm_is_verified','Y');
        
        if (!empty($datefrom) &&  empty($dateto) ){
            $total_visitorss->whereDate('lemma.lemma_datetime','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $total_visitorss->whereDate('lemma.lemma_datetime','>=', $datefrom)->whereDate('lemma.lemma_datetime','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $total_visitorss->whereDate('lemma.lemma_datetime','>=', $datefrom);
        }
        $total_visitors=$total_visitorss->count();    

     
                
        ### Visitor Lead Source All Time Attendance                 
        
        $leadsource=DB::table('1_lead_master as lm')
            ->Join('1_lead_event_master_mapping as lemm' ,'lm.lm_id', 'lemm.lm_id')
            ->join('1_lead_event_master_mapping_attendance as lemma','lemm.lemm_id','lemma.lemm_id')
            ->leftJoin('1_master_lead_source as mls' ,'mls.ls_id','lemm.ls_id')
            //->whereRaw('FIND_IN_SET(?, lemm.bm_id)', [$bm_id]);
            ->where('lemm.bm_id',$bm_id);
            //->where('lm.lm_is_verified','Y');
        
        if (!empty($datefrom) &&  empty($dateto) ){
            $leadsource->whereDate('lemma.lemma_datetime','=',$datefrom);
        }
        else if (!empty($dateto) && !empty($datefrom)){
            $leadsource->whereDate('lemma.lemma_datetime','>=', $datefrom)->whereDate('lemma.lemma_datetime','<=', $dateto);
        }
        else if (!empty($dateto) && empty($datefrom)){
            $leadsource->whereDate('lemma.lemma_datetime','>=', $datefrom);
        }
        if($AllEvent==false){
            $leadsource ->where('lemm.aem_id',$eventDetails->aem_id);
        }
        
        $ieadtotsource=$leadsource->select(DB::raw("count(distinct lm.lm_id) as TotalCount,case when mls.ls_text is null then lemm.ls_id else  mls.ls_text end as Name"))
                                    ->groupBy('Name')
                                    ->get();
                            
                            
                            
        ### Filter Dropdown data
                
        $leadsources_list=DB::table('1_master_lead_source')->where('ls_status','active')->orderby('ls_text','ASC')->get();
        
        if(request('action')=='download')
        {
            return view('customers.download_attendence_report',[
                        'leadlist'=>$res,
                    ]);
        }
        else
        {
            return view('customers.attendence_report',[
                        'leadlist'=>$res,
                        'total_visitors'=>$total_visitors,
                        'prereg_visitors'=>$prereg_visitors,
                        'tduringevent_visitors'=>$tduringevent_visitors,
                        'pre_with_du'=>$pre_with_du,
                        'leadsource'=>$ieadtotsource,
                        'prefix_url' => $this->getBaseUrl,
                        'datefrom'=>request('datefrom'),
                        'dateto'=>request('dateto'),
                        'leadtype'=>$leadtype,
                        'leadsources_list'=>$leadsources_list,
                        'leadsrc'=>$leadsrc
            ]);
        }

    }
    
    ##Manage Convai AppId
    public function ManageConvaiAppId(Request $request)
    {
        $searchText="";
        $paginate="";
        $datef ="";
        $datet ="";
        $bm_id = Session('bm_id');
        $datefrom = request('datefrom');
        $datef = date('Y-m-d H:i:s', strtotime($datefrom));
        
        $dateto = request('dateto');
        $datet = date('Y-m-d H:i:s', strtotime($dateto));
        
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
         if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
            
        $tempList = DB::table('1_convai_setting_master')
                    ->where('csm_status','active')
                    ->where('bm_id',$bm_id)
                    ->paginate($paginate);
        
        return view('customers.manage-convai.app-id',
            [
            'datefrom'=>$datefrom,
            'dateto'=>$dateto,
            'Alldata'=>$tempList,
            'status' => request('status'),
            ]);
    }
    
    public function ViewConvaiAppId(Request $request){
        $id=request('id');
        $validator = Validator::make(['id' => $id],[
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $dataList = DB::table('1_convai_setting_master')->where('csm_id',$id)->first();
            return $dataList;
        }
    }
    
    public function AddConvaiAppId(Request $request)
    {
        $app_Id = request('app_id');
        $bm_id = Session('bm_id');
        $csm_id = request('csm_id');
        
        $validator = Validator::make(['app_id' => $app_Id],[
                        'app_id' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
           
            DB::table('1_convai_setting_master')->insert([
                'bm_id' => $bm_id,
                'csm_app_id' => $app_Id,
            ]);
            
            return "success";
        }
    }
    
    
    public function UpdateConvaiAppId(Request $request)
    {
        $res=array();
        $res['csm_app_id']=request('ed_app_id');
        $csmId = request('csm_id');
        
        $validator = Validator::make(['app_id'=>request('ed_app_id'),'id'=>request('csm_id')],[
                        'app_id' => 'required',
                        'id'=>'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
        
            $check = DB::table('1_convai_setting_master')
                            ->where('csm_id', $csmId)
                            ->first();
            
            if ($check) 
            {
                 DB::table('1_convai_setting_master')
                 ->where('csm_id', $csmId)
                 ->update([
                    'csm_app_id' => $res['csm_app_id']
                ]);
                
                return 'Success';
            } 
            else {
                return "Record not Found";
            }
        }
    }
    ## END Manage Convai AppId
    
    ##Manage Convai CharacterId
    public function ManageConvaiCharacterId(Request $request)
    {
        $searchText="";
        $paginate="";
        $datef ="";
        $datet ="";
        $bm_id = Session('bm_id');
        $datefrom = request('datefrom');
        $datef = date('Y-m-d H:i:s', strtotime($datefrom));
        
        $dateto = request('dateto');
        $datet = date('Y-m-d H:i:s', strtotime($dateto));
        
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
         if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
            
        $tempList = DB::table('1_convai_character_id_master')
                    ->where('cci_status','active')
                    ->where('bm_id',$bm_id)
                    ->paginate($paginate);
        
        return view('customers.manage-convai.character-id',
            [
            'datefrom'=>$datefrom,
            'dateto'=>$dateto,
            'Alldata'=>$tempList,
            'status' => request('status'),
            ]);
    }
    
    public function ViewConvaiCharacterId(Request $request){
        $id=request('id');
        $bm_id = Session('bm_id');
        $validator = Validator::make(['id' => $id],[
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $dataList = DB::table('1_convai_character_id_master')->where('bm_id',$bm_id)->where('cci_id',$id)->first();
            return $dataList;
        }
    }
    
    public function AddConvaiCharacterId(Request $request)
    {
        $insertData['app_id'] = request('app_id');
        $insertData['convai_name'] = request('convai_name');
        $bm_id = Session('bm_id');
        
        $validator = Validator::make(['app_id' => request('app_id')],[
                        'app_id' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
            $isExist = DB::table('1_convai_character_id_master')->where('bm_id',$bm_id)->first();
            if($isExist) {
                //do nothing
            }
            else {
                $insertData['bm_id'] = $bm_id;
                DB::table('1_convai_character_id_master')->insert($insertData);
            }
            
            return "success";
        }
    }
    
    
    public function UpdateConvaiCharacterId(Request $request)
    {
        $updateData=array();
        $updateData['app_id']=trim(request('app_id'));
        $updateData['convai_name']=request('convai_name');
        $cciId = request('cci_id');
        $bm_id = Session('bm_id');
        
        $validator = Validator::make(['app_id'=>request('app_id'),'id'=>request('cci_id')],[
                        'app_id' => 'required',
                        'id'=>'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
        
            $check = DB::table('1_convai_character_id_master')
                            ->where('cci_id', $cciId)
                            ->where('bm_id', $bm_id)
                            ->first();
            
            if ($check) 
            {
                 DB::table('1_convai_character_id_master')
                 ->where('cci_id', $cciId)
                 ->where('bm_id', $bm_id)
                 ->update($updateData);
                
                return 'Success';
            } 
            else {
                return "Record not Found";
            }
        }
    }
    ## END Manage Convai AppId
    
    public function ManageDashboardPageContent(Request $request) 
    {
        $bcm_id = '';
        $tdetail=Session('tdetail');

        $profileDetail=Session('profileDetail');
        $eventDetails=Session('selectedEvent');
        $A_Session = Session('A_Session');
        $bm_id = Session('bm_id');

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
        }
        
        $fileurl = 'https://'.request()->getHost().config('app.rootFolder').'/admin/public/assets/images/dashboard/';
        
        $leadList=DB::table('1_dashboard_setting_master as dsm')
                    ->Select(
                        DB::raw('CONCAT("'.$fileurl.'", dsm.logo) AS logo'),
                        DB::raw('CONCAT("'.$fileurl.'", dsm.background_img) AS bgimg'),
                        'dsm.title','dsm.news_text','dsm.dsm_id')
                        ->where('bm_id',$bm_id);
                    
        $res=$leadList->paginate($paginate);
        
        return view('customers.dashboard-setting.index',[
              'leadList'=>$res,
              'prefix_url' => $this->getBaseUrl,
              'bm_name'=>$A_Session->bm_nickname
        ]);
    }
        
    public function AddDashboardPageContent(Request $request) 
    {
        
            $setArray['ehc_color_code'] = request('egcolor');
            $setArray['hp_type'] = request('file_type');
            $setArray['hs_metaverse_name'] = request('meta_name');
            $bm_id = Session('bm_id');
            
            $validator = Validator::make(['egcolor' => request('egcolor'),'file_type' => request('file_type'),'meta_name' => request('meta_name')],[
                        'egcolor' => 'required',
                        'file_type' => 'required',
                        'meta_name' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $existData = DB::table('1_homepage_setting')->where('bm_id',$bm_id)->count();
        
            if(!null==request('upload_photo') && request('photoupload')=='photoupload'){
              
                    $pdfFileData=request('product_image');
                    $data = request('logoimage');
                    
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    
                    $data = base64_decode($data);
                    $imageNames= 'himage-'.date('Y-m-d').time().'.jpg';
                    $imagePath='/assets/images/homepage/';
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    $path = public_path() . $imagePath . $imageNames;
                    
                    file_put_contents($path, $data);
                    
                    $imageNames = $imagePath . $imageNames; //Added For Metaverse Access
                    
                    $setArray['ehc_hall_bgimage'] = $imageNames;
            }
            
            
            if(!null==request('egapplylink')){
              
                $videoUrl = request('egapplylink');
                
                $vidName= 'video-'.date('Y-m-d').time().'.mp4';
                $vidPath='/assets/images/homepage/';
                $path = public_path() . $vidPath . $vidName;
                
                File::makeDirectory(public_path() . $vidPath, 0777, true, true);
                $videoUrl->move(public_path($vidPath), $vidName);
                
                $videoUrl = $vidPath.$vidName; //Added For Access File From Metaverse
                
                $setArray['hp_video'] = $vidPath.$vidName;
            }
          
        
            if(!empty(request('ehc_id')))
            {
                DB::table('1_homepage_setting')
                    ->where('ehc_id',request('ehc_id'))
                    ->where('bm_id',$bm_id)
                    ->update(
                      $setArray
                    );
            }
            
            if($existData < 1)
            {
                $setArray['bm_id']=$bm_id;
                $bmId = DB::table('1_homepage_setting')->insertGetId($setArray);
            }
            
            $A_Session = Session('A_Session');
            if($A_Session->map_id)
            {
                DB::table('customer_data')->where('bm_id',$A_Session->bm_id)->where('map_id',$A_Session->map_id)->update(['is_published'=>'Y']);
            }
            
            return redirect($this->getBaseUrl.'/managehomepage');
        }
    }
    
    public function EditDashboardPageContent(Request $request)
    {
        $hallImgBaseUrl = '';
        $res = array();
        $bm_id = Session('bm_id');
        $validator = Validator::make(['ehc_id' => request('ehc_id')],[
                        'ehc_id' => 'required|numeric',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
            $list = DB::table('1_homepage_setting AS ehc')
                        ->Select('ehc.ehc_color_code','ehc.hp_type','ehc.hs_metaverse_name')
                        ->where('ehc.ehc_id',request('ehc_id'))
                        ->where('bm_id',$bm_id)->first();
            
            if($list)
            {
                $res['code'] = 200;
                $res['color_code'] = $list->ehc_color_code;
                $res['hp_type'] = $list->hp_type;
                $res['meta_name'] = $list->hs_metaverse_name;
            }
            else{
                $res['code'] = 404;
            }
        }
            
        echo json_encode($res);
        
    }
}
