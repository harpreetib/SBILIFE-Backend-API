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
//use \Crypt;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UniqueCodeImport;
use App\Imports\MenuFileImport;
use Illuminate\Support\Facades\Validator;
use App\ComModel;
use Pusher\Pusher;

class SuperadminController extends Controller
{

    
    protected $request;
	
    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::getSAdminBaseUrl($request);
      
      
    }

	 
    public function dashboard(){
        $today=date('Y-m-d');
        $totalLead=CustomerData::count();
        $todayLead=CustomerData::where('created_at',$today)->count();
        $Prospect=CustomerData::where('lead_stage','prospect')->count();
        $Trail=CustomerData::where('lead_stage','trail')->count();
        $Paid=CustomerData::where('lead_stage','paid')->count();
        $leadsource=DB::table('customer_data');
        $ieadtotsource=$leadsource->select(DB::raw("count(id) as TotalCount,utm_source as Name"))
                            ->groupBy('Name')->get();
          $Lead_Stage=$leadsource->select(DB::raw("count(id) as TotalCount,lead_stage as Name"))
                            ->groupBy('Name')->get();
                            
        $lineChart = CustomerData::select(DB::raw("count(id) as TotalCount,date(created_at) as Name"))
        // ->whereDay('created_at', '=',date('d'))
        //  ->groupBy('month_name')
         ->groupBy('Name')
        ->get();
         $Dtotal=CustomerData::select(DB::raw("date(created_at) as createdate,count(created_at) as TotalCount"))
                          ->groupby(DB::raw("date(created_at)"))->get(); 
        //dd($Dtotal);
        //  $tdaily_total=DB::table($tdetail['lead_master'].' as lm')
        //              ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id');
        //              if($AllEvent==false){
        //                       $tdaily_total ->where('lemm.aem_id',$selectedEvent->aem_id);
        //                     }
        //                 if (!empty($datefrom) &&  empty($dateto) ){
                        
        //                     $tdaily_total->whereDate('lemm.lemm_insert_date','=',$datefrom);
                        
        //                 }
        //                 else if (!empty($dateto) && !empty($datefrom)){
                        
        //                     $tdaily_total->whereDate('lemm.lemm_insert_date','>=', $datefrom)->whereDate('lemm.lemm_insert_date','<=', $dateto);
                        
        //                 }
        //                 else if (!empty($dateto) && empty($datefrom)){
                        
        //                     $tdaily_total->whereDate('lemm.lemm_insert_date','>=', $datefrom);
                        
        //                 }                            

        //               $Dtotal=$tdaily_total->select(DB::raw("date(lemm.lemm_insert_date) as createdate,count(lemm.lemm_insert_date) as TotalCount"))
        //                  ->groupby(DB::raw("date(lemm.lemm_insert_date)"))->get(); 
                
                // $tdaily_total=DB::table($tdetail['lead_master'].' as lm')
                //      ->Join($tdetail['lead_event_master_mapping'] .' as lemm' ,'lm.lm_id', 'lemm.lm_id');
                //      if($AllEvent==false){
                //               $tdaily_total ->where('lemm.aem_id',$selectedEvent->aem_id);
                //             }
                //         if (!empty($datefrom) &&  empty($dateto) ){
                        
                //             $tdaily_total->whereDate('lemm.lemm_insert_date','=',$datefrom);
                        
                //         }
                //         else if (!empty($dateto) && !empty($datefrom)){
                        
                //             $tdaily_total->whereDate('lemm.lemm_insert_date','>=', $datefrom)->whereDate('lemm.lemm_insert_date','<=', $dateto);
                        
                //         }
                //         else if (!empty($dateto) && empty($datefrom)){
                        
                //             $tdaily_total->whereDate('lemm.lemm_insert_date','>=', $datefrom);
                        
                //         }                            

                //       $Dtotal=$tdaily_total->select(DB::raw("date(lemm.lemm_insert_date) as createdate,count(lemm.lemm_insert_date) as TotalCount"))
                //          ->groupby(DB::raw("date(lemm.lemm_insert_date)"))->get(); 
                         
        
         return view('dashboard.dashboardv1',[
             'totalLead'=>$totalLead,
             'todayLead'=>$todayLead,
             'prospect'=>$Prospect,
             'trail'=>$Trail,
             'paid'=>$Paid,
             'leadsource'=>$ieadtotsource,
             'Lead_Stage'=>$Lead_Stage,
             'lineChart'=>$lineChart,
             'Dtotal'=>$Dtotal
             ]);
    }
   
    public function prospects(){
        
        $searchText="";
        $paginate="";
        $datef ="";
        $datet ="";
        $datefrom = request('datefrom');
        $datef = date('Y-m-d H:i:s', strtotime($datefrom));
        
        $dateto = request('dateto');
        $datet = date('Y-m-d H:i:s', strtotime($dateto));
        $leadstage = request('leadstage');
        
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
         if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
            
        $tempList = DB::table('1_environment_template_master')->where('etm_status','active')->get();
        
        $Allcountry = MasterCountry::all();
        $Alldata = CustomerData::leftJoin('access_mappings','access_mappings.map_id','=','customer_data.map_id')
            ->leftJoin('brand_organizer_master as bom','access_mappings.bm_id','=','bom.bm_id')
            ->select('customer_data.*','access_mappings.login_id','access_mappings.password','bom.bm_nickname')
            ->where('cd_status','active')->where('cd_full_name','like','%'.$searchText.'%')
            ->where('lead_stage','like','%'.$leadstage.'%')->where('created_at','>=',$datef)->orwhere('created_at','<=',$datet)
            ->orderBy('created_at', 'desc');
             
        // if(!empty($searchText)){
        //     $Alldata->where(function($query) use ($searchText) {
        //           $query->orwhere('cd_email',$searchText)
        //                 ->orwhere('cd_mobile',$searchText)
        //                 ->orwhere('cd_full_name',$searchText);
        //     });
        // }
            
        $Alldata = $Alldata->paginate($paginate);
     
        $leadstages = DB::table('customer_data')->where('lead_stage',$leadstage)->select('lead_stage','id')->first();
        
        return view('superadmin.prospects-table',['Alldata'=>$Alldata,'Allcountry'=>$Allcountry,'companyList'=>[],
            'qualificationdata'=>[],'productdata'=>[],'leadcategorization'=>[],
            'qualificationdata'=>[],
            'statedata'=>[],
            'datefrom'=>$datefrom,
            'dateto'=>$dateto,
            'leadstage'=>$leadstages,
            'citys'=>[],
            'states'=>[],
            'productdata'=>[],
            'courses'=>[],
            'leadtype'=>[],
            'leadsource'=>[],
            'leadsrc'=>[],
            'universitylist'=>[],
            'univrstyId'=>[],
            'ad_id'=>[],
            'adid'=>[],
            'tempList'=>$tempList,
            'status' => request('status'),
            'serch_by_company' => [],
        ]);
    }
    public function addprospects(Request $request){
        
                $request->validate([
                  'full_name' => 'required',
                  'email' => 'required|max:255',
                ]);
               $data = $request->all();
    
      	        $student = new CustomerData;  //can use CustomerData::create(['cd_full_name' => $data['full_name'],]);
                $student->cd_full_name = $data['full_name'];
                $student->cd_email = $data['email'];
                $student->cd_mobile = $data['mobile'];
                $student->cd_country_code = $data['country_code'];
				$student->cd_company_website = $data['company_website'];
				$student->cd_company_name = $data['company_name'];
				//$student->cd_event_name = $data['event_name'];
				//$student->cd_event_date = date('Y-m-d',strtotime($data['event_date']));
				$student->cd_ipAddress = $_SERVER["REMOTE_ADDR"];
				$student->user_agent = $_SERVER['HTTP_USER_AGENT'];
				$student->etm_ids = implode(',',$data['temp_ids']);
				//dd($student);
				
				if($student->save()){ 
                    $arr = array('msg' => 'Prospect Successfully Added', 'status' => true);
                 }
                 $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' =>false);
                return response()->json($arr);
    }
    public function updateprospects(Request $request){
        
                $data = $request->all();
                $validator = Validator::make(['cd_id' => $data['cd_id'],'ed_full_name' => $data['ed_full_name'],'ed_email'=>$data['ed_email'],'ed_mobile'=>$data['ed_mobile'],'ed_country_code'=>$data['ed_country_code'],'ed_company_website'=>$data['ed_company_website'],'ed_company_name'=>$data['ed_company_name']], 
	                [
                        'cd_id' => 'required|numeric',
                        'ed_full_name' => 'required',
                        'ed_email' => 'required|email',
                        'ed_mobile'=>'required',
                        'ed_country_code'=>'required',
                        'ed_company_website'=>'required',
                        'ed_company_name'=>'required'
                    ]);
                    
                if($validator->fails())
                {
                    abort(404);
                }
                else
                {
          	        $student =  CustomerData::find($data['cd_id']);
                    $student->cd_full_name = $data['ed_full_name'];
                    $student->cd_email = $data['ed_email'];
                    $student->cd_mobile = $data['ed_mobile'];
                    $student->cd_country_code = $data['ed_country_code'];
    				$student->cd_company_website = $data['ed_company_website'];
    				$student->cd_company_name = $data['ed_company_name'];
    				//$student->cd_event_name = $data['ed_event_name'];
    				//$student->cd_event_date = date('Y-m-d',strtotime($data['ed_event_date']));
    				$student->cd_ipAddress = $_SERVER["REMOTE_ADDR"];
    				$student->user_agent = $_SERVER['HTTP_USER_AGENT'];
    				$student->etm_ids = implode(',',$data['etemp_ids']);
    				// dd($student);
    				$student->save();
                }
    }
    public function editprospects(Request $request){
        $data=$request->all();
        $id=$data['id'];
        $validator = Validator::make(['id' => $id], 
	                [
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $Alldata = CustomerData::all();
            $Allcountry = MasterCountry::all();
            $dataList = CustomerData::find($id);
            return $dataList;
        }
    }
    public function mailcontent(Request $request){
        
        $data=$request->all();
        $id=$data['id'];
        
        $validator = Validator::make(['id' => $id], 
                    [
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
                $cdata = CustomerData::Join('access_mappings','access_mappings.map_id','=','customer_data.map_id')->join('brand_organizer_master as bom','access_mappings.bm_id','=','bom.bm_id')
                ->select('customer_data.*','bom.bm_nickname','access_mappings.login_id','access_mappings.password')->where('id',$id)->first();
                $cc=[];
                $subject="";
                $subject="Megaspace Login Credentials";
                // dd($cdata);
            if($cdata){
                $content=  view('emailer.sendcredentials',['full_name'=>$cdata->cd_full_name,'userid'=>$cdata->login_id,'password'=>$cdata->password,'bm_nickname'=>$cdata->bm_nickname])->render();
    
                return response()->json(['cd_email'=>$cdata->cd_email,'cc'=>$cc,'subject'=>$subject,'content'=>$content]);
            }
            return response()->json(['cd_email'=>'','cc'=>'','subject'=>$subject,'content'=>'']);
        }
    }
    public function SendCredentials(){

        $content=request('content');
    // dd($content);
    
            $email_to=request('to'); 
    
            $cc=[];  
    
            $subject=request('subject');

        

                                    try{

                                            Mail::send('BMS', ['content'=>$content], function ($m) use ($email_to,$cc,$subject) {

                                                    $m->from('invitation@smartevents.in', 'Megaspace');

                                                    $m->to($email_to)->cc($cc)->subject($subject);

                                            }); 

                                    }

                                    catch(\Exception $e){

                                            // Get error here

                                            

                                            echo $e;

                                    } 
                echo "Mail Send";

  }
    public function prospectStatus()
    {
        $id = request('cd_id');
        $validator = Validator::make(['id' => $id], 
                    [
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $cData = CustomerData::find($id);
            $cData->cd_status = 'inactive';
            $cData->save();
            return "Updated";
        }
    }

    public function Campaign()

        {
               
        //   $tdetail=Session('tdetail');

         

        //   $dataList=DB::table($tdetail['live_career_counseling_sessions'])

        //     ->where('lccs_id',request('lccs_id'))->first();

           

            return view('url-builder.campaign-manager',[

                //  'prefix_url' => $this->getBaseUrl

              ]);

        }
    public function changeleadstage()
    {
        
        $id = request('id');
        $validator = Validator::make(['id' => $id], 
                    [
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $cData = CustomerData::where('id',$id)->first();
        
            if(!empty($cData->bm_id) || !empty($cData->map_id)){
                DB::table('brand_organizer_master')
                ->where('bm_id', $cData->bm_id)
                ->update(
                  array(
                    'bm_name'=>$cData->cd_company_name,
                    'bm_nickname'=>strtolower(explode(' ',trim($cData->cd_company_name))[0])
            
                  )
                ); 
                
                $update = DB::table('customer_data')
                    ->where('bm_id',$cData->bm_id)
                    ->update(
                          array(                 
                                'lead_stage'=>request('leadType')
                        )
                  );
                 return true;
            }else{
               
                $bm_Id= DB::table('brand_organizer_master')
                                ->insertGetId(
                                    array( 
                                        'bm_name'=>$cData->cd_company_name,
                                        'bm_nickname'=>strtolower(explode(' ',trim($cData->cd_company_name))[0])
                                    )
                                );
                
                $pDir = strtolower(explode(' ',trim($cData->cd_company_name))[0]);
                $projDir = "../".$pDir;
                                
                if(!is_dir($projDir)) {
                    mkdir($projDir);
                    
                    //copy main file to new folder
                    $source = "../ibmt/main.php";
                    $destination = "../".$pDir."/index.php";
                    File::copy($source,$destination);
                }
             
                $map_Id= DB::table('access_mappings')
                                ->insertGetId(
                                    array( 
                                        'bm_id'=>$bm_Id,
                                        'user_name'=>$cData->cd_full_name,
                                        'email_id'=>$cData->cd_email,
                                        'login_id'=>$cData->cd_email,
                                        'password'=>random_int(100000, 999999),
                                        'mobile_no'=>$cData->cd_mobile,
                                        'at_id'=> 2
                                    )
                                );
                         
                    $update = DB::table('customer_data')
                    ->where('id',$id)
                    ->update(
                          array(                       
                                'map_id'=>$map_Id,
                                'bm_id'=>$bm_Id,
                                'lead_stage'=>request('leadType')
                        )
                  );
                 return true;
            }
        }
    
    }
     public function settings($id){
         
        $validator = Validator::make(['id' => $id],[
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            // $id = \Crypt::decrypt($id); 
            $selectedEvent=Session('selectedEvent');
             // dd($selectedEvent);  
            $settinngsList=AppFeatureMaster::where('afm_status','active')->get(); 
            $LandingPage=AppLandingpageMaster::where('alm_status','active')->get(); 
            
            $FeatureSetting=SettingMapping::where('sm_status','active')
            ->where('cu_id',$id)->get(); 
            // dd($FeatureSetting);//return back()
            return view('superadmin.settings',['settinngsList'=>$settinngsList,
                                            'LandingPage'=>$LandingPage,
                                            'FeatureSetting'=>$FeatureSetting,
                                            'prefix_url' => $this->getBaseUrl
                                            ]);
        }
    }
    
    public function saveSettings(){
      
        $selectedEvent=Session('selectedEvent');
        
        $validator = Validator::make(['id' => request('id')],[
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $CustomerList=CustomerData::where('id',request('id'))->first();
            
            $check=SettingMapping::where('afm_id',request('AfmId'))
            ->where('bm_id',$CustomerList->bm_id)->get(); 
       
            if(count($check)!=0){
                SettingMapping::where('aem_id',$selectedEvent->aem_id)
                ->where('afm_id',request('AfmId'))
                 ->where('bm_id',$CustomerList->bm_id)
                ->update(
                    array(
                        'alm_id'=>request('AlmId'),
                        'sm_status'=>request('reqText')
                        )
                    );
            }else{
                SettingMapping::insert(
                    array(
                        'afm_id'=>request('AfmId'),
                        'bm_id'=>$CustomerList->bm_id,
                        'aem_id'=>$selectedEvent->aem_id,
                        'alm_id'=>request('AlmId'),
                        'cu_id'=>request('id'),
                        'sm_status'=>request('reqText')
                        )
                    );
            }
            
            return 'success';
        }
    }
    
    ##
    public function templates(){
        
        $searchText="";
        $paginate="";
        $datef ="";
        $datet ="";
        $datefrom = request('datefrom');
        $datef = date('Y-m-d H:i:s', strtotime($datefrom));
        
        $dateto = request('dateto');
        $datet = date('Y-m-d H:i:s', strtotime($dateto));
        $leadstage = request('leadstage');
        
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
         if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
            
            
        $tempList = DB::table('1_environment_template_master')->where('etm_status','active');
        
         if(!empty($searchText)){

              $tempList->where(function($query) use ($searchText) {
                    $query->orwhere('etm_name',$searchText);
                  });
        } 
        
        $tempList = $tempList->orderBy('etm_id','desc');
        $tempList = $tempList->paginate($paginate);
        
        
        return view('superadmin.manage-templates.templates',['companyList'=>[],
            'qualificationdata'=>[],'productdata'=>[],'leadcategorization'=>[],
            'qualificationdata'=>[],
            'statedata'=>[],
            'datefrom'=>$datefrom,
            'dateto'=>$dateto,
            'citys'=>[],
            'states'=>[],
            'productdata'=>[],
            'courses'=>[],
            'leadtype'=>[],
            'leadsource'=>[],
            'leadsrc'=>[],
            'universitylist'=>[],
            'univrstyId'=>[],
            'ad_id'=>[],
            'adid'=>[],
            'Alldata'=>$tempList,
            
            'status' => request('status'),
            'serch_by_company' => [],
              ]);
    }
    
    public function AddTemplate(Request $request)
    {
        
        $file = request('image');
        $name = request('full_name');
        $scene_name = request('scene_name');
        $preview_video = request('video22');
        
        $validator = Validator::make(['image' => $file,'full_name' => $name,'scene_name'=>$scene_name,'preview_video'=>$preview_video],[
                        'image' => 'required',
                        'full_name' => 'required',
                        'scene_name' => 'required',
                        'preview_video' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
        
            $destinationPath = '/assets/images/templateImg/';
            $profileImage = date('YmdHis') . ".jpg";
            $imgurl = $destinationPath.$profileImage;
            $fileupload=$file->move(public_path($destinationPath), $imgurl);
        
            $previewvideopath='/assets/images/templates/previewvideo/';
        
            $videourl = $previewvideopath . date('YmdHis') . ".mp4"; 
            $video_upload = $preview_video->move(public_path($previewvideopath), $videourl);
            
            $existingRecord = DB::table('1_environment_template_master')
                                ->where('etm_name', $name)
                                ->first();
    
           if ($existingRecord) {
                DB::table('1_environment_template_master')
                    ->where('etm_id', $existingRecord->etm_id)
                    ->update([
                        'etm_video' => $videourl,
                        'etm_image' => $imgurl,
                        'etm_main_scene'=>$scene_name
                    ]);
            } else {
                DB::table('1_environment_template_master')->insert([
                    'etm_name' => $name,
                    'etm_main_scene'=>$scene_name,
                    'etm_video' => $videourl,
                    'etm_image' => $imgurl,
                ]);
            }     
            return "success";
        }
    }
    
    public function edittemplate(Request $request)
    {
        $etm_id=request('id');
        $validator = Validator::make(['id' => $etm_id],[
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $dataList = DB::table('1_environment_template_master')->where('etm_id',$etm_id)->first();
            return $dataList;
        }
    }
    
    public function Updatetemplate(Request $request)
    {
        $updateData=array();
        $updateData['etm_name']=request('ed_full_name');
        $updateData['etm_main_scene']=request('ed_scene_name');
        $etmId = request('etm_id');
        
        $validator = Validator::make(['ed_full_name' => request('ed_full_name'),'ed_scene_name' => request('ed_scene_name'),'etm_id'=>$etmId], [
                        'ed_full_name' => 'required',
                        'ed_scene_name' => 'required',
                        'etm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            return "Parameter Missing Or Invalid Data Passed!";
        }
        else
        {
    
            if ($request->hasFile('ed_image')) {
                $file = $request->file('ed_image');
                $destinationPath = '/assets/images/templateImg/';
                $profileImage = date('YmdHis') . ".jpg";
                $imgurl = $destinationPath . $profileImage;
                $fileupload = $file->move(public_path($destinationPath), $imgurl);
                $updateData['etm_image'] = $imgurl;
            }
    
            if ($request->hasFile('ed_video')) {
                $preview_video = $request->file('ed_video');
                $destinationPath = '/assets/images/templates/previewvideo/';
                $videourl = $destinationPath . date('YmdHis') . ".mp4";
                $video_upload = $preview_video->move(public_path($destinationPath), $videourl);
                $updateData['etm_video'] = $videourl;
            }
        
            $checkRecord = DB::table('1_environment_template_master')
                            ->where('etm_id', $etmId)
                            ->first();
            
            if ($checkRecord) 
            {
                DB::table('1_environment_template_master')
                ->where('etm_id', $etmId)
                ->update($updateData);
                return "success";
            } 
            else {
                return "Record not Found";
            }
        }
    
    }
    
    
    public function TemplateLocations ($bm_id)
    {
        if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
        
        $searchText="";
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
        
        $etm_id = $bm_id;
        
        $validator = Validator::make(['bm_id' => $bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $tempDetail = DB::table('1_environment_template_master')->where('etm_id',$etm_id)->first();
    
            $leadList=DB::table('1_environment_template_location_list as ecum')
                        ->where('etm_id',$etm_id);
                        
            $leadList->orderby('ecum.id','asc');
            $res=$leadList->paginate($paginate);
            return view('superadmin.manage-templates.manage-locations.location_list',[
                  'leadList'=>$res,
                  'etm_id' => $etm_id,
                  'prefix_url' => $this->getBaseUrl,
                  'action_url' => $etm_id.'/addedittemplatelocation',
                  'fileupload_url'=>$etm_id.'/uploadlocation',
                  'tempDetail'=>$tempDetail
            ]);
        }
    }
    
    public function AddEditTemplateLocation($bm_id,Request $request) {
        $res = array();
        $id = request('etllId');
        $etm_id = request('etmId');
        
        $validator = Validator::make(['id' => $id,'etm_id' => $etm_id, 'bm_id' => $bm_id],[
                        'id' => 'required|numeric',
                        'etm_id' => 'required|numeric',
                        'bm_id'=> 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
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
            
            $setArray['type'] = request('type');
        
            $check = DB::table('1_environment_template_location_list as etll')->where('etm_id',$etm_id)->where('etll.id',$id)->first();
            
            if($check)
            {
                DB::table('1_environment_template_location_list')
                    ->where('etm_id',$etm_id)
                    ->where('id',$id)
                    ->update(
                      $setArray
                    );
                $res['code'] = 200;
            }
            else {
                $res['code'] = 404;
            }
            
            return json_encode($res);
        }
    }
    
    public function packages()
    {
        
        $searchText="";
        $paginate="";
        $datef ="";
        $datet ="";
        $datefrom = request('datefrom');
        $datef = date('Y-m-d H:i:s', strtotime($datefrom));
        
        $dateto = request('dateto');
        $datet = date('Y-m-d H:i:s', strtotime($dateto));
        $leadstage = request('leadstage');
        
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
         if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
        
        $userList =  DB::table('1_package_user_master')->where('pum_status','active')->get();
        $accessList =  DB::table('1_package_access_master')->where('pam_status','active')->get();
        $videoTypeList =  DB::table('1_package_video_master')->where('pvm_status','active')->get();
        $platformList =  DB::table('1_package_platform_access_master')->where('ppam_status','active')->get();
            
        $Alldata = DB::table('1_package_master as pm')
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
                    ->paginate($paginate);
          
        return view('superadmin.manage_package.packages-table',['Alldata'=>$Alldata,'companyList'=>[],
                'qualificationdata'=>[],'productdata'=>[],'leadcategorization'=>[],
                'qualificationdata'=>[],
                'statedata'=>[],
                'datefrom'=>$datefrom,
                'dateto'=>$dateto,
                'platformList'=>$platformList,
                'userList'=>$userList,
                'accessList'=>$accessList,
                'videoTypeList'=>$videoTypeList,
                'citys'=>[],
                'states'=>[],
                'productdata'=>[],
                'courses'=>[],
                'leadtype'=>[],
                'leadsource'=>[],
                'leadsrc'=>[],
                'universitylist'=>[],
                'univrstyId'=>[],
                'ad_id'=>[],
                'adid'=>[],
                'status' => request('status'),
                'serch_by_company' => [],
              ]);
    }
    
    public function addpackages(Request $request){
        
        $request->validate([
          'name' => 'required'
        ]);
        $data = $request->all();
        
        $validator = Validator::make($request, [
                        'pm_name' => 'required',
                        'users' => 'required',
                        'custom_landing_page' => 'required',
                        'unique_url' => 'required',
                        'template' => 'required',
                        'branding' => 'required',
                        'custom_avatar' => 'required',
                        'npcs' => 'required',
                        'videos' => 'required',
                        'breakout_room' => 'required',
                        'access' => 'required',
                        'live_voice' => 'required',
                        'analytics' => 'required',
                        'preferred_support' => 'required',
                        'platforms' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $pmId = DB::table('1_package_master')->insertGetId([
                    'pm_name'=>$data['pm_name'],
                    'pum_id'=>$data['users'],
                    'pm_custom_landing_page'=>$data['custom_landing_page'],
                    'pm_unique_url'=>$data['unique_url'],
                    'pm_templates'=>$data['template'],
                    'pm_branding_personalized_content'=>$data['branding'],
                    'pm_custom_avatars'=>$data['custom_avatar'],
                    'pm_npc'=>$data['npcs'],
                    'pvm_id'=>$data['videos'],
                    'pm_breakout_room'=>$data['breakout_room'],
                    'pam_id'=>$data['access'],
                    'pm_live_voice_text_interaction'=>$data['live_voice'],
                    'pm_analytics'=>$data['analytics'],
                    'pm_preferred_support'=>$data['preferred_support'],
                    'ppam_id'=>implode(',',$data['platforms'])
                ]);
    				
    		if($pmId){ 
                $arr = array('msg' => 'Package Successfully Added', 'status' => true);
            }
             else{
                $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' =>false);
             }
            return response()->json($arr);
        }
    }
    
    public function updatepackages(Request $request){
        
        $data = $request->all();
        $validator = Validator::make($request, [
                        'pm_id'=>'required|numeric',
                        'ed_name' => 'required',
                        'ed_users' => 'required',
                        'ed_custom_landing_page' => 'required',
                        'ed_unique_url' => 'required',
                        'ed_template' => 'required',
                        'ed_branding' => 'required',
                        'ed_custom_avatar' => 'required',
                        'ed_npcs' => 'required',
                        'ed_videos' => 'required',
                        'ed_breakout_room' => 'required',
                        'ed_access' => 'required',
                        'ed_live_voice' => 'required',
                        'ed_analytics' => 'required',
                        'ed_preferred_support' => 'required',
                        'ed_platforms' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $check = DB::table('1_package_master')->where('pm_id',$data['pm_id'])->first();
            if($check)
            {
                DB::table('1_package_master')->where('pm_id',$data['pm_id'])->update([
                    'pm_name'=>$data['ed_name'],
                    'pum_id'=>$data['ed_users'],
                    'pm_custom_landing_page'=>$data['ed_custom_landing_page'],
                    'pm_unique_url'=>$data['ed_unique_url'],
                    'pm_templates'=>$data['ed_template'],
                    'pm_branding_personalized_content'=>$data['ed_branding'],
                    'pm_custom_avatars'=>$data['ed_custom_avatar'],
                    'pm_npc'=>$data['ed_npcs'],
                    'pvm_id'=>$data['ed_videos'],
                    'pm_breakout_room'=>$data['ed_breakout_room'],
                    'pam_id'=>$data['ed_access'],
                    'pm_live_voice_text_interaction'=>$data['ed_live_voice'],
                    'pm_analytics'=>$data['ed_analytics'],
                    'pm_preferred_support'=>$data['ed_preferred_support'],
                    'ppam_id'=>implode(',',$data['ed_platforms'])
                    ]);
                    
                $arr = array('msg' => 'Package Successfully Updated', 'status' => true);
            }
            else{
                $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' =>false);
            }
            return response()->json($arr);
        }
      	        
    }
    
    public function editpackages(Request $request){
        $data=$request->all();
        $id=$data['id'];
        $validator = Validator::make(['id' => $id], [
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $dataList = DB::table('1_package_master')->where('pm_id',$id)->first();
            return $dataList;
        }
    }
    
    public function UploadlocationsFile($bm_id,Request $request)
    {
        if($request->hasFile('import_unique_code')){
            Excel::import(new UniqueCodeImport($bm_id), request()->file('import_unique_code'));
        } 
    }
    
    public function ManageEvents(Request $request)
    {
        
        $eventLaunch = DB::table('1_event_launch as el')
                        ->Select('el.*')
                        ->get();
        
        return view('superadmin.manage-stream.manage_stream',[
              'eventLaunch'=>$eventLaunch,
              'prefix_url' => $this->getBaseUrl
        ]);
      
    }       
    
    public function ChangeEventStatus(Request $request)
    {

        $ActiveStreamData=array();
        $ActiveStreamData['el_status']=request('el_status');
        
        $validator = Validator::make(['el_id' => request('el_id'),'el_status' => request('el_status')], [
                        'el_id' => 'required',
                        'el_status'=>'required'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            DB::table('1_event_launch')
              ->where('el_id',request('el_id'))
              ->update($ActiveStreamData);
        }
    }
    
    public function AddEventData()
    {
        $insertPosterData['el_name']=request('el_name');
          
        $validator = Validator::make(['name' => request('el_name')], [
                        'name' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
          ## End : poster Insert ##
          if(!null==request('el_id')){
              
              DB::table('1_event_launch')
                  ->where('el_id',request('el_id'))
                  ->update(
                    $insertPosterData
                  );
              
          }else{
              DB::table('1_event_launch')
                  ->insert(
                          $insertPosterData
                  );
          }
          return json_encode($insertPosterData);
        }
    }
    
    public function EditEventDetail()
    {
        
        $validator = Validator::make(['id' => request('el_id')], [
                        'id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
            $el_id=request('el_id');
            
            $dataList =  DB::table('1_event_launch')        
                        ->where('el_id',$el_id)
                        ->first();
           
       
            return view('superadmin.manage-stream.edit_stream',[
              'dataList'=>$dataList,
              'prefix_url' => $this->getBaseUrl
            ]);
        }
    }
    
    
    public function TemplateMenus ($bm_id)
    {
        if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
        
        $searchText="";
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
        
        $etm_id = $bm_id;
        
        $validator = Validator::make(['bm_id' => $bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $tempDetail = DB::table('1_environment_template_master')->where('etm_id',$etm_id)->first();
    
            $leadList=DB::table('1_environment_template_menu_list as ecum')
                        ->where('etm_id',$etm_id);
                    
            $leadList->orderby('ecum.id','asc');
            $res=$leadList->paginate($paginate);
            return view('superadmin.manage-templates.manage-menus.menu_list',[
                  'leadList'=>$res,
                  'etm_id' => $etm_id,
                  'prefix_url' => $this->getBaseUrl,
                  'action_url' => $etm_id.'/addedittemplatemenus',
                  'fileupload_url'=>$etm_id.'/uploadmenu',
                  'tempDetail'=>$tempDetail
            ]);
        }
    }
    
    public function AddEditTemplateMenu($bm_id,Request $request) {
        $res = array();
        $id = request('etllId');
        $etm_id = request('etmId');
        $setArray['em_menu_name'] = trim(request('menu_name'));
        
        $validator = Validator::make(['id' => $id,'etm_id' => $etm_id,'menu_name'=>request('menu_name')], 
	                [
                        'id' => 'required|numeric',
                        'etm_id' => 'required|numeric',
                        'menu_name' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
        
            $check = DB::table('1_environment_template_menu_list as etll')->where('etm_id',$etm_id)->where('etll.id',$id)->first();
            
            if($check)
            {
                DB::table('1_environment_template_menu_list')
                    ->where('etm_id',$etm_id)
                    ->where('id',$id)
                    ->update(
                      $setArray
                    );
                $res['code'] = 200;
            }
            else {
                $res['code'] = 404;
            }
        }
        
        return json_encode($res);
    }
    
    public function UploadMenuFile($bm_id,Request $request)
    {
        if($request->hasFile('import_unique_code')){
            Excel::import(new MenuFileImport($bm_id), request()->file('import_unique_code'));
        } 
    }
    
    public function TemplateAssets ($bm_id)
    {
        if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
        
        $searchText="";
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
        
        $etm_id = $bm_id;
        
        $validator = Validator::make(['bm_id' => $bm_id],[
                        'bm_id' => 'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            abort(404);
        }
        else
        {
        
            $tempDetail = DB::table('1_environment_template_master')->where('etm_id',$etm_id)->first();
    
            $leadList=DB::table('1_scene_master as sm')
                        ->join('1_ground_scalling as gs','gs.sm_id','sm.sm_id')
                        ->where('sm.etm_id',$etm_id);
                     
            $leadList->orderby('sm.sm_id','asc');
            $res=$leadList->paginate($paginate);
            
            return view('superadmin.manage-templates.manage-assets.asset_list',[
                  'leadList'=>$res,
                  'etm_id' => $etm_id,
                  'prefix_url' => $this->getBaseUrl,
                  'action_url' => $etm_id.'/addedittemplateasset',
                  'fileupload_url'=>$etm_id.'/uploadasset',
                  'fileupdate_url'=>$etm_id.'/updateasset',
                  'tempDetail'=>$tempDetail
            ]);
        }
    }
    
    public function AddEditTemplateAsset($bm_id,Request $request) {
        $res = array();
        $smId = request('smId');
        $etm_id = request('etmId');
        
        $validator = Validator::make(['sm_id' => $smId,'etm_id' => $etm_id], 
	                [
                        'sm_id' => 'required|numeric',
                        'etm_id' => 'required|numeric',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
        
            $groundDetail = DB::table('1_scene_master as sm')
                            ->join('1_ground_scalling as gs','gs.sm_id', 'sm.sm_id')
                            ->select('sm.sm_name')
                            ->where('sm.sm_id',$smId)
                            ->where('sm.etm_id',$etm_id)
                            ->first();
            if($groundDetail)
            {
                $res['scene_name'] = $groundDetail->sm_name;
                $res['code'] = 200;  
            }
            else
            {
                $res['code'] = 404; 
            }
        }
        return json_encode($res);
    }
    
    public function SaveAsset($bm_id,Request $request)
    {
        $data = $request->all();
        $sceneArr = array();
        $sceneArr['sm_name'] = trim($data['scene_name']);
        $sceneArr['etm_id'] = $data['temp_id'];
        
        $validator = Validator::make(['etm_id' => request('temp_id'),'scene_name' => request('scene_name')], 
	                [
                        'etm_id' => 'required|numeric',
                        'scene_name' => 'required',
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
            $scale_type = $data['scaling_type'];
            
            if(!empty($data['scene_name']))
            {
                $assetFileName = strtolower($data['scene_name']);
                
                if(!null==request('asset_name')){
                    $file = request('asset_name');
                    $destinationPath = '/assets/scene/';
                    $assetFileName = $file->getClientOriginalName();
                    $asseturl = $destinationPath.$assetFileName;
                    $fileupload=$file->move(public_path($destinationPath), $asseturl);
                }
        
                $sceneData = DB::table('1_scene_master')->where('sm_name',$data['scene_name'])->first();
                if($sceneData)
                {
                   DB::table('1_scene_master')->where('sm_id',$sceneData->sm_id)->update($sceneArr); 
                }
                else{
                    $smId = DB::table('1_scene_master')->insertGetId($sceneArr);
                    
                    if(in_array(2,$scale_type))
                    {
                        $groundArr['gs_asset_uri'] = $assetFileName;
                        $groundArr['gs_asset_prefab_name'] = $assetFileName;
                        $groundArr['sm_id'] = $smId;
                        $groundArr['gs_position'] = '{"x": 0,"y": 0,"z": 0}';
                        $groundArr['gs_rotation'] = '{"x": 0,"y": 0,"z": 0}';
                        $groundArr['gs_scale'] = '{"x": 1,"y": 1,"z": 1}';
                        
                        $gsData = DB::table('1_ground_scalling')->where('sm_id',$smId)->first();
                        if($gsData)
                        {
                           DB::table('1_ground_scalling')->where('gs_id',$gsData->gs_id)->update($groundArr); 
                        }
                        else{
                            $gsId = DB::table('1_ground_scalling')->insertGetId($groundArr);
                        }
                    }
                }
                $res['code'] = 200;
            }
            else{
                $res['code'] = 404;
            }
        }
        return json_encode($res);
    }
    
    
    public function UpdateAsset($bm_id, Request $request)
    {
        $data = $request->all();
        $sm_id = $data['esm_id'];
        
        $validator = Validator::make(['sm_id' => $sm_id,'asset_name'=>request('easset_name')], 
	                [
                        'sm_id' => 'required|numeric',
                        'asset_name'=>'required'
                    ]);
                    
        if($validator->fails())
        {
            $res['code'] = 404;
        }
        else
        {
            $detail = DB::table('1_ground_scalling')->where('sm_id',$sm_id)->first();
            
            if($detail)
            {
                
                $file = request('easset_name');
                $destinationPath = '/assets/scene/';
                $assetFileName = $file->getClientOriginalName();
                $asseturl = $destinationPath.$assetFileName;
                $fileupload=$file->move(public_path($destinationPath), $asseturl);
                
                $groundArr['gs_asset_uri'] = $assetFileName;
                $groundArr['gs_asset_prefab_name'] = $assetFileName;
                
                DB::table('1_ground_scalling')->where('gs_id',$detail->gs_id)->update($groundArr); 
                
                $res['code'] = 200;
            }
            else{
                $res['code'] = 404;
            }
        }
        return json_encode($res);
    }
    
    public function ManageAppSetting(Request $request)
    {
        $searchText="";
        $paginate="";
        $datef ="";
        $datet ="";
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
            
        $tempList = DB::table('1_app_setting_master')
                    ->where('asm_status','active')
                    ->paginate($paginate);
        
        return view('superadmin.manage-app.app-setting',
            [
            'datefrom'=>$datefrom,
            'dateto'=>$dateto,
            'Alldata'=>$tempList,
            'status' => request('status'),
            ]);
    }
    
    public function ViewAppSetting(Request $request){
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
            $dataList = DB::table('1_app_setting_master')->where('asm_id',$id)->first();
            return $dataList;
        }
    }
    
    public function AddAppSetting(Request $request)
    {
        $name = request('full_name');
        $app_Id = request('app_id');
        
        $validator = Validator::make(['app_id' => $app_Id,'name'=>$name],[
                        'app_id' => 'required',
                        'name' => 'required'
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
        
            $existingRecord = DB::table('1_app_setting_master')
            ->where('asm_name', $name)
            ->first();
    
            if ($existingRecord) {
                DB::table('1_app_setting_master')
                    ->where('asm_name', $name)
                    ->update([
                        'asm_app_id' => $app_Id,
                    ]);
            } 
            else {
                DB::table('1_app_setting_master')->insert([
                    'asm_name' => $name,
                    'asm_app_id' => $app_Id,
                ]);
            }     
            return "success";
        }
    }
    
    
    public function UpdateAppSetting(Request $request)
    {
        $res=array();
        $res['asm_name']=request('ed_full_name');
        $res['asm_app_id']=request('ed_app_id');
        $asmId = request('asm_id');
        
        $validator = Validator::make(['app_id'=>request('ed_app_id'),'name'=>request('ed_full_name'),'id'=>request('asm_id')],[
                        'app_id' => 'required',
                        'name' => 'required',
                        'id'=>'required|numeric'
                    ]);
                    
        if($validator->fails())
        {
            return 'failed';
        }
        else
        {
        
            $check = DB::table('1_app_setting_master')
                            ->where('asm_id', $asmId)
                            ->first();
            
            if ($check) 
            {
                 DB::table('1_app_setting_master')
                 ->where('asm_id', $asmId)
                 ->update([
                    'asm_name' => $res['asm_name'],
                    'asm_app_id' => $res['asm_app_id']
                ]);
                
                return 'Success';
            } 
            else {
                return "Record not Found";
            }
        }
    }
}
